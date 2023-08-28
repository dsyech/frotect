<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Actual;
use App\Models\Location;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index( Request $request ) {
        $start_date = $request->input( 'start_date' );
        $end_date = $request->input( 'end_date' );

        $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];
        $laporan = [];
        $lokasi = [];
        foreach ($witel as $w) {
            $total_plan_patroli = Plan::where('witel', $w)
                ->where( 'activity', 'LIKE', '%PATROLI%' )
                ->whereBetween('date', [$start_date, $end_date])
                ->count();
            
            $total_plan_wasman = Plan::where('witel', $w)
                ->where( 'activity', 'LIKE', '%WASMAN%' )
                ->whereBetween('date', [$start_date, $end_date])
                ->count();
    
            $total_actual_patroli = Actual::join('plans', function ($join) use ($w) {
                $join->on('actuals.phone_number', '=', 'plans.phone_number')
                    ->where('plans.witel', $w)
                    ->where( 'plans.activity', 'LIKE', '%PATROLI%' )
                    ->whereColumn('plans.date', 'actuals.date');
            })
            ->whereBetween('actuals.date', [$start_date, $end_date])
            ->count();

            $total_actual_wasman = Actual::join('plans', function ($join) use ($w) {
                $join->on('actuals.phone_number', '=', 'plans.phone_number')
                    ->where('plans.witel', $w)
                    ->where( 'plans.activity', 'LIKE', '%WASMAN%' )
                    ->whereColumn('plans.date', 'actuals.date');
            })
            ->whereBetween('actuals.date', [$start_date, $end_date])
            ->count();

            $unique_data = Location::whereBetween('date', [$start_date, $end_date])
            ->distinct('id_telegram')
            ->pluck('id_telegram');

            $matching_phone_numbers = Actual::whereIn('id_telegram', $unique_data)
            ->whereBetween('date', [$start_date, $end_date])
            ->pluck('phone_number');

            $total_location = Plan::whereIn('phone_number', $matching_phone_numbers)
            ->whereBetween('date', [$start_date, $end_date])
            ->where('witel', $w)
            ->pluck('witel')->count();

    
            if (($total_plan_patroli+$total_plan_wasman) > 0) {
                $laporan[] = [
                    'witel' => $w,
                    'plan_patroli' => $total_plan_patroli,
                    'plan_wasman' => $total_plan_wasman,
                    'actual_patroli'=> $total_actual_patroli,
                    'actual_wasman' => $total_actual_wasman,
                    'laporan' => (($total_actual_patroli+$total_actual_wasman) / ($total_plan_patroli+$total_plan_wasman)) * 100,
                    'lokasi' => ($total_location / ($total_plan_patroli+$total_plan_wasman)) * 100
                ];
            } else {
                $laporan[] = [
                    'witel' => $w,
                    'plan_patroli' => $total_plan_patroli,
                    'plan_wasman' => $total_plan_wasman,
                    'actual_patroli'=> $total_actual_patroli,
                    'actual_wasman' => $total_actual_wasman,
                    'laporan' => 0,
                    'lokasi' => 0
                ];
            }
        }
    
        return response()->json($laporan);
    }

}
