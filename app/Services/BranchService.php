<?php

namespace App\Services;

use App\Interfaces\DataManipulationInterface;
use App\Models\Branch;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BranchService implements DataManipulationInterface
{

    public static function list_data($receive)
    {
        $searchingItems = !empty($receive->search_item) ? $receive->search_item : '';
        $limit = !empty($receive->limit) ? $receive->limit : 10;

        $list_data = DB::table('branches')
            ->select('*')
            ->when(!empty($searchingItems), function ($query) use ($searchingItems) {
                $query->where(function ($q) use ($searchingItems) {
                    $q->where('branch_name', 'like', '%' . $searchingItems . '%');
                });
            })
            ->whereNull('deleted_at')
            ->orderBy('id', 'ASC')
            ->paginate($limit);


        return response()->json($list_data, 200);
    }


    public static function insert($receive)
    {
        $operation = "";

        $brnach_data = [
            "branch_name" => $receive->name,
        ];

        $brnach_data += isset($receive->rowId) ? ["updated_at" => Carbon::now()] : ["created_at" => Carbon::now()];

        if (isset($receive->rowId)) {
            $operation = "আপডেট";
            $isResponse = Branch::where('id', $receive->rowId)->update($brnach_data);
        } else {
            $operation = "যোগ";
            $isResponse = Branch::create($brnach_data);
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
        $isDelete = Branch::find($rowId)->delete();
        return response()->json([
            "status" => $isDelete ? "success" : "error",
            "message" => $isDelete ? "সফলভাবে মুছে ফেলা হয়েছে" : "ব্যর্থ হয়েছেন"
        ], 200);
    }


}
