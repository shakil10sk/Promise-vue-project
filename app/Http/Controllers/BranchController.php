<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index(Request $request)
    {
        return BranchService::list_data($request);
    }

    public function store(Request $request)
    {
        return BranchService::insert($request);
    }

    public function delete($id)
    {
        return BranchService::delete($id);
    }
}
