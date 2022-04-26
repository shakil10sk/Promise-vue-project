<?php

namespace App\Services;

use App\Interfaces\DataManipulationInterface;
use App\Models\Department;
use App\Models\Municipility;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MunicipilityService implements DataManipulationInterface
{

    public static function list_data($receive)
    {
        $searchingItems = !empty($receive->search_item) ? $receive->search_item : '';
        $limit = !empty($receive->limit) ? $receive->limit : 10;

        $list_data = Municipility::with(['district', 'division'])
            ->when(!empty($searchingItems), function ($query) use ($searchingItems) {
                $query->where(function ($q) use ($searchingItems) {
                    $q->where('name', 'like', '%' . $searchingItems . '%')
                        ->orWhere('code', 'like', '%' . $searchingItems . '%')
                        ->orWhere('email', 'like', '%' . $searchingItems . '%');
                });
            })
            ->whereNull('deleted_at')
            ->orderBy('id', 'ASC')
            ->paginate($limit);


        return response()->json($list_data, 200);
    }

    public static function insert($receive)
    {

        if ($receive->logo) {
            $imageName = time() . '.' . explode('/', explode(':', substr($receive->logo, 0, strpos($receive->logo, ';')))[1])[1];

            \Image::make($receive->logo)->save(public_path('/assets/img/municipility/') . $imageName);
            $receive->merge(['logo' => $imageName]);
        }


        $operation = "";

        $municipility_data = [
            "name" => $receive->name,
            "code" => $receive->code,
            "logo" => !empty($receive->logo) ? $receive->logo : $receive->previous_logo,
            "division_id" => $receive->division_id,
            "district_id" => $receive->district_id,
            "estabilish_year" => $receive->estabilish_year,
            "email" => $receive->email,
            "website" => $receive->website,
            "fax" => $receive->fax,
            "status" => isset($receive->status) ? $receive->status : 1,
            "class" => $receive->class,
        ];

        $municipility_data += isset($receive->rowId) ? ["updated_at" => Carbon::now()] : ["created_at" => Carbon::now()];

        if (isset($receive->rowId)) {
            $operation = "আপডেট";
            $isResponse = Municipility::where('id', $receive->rowId)->update($municipility_data);
        } else {
            $operation = "যোগ";
            $isResponse = Municipility::create($municipility_data);
        }


        return response()->json([
            "status" => $isResponse ? "success" : "error",
            "message" => $isResponse ? "সফলভাবে $operation হয়েছে" : "ব্যর্থ হয়েছেন"
        ], 200);
    }

    public static function update($request)
    {
        // TODO: Implement update() method.
    }

    public static function delete($rowId)
    {
        $isDelete = Municipility::find($rowId)->delete();
        return response()->json([
            "status" => $isDelete ? "success" : "error",
            "message" => $isDelete ? "সফলভাবে মুছে ফেলা হয়েছে" : "ব্যর্থ হয়েছেন"
        ], 200);
    }
}
