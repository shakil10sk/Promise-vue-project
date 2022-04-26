<?php

namespace App\Http\Controllers;

use App\Municipility;
use App\Services\MunicipilityService;
use Illuminate\Http\Request;

class MunicipilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return MunicipilityService::list_data($request);
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
        return MunicipilityService::insert($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Municipility  $municipility
     * @return \Illuminate\Http\Response
     */
    public function show(Municipility $municipility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Municipility  $municipility
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipility $municipility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Municipility  $municipility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipility $municipility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Municipility  $municipility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipility $municipility)
    {
        //
    }

    public function delete($id) {
        MunicipilityService::delete($id);
    }
}
