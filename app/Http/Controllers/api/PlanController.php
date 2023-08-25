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
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $plans = Plan::whereBetween('date', [$start_date, $end_date])
            ->orderBy('witel', 'asc')
            ->get();
    
        $plansWithActuals = $plans->map(function ($plan) use ($start_date, $end_date) {
            $actuals = Actual::whereBetween('date', [$start_date, $end_date])
                ->where('phone_number', $plan->phone_number)
                ->get();
    
            if ($actuals->isEmpty()) {
                $actualData = [
                    'id' => null,
                    'id_telegram' => null,
                    'phone_number' => null,
                    'report' => null,
                    'photo' => null,
                    'date' => null,
                    'created_at' => null,
                    'updated_at' => null,
                ];
            } else {
                $actualData = $actuals->first()->toArray();
            }
    
            return array_merge($plan->toArray(), $actualData);
        });
    
        return response()->json($plansWithActuals);
    }
    

}
