<?php

namespace App\Http\Controllers;

use App\Models\BdLocation;
use App\Services\LocationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function index(Request $request){

        return LocationService::list_data($request);


    }


    public function store(Request $request){

        return LocationService::insert($request);
    }

    public function delete($id)
    {
        return LocationService::delete($id);
    }

}
