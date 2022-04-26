<?php


use Illuminate\Support\Facades\DB;

function generateEmployeeId(){

    //get employee serial
    $employee_serial = DB::table('employees')
            ->count() + 1;

    $employee_glue = strlen($employee_serial) < 5 ? str_repeat('0', 5 - strlen($employee_serial)).$employee_serial: $employee_serial;

    $employee_id = date('y') . $employee_glue;

    return $employee_id;
}
