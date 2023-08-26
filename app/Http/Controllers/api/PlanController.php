<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Actual;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller {
    public function index(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $page = $request->input('page', 1);
    
        $plans = Plan::select('plans.*', 'actuals.id AS id_actual', 'actuals.phone_number AS phone_number_actual', 'actuals.photo')
            ->leftJoin('actuals', function ($join) {
                $join->on('plans.phone_number', '=', 'actuals.phone_number')
                    ->on('plans.date', '=', 'actuals.date');
            })
            ->whereBetween('plans.date', [$request->input('start_date'), $request->input('end_date')])
            ->orderBy('witel', 'asc')
            ->paginate(10);
    
        $plans->map(function ($plan) {
            $hasLocation = Location::join('actuals', 'locations.id_telegram', '=', 'actuals.id_telegram')
                ->where('actuals.phone_number', $plan->phone_number)
                ->where('locations.date', 'LIKE', '%' . $plan->date . '%')
                ->exists();
    
            $plan->has_location = $hasLocation;
            return $plan;
        });
    
        return response()->json([
            'data' => $plans->items(),
            'current_page' => $plans->currentPage(),
            'last_page' => $plans->lastPage(),
            'total' => $plans->total(),
        ]);      
    }
    
    
}
