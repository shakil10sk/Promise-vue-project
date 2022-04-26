<?php

namespace App\Services;

use App\Interfaces\DataManipulationInterface;
use App\Models\EmployeeQuota;
use Carbon\Carbon;

class EmployeeQuataService implements DataManipulationInterface
{


    public static function list_data($request)
    {
        $limit = !empty($receive->limit) ? $receive->limit : 10;

        $list_data = EmployeeQuota::with('designation')
            ->whereNull('deleted_at')
            ->orderBy('id', 'ASC')
            ->paginate($limit)->toJson();

        return $list_data;
    }

    public static function insert($request)
    {

        if (self::checkExistingEntry($request->municipility_class, $request->designation_id, $request->rowId)) {
            return response()->json([
                "status" => "error",
                "message" => "এই শ্রেণীর পদবীর কোটা ইতিমধ্যে যোগ করা হয়েছে"
            ], 400);
        }

        $quota_data = [
            'municipility_class' => $request->municipility_class,
            'designation_id' => $request->designation_id,
            'total_quota' => $request->total_quota,
        ];

        $quota_data += isset($request->rowId) ? ["updated_at" => Carbon::now()] : ["created_at" => Carbon::now()];

        if (isset($request->rowId)) {
            $operation = "আপডেট";
            $isResponse = EmployeeQuota::where('id', $request->rowId)->update($quota_data);
        } else {
            $operation = "যোগ";
            $isResponse = EmployeeQuota::create($quota_data);
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
        $isDelete = EmployeeQuota::find($rowId)->delete();
        return response()->json([
            "status" => $isDelete ? "success" : "error",
            "message" => $isDelete ? "সফলভাবে মুছে ফেলা হয়েছে" : "ব্যর্থ হয়েছেন"
        ], 200);
    }

    private static function checkExistingEntry($municipilityClass, $designationId, $rowId = null)
    {
        return EmployeeQuota::where([
                'municipility_class' => $municipilityClass,
                'designation_id' => $designationId,
            ])->when(isset($rowId), function ($query) use ($rowId) {
                $query->where('id', '!=', $rowId);
            })->count() > 0;
    }
}
