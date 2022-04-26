<?php

namespace App\Http\Controllers;

use App\Models\BankBranch;
use App\Services\BankBranchService;
use Illuminate\Http\Request;

class BankBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return BankBranchService::list_data($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankBranch  $bankBranch
     * @return \Illuminate\Http\Response
     */
    public function show(BankBranch $bankBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankBranch  $bankBranch
     * @return \Illuminate\Http\Response
     */
    public function edit(BankBranch $bankBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankBranch  $bankBranch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankBranch $bankBranch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankBranch  $bankBranch
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankBranch $bankBranch)
    {
        //
    }
}
