<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class DepartmentController extends Controller
{


    public function index(Request $request)
    {
        return DepartmentService::list_data($request);
    }


    public function store(DepartmentRequest $request)
    {
        return DepartmentService::insert($request);
    }



    public function delete($id)
    {
        return DepartmentService::delete($id);
    }
}
