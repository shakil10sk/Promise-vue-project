<?php

namespace App\Http\Controllers;

use App\Services\EmployeeQuataService;
use Illuminate\Http\Request;

class EmployeeQuotaController extends Controller
{
    public function index(Request $request)
    {
        return EmployeeQuataService::list_data($request);
    }

    public function store(Request $request)
    {
        return EmployeeQuataService::insert($request);
    }

    public function delete($id)
    {
        return EmployeeQuataService::delete($id);
    }
}
