<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller {
    public function index ( Request $request ) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $phone_number = $request->phone_number;
        $location = Location::join('actuals', 'locations.id_telegram', '=', 'actuals.id_telegram')
        ->where('actuals.phone_number', $phone_number)
        ->whereBetween('actuals.date', [$start_date, $end_date])
        ->select('locations.lat', 'locations.long')
        ->get();
    
        return response()->json($location);    

        // Menggunakan $hasLocation untuk mengatur nilai true atau false
        // if ( $location ) {
        //     return response()->json($lo);    
        // } else {
        //     return response()->json(false); 
        // }
    }
}

