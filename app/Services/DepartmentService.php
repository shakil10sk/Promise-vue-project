<?php

namespace App\Services;

use App\Interfaces\DataManipulationInterface;
use App\Models\Department;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DepartmentService implements DataManipulationInterface
{

    public static function list_data($receive)
    {
        $searchingItems = !empty($receive->search_item) ? $receive->search_item : '';
        $limit = !empty($receive->limit) ? $receive->limit : 10;

        $list_data = DB::table('department as ds')
            ->leftJoin('department as dp', 'dp.id', '=', 'ds.parent_id')
            ->select(DB::raw("IF(ds.type = 1, ds.name,IF(dp.type = 1, dp.name, null)) as department ,  IF(ds.type = 2 , ds.name, null) as designation"), 'ds.id', 'ds.parent_id', 'ds.type')
            ->when(!empty($searchingItems), function ($query) use ($searchingItems) {
                $query->where(function ($q) use ($searchingItems) {
                    $q->where('ds.name', 'like', '%' . $searchingItems . '%')
                        ->orWhere('dp.name', 'like', '%' . $searchingItems . '%');
                });
            })
            ->whereNull('ds.deleted_at')
            ->orderBy('ds.id', 'ASC')
            ->paginate($limit);


        return response()->json($list_data, 200);
    }


    public static function insert($receive)
    {
        $operation = "";

        $department_data = [
            "parent_id" => $receive->department_id,
            "name" => $receive->name,
            "type" => is_null($receive->department_id) ? 1 : 2,
        ];

        $department_data += isset($receive->rowId) ? ["updated_at" => Carbon::now()] : ["created_at" => Carbon::now()];

        if (isset($receive->rowId)) {
            $operation = "আপডেট";
            $isResponse = Department::where('id', $receive->rowId)->update($department_data);
        } else {
            $operation = "যোগ";
            $isResponse = Department::create($department_data);
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
        $isDelete = Department::find($rowId)->delete();
        return response()->json([
            "status" => $isDelete ? "success" : "error",
            "message" => $isDelete ? "সফলভাবে মুছে ফেলা হয়েছে" : "ব্যর্থ হয়েছেন"
        ], 200);
    }


}
