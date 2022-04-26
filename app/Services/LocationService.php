<?php

namespace App\Services;

use App\Interfaces\DataManipulationInterface;
use App\Models\BdLocation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LocationService implements DataManipulationInterface
{

    public static function list_data($receive)
    {
        $searchingItems = !empty($receive->search_item) ? $receive->search_item : '';
        $limit = !empty($receive->limit) ? $receive->limit : 10;

        $list_data = DB::table('bd_locations as DIS')
            ->leftJoin('bd_locations as DEP', 'DEP.id', '=', 'DIS.parent_id')
            ->select(DB::raw("IF(DIS.type = 1, DIS.name,IF(DEP.type = 1, DEP.name, null)) as division ,  IF(DIS.type = 2 , DIS.name, null) as district"), 'DIS.parent_id', 'DEP.id', 'DIS.id', 'DIS.type')
            ->when(!empty($searchingItems), function ($query) use ($searchingItems) {
                $query->where(function ($q) use ($searchingItems) {
                    $q->where('DIS.name', 'like', '%' . $searchingItems . '%')
                        ->orWhere('DEP.name', 'like', '%' . $searchingItems . '%');
                });
            })
            ->orderBy('DIS.id', 'ASC')
            ->paginate($limit);


        return response()->json($list_data, 200);
    }


    public static function insert($receive)
    {
        $operation = "";

        $location_data = [
            "parent_id" => $receive->division_id,
            "name" => $receive->name,
            "type" => is_null($receive->division_id) ? 1 : 2,
        ];

        $location_data += isset($receive->rowId) ? ["updated_at" => Carbon::now()] : ["created_at" => Carbon::now()];

        if (isset($receive->rowId)) {
            $operation = "আপডেট";
            $isResponse = BdLocation::where('id', $receive->rowId)->update($location_data);
        } else {
            $operation = "যোগ";
            $isResponse = BdLocation::create($location_data);
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
        $isDelete = BdLocation::find($rowId)->delete();

        return response()->json([
            "status" => $isDelete ? "success" : "error",
            "message" => $isDelete ? "সফলভাবে মুছে ফেলা হয়েছে" : "ব্যর্থ হয়েছেন"
        ], 200);
    }


}
