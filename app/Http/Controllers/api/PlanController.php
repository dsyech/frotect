<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Actual;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
class PlanController extends Controller {
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $today = date("Y-m-d");

        $plan = Plan::join('actuals', 'actuals.phone_number', '=', 'plans.phone_number')
        ->whereColumn( 'plans.date', 'actuals.date' )
        ->whereBetween('plans.date', [$start_date, $end_date])
        ->get();
        return response()->json($plan);
        
    }
    
}
