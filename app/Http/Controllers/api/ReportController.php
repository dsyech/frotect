<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Actual;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller {
    public function index( Request $request ) {
        $start_date = $request->input( 'start_date' );
        $end_date = $request->input( 'end_date' );
        $data = $request->input( 'data' );

        if($data == 'all'){
            $laporan = [];
            $total_plan_patroli = Plan::where( 'activity', 'LIKE', '%PATROLI%' )
            ->whereBetween('date', [$start_date, $end_date])
            ->count();

            $total_plan_wasman = Plan::where( 'activity', 'LIKE', '%WASMAN%' )
            ->whereBetween('date', [$start_date, $end_date])
            ->count();

            $total_actual_patroli = Actual::join('plans', 'actuals.phone_number', '=', 'plans.phone_number')
            ->whereBetween('actuals.date', [$start_date, $end_date])
            ->whereColumn('plans.date', 'actuals.date')
            ->where('plans.activity', 'LIKE', '%PATROLI%')
            ->count();
        

            $total_actual_wasman = Actual::join('plans', 'actuals.phone_number', '=', 'plans.phone_number')
            ->whereBetween('actuals.date', [$start_date, $end_date])
            ->whereColumn('plans.date', 'actuals.date')
            ->where('plans.activity', 'LIKE', '%WASMAN%')
            ->count();

            $laporan = [
                "total_plan_patroli" => $total_plan_patroli,
                "total_plan_wasman" => $total_plan_wasman,
                "total_actual_patroli" => $total_actual_patroli,
                "total_actual_wasman" => $total_actual_wasman
            ];

            return response()->json($laporan);

        }
        if($data == 'patroli'){
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];       
            $laporan = []; 
            foreach ($witel as $w) {
                $total_plan_patroli = Plan::where('witel', $w)
                    ->where( 'activity', 'LIKE', '%PATROLI%' )
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
                    $laporan[] = [
                        'witel' => $w,
                        'plan_patroli' => $total_plan_patroli,
                        'actual_patroli'=> $total_actual_patroli,
                    ];
 
            }
            return response()->json($laporan);
        }
        if($data == 'wasman'){
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];       
            $laporan = []; 
            foreach ($witel as $w) {
                $total_plan_wasman = Plan::where('witel', $w)
                    ->where( 'activity', 'LIKE', '%WASMAN%' )
                    ->whereBetween('date', [$start_date, $end_date])
                    ->count();
                
                $total_actual_wasman = Actual::join('plans', function ($join) use ($w) {
                    $join->on('actuals.phone_number', '=', 'plans.phone_number')
                        ->where('plans.witel', $w)
                        ->where( 'plans.activity', 'LIKE', '%WASMAN%' )
                        ->whereColumn('plans.date', 'actuals.date');
                })
                ->whereBetween('actuals.date', [$start_date, $end_date])
                ->count();
                    $laporan[] = [
                        'witel' => $w,
                        'plan_wasman' => $total_plan_wasman,
                        'actual_wasman'=> $total_actual_wasman,
                    ];
 
            }
            return response()->json($laporan);
        }
        if($data=='laporan'){
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];        
            foreach ($witel as $w) {
                $total_plan = Plan::where('witel', $w)
                    ->whereBetween('date', [$start_date, $end_date])
                    ->count();
        
                $total_actual = Actual::join('plans', function ($join) use ($w) {
                    $join->on('actuals.phone_number', '=', 'plans.phone_number')
                        ->where('plans.witel', $w)
                        ->whereColumn('plans.date', 'actuals.date');
                })
                ->whereBetween('actuals.date', [$start_date, $end_date])
                ->count();
        
                if (($total_plan) > 0) {
                    $laporan[] = [
                        'witel' => $w,
                        'laporan' => (($total_actual) / ($total_plan)) * 100,
                    ];
                } else {
                    $laporan[] = [
                        'witel' => $w,
                        'laporan' => 0,
                    ];
                }
            }
            return response()->json($laporan);
        }
        else {
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];        
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

}
