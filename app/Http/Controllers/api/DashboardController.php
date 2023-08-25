<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Actual;
use App\Models\Location;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index( Request $request ) {
        $method = $request->input( 'method' );
        $start_date = $request->input( 'start_date' );
        $end_date = $request->input( 'end_date' );

        if ( $method == 'patroli' ) {
            // Menghitung total plan berdasarkan kriteria yang diberikan
            $total_plan_patroli = Plan::where( 'activity', 'LIKE', '%PATROLI%' )
            ->whereBetween( 'date', [ $start_date, $end_date ] )
            ->count();

            // Menghitung total actual berdasarkan kriteria yang diberikan
            $total_actual_patroli = Actual::join( 'plans', 'actuals.phone_number', '=', 'plans.phone_number' )
            ->where( 'plans.activity', 'LIKE', '%PATROLI%' )
            ->whereColumn( 'plans.date', 'actuals.date' )
            ->whereBetween( 'actuals.date', [ $start_date, $end_date ] )
            ->count();

            // Menghitung persentase actual terhadap plan
            if ( $total_plan_patroli > 0 ) {
                $persen = ( $total_actual_patroli / $total_plan_patroli ) * 100;
            } else {
                $persen = 0;
            }

            // Membuat array dengan data yang diinginkan dalam format JSON
            $result = [
                'total_plan_patroli' => $total_plan_patroli,
                'total_actual_patroli' => $total_actual_patroli,
                'persen' => $persen,
            ];

            return response()->json( $result );
        }
        if ( $method == 'wasman' ) {
            // Menghitung total plan berdasarkan kriteria yang diberikan
            $total_plan_wasman = Plan::where( 'activity', 'LIKE', '%WASMAN%' )
            ->whereBetween( 'date', [ $start_date, $end_date ] )
            ->count();

            // Menghitung total actual berdasarkan kriteria yang diberikan
            $total_actual_wasman = Actual::join( 'plans', 'actuals.phone_number', '=', 'plans.phone_number' )
            ->where( 'plans.activity', 'LIKE', '%WASMAN%' )
            ->whereColumn( 'plans.date', 'actuals.date' )
            ->whereBetween( 'actuals.date', [ $start_date, $end_date ] )
            ->count();

            // Menghitung persentase actual terhadap plan
            if ( $total_plan_wasman > 0 ) {
                $persen = ( $total_actual_wasman / $total_plan_wasman ) * 100;
            } else {
                $persen = 0;
            }

            // Membuat array dengan data yang diinginkan dalam format JSON
            $result = [
                'total_plan_wasman' => $total_plan_wasman,
                'total_actual_wasman' => $total_actual_wasman,
                'persen' => $persen,
            ];

            return response()->json( $result );
        }
        if ($method == 'laporan') {
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];
        
            $laporan = [];
            $lokasi = [];
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

        
                if ($total_plan > 0) {
                    $laporan[] = [
                        'witel' => $w,
                        'laporan' => ($total_actual / $total_plan) * 100,
                        'lokasi' => ($total_location / $total_plan) * 100
                    ];
                } else {
                    $laporan[] = [
                        'witel' => $w,
                        'laporan' => 0,
                        'lokasi' => 0
                    ];
                }
            }
        
            return response()->json($laporan);
        }   
        if ($method == 'lokasi') {
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];
        
            $laporan = [];
            foreach ($witel as $w) {
                $total_plan = Plan::where('witel', $w)
                    ->whereBetween('date', [$start_date, $end_date])
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
        
                if ($total_plan > 0) {
                    $laporan[] = [
                        'witel' => $w,
                        'laporan' => ($total_location / $total_plan) * 100
                    ];
                } else {
                    $laporan[] = [
                        'witel' => $w,
                        'laporan' => 0
                    ];
                }
            }
        
            return response()->json($laporan);
        }
        if ($method == 'chart_patroli') {
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];
            $chart_patroli = [];

            for ($i = 0; $i < count($witel); $i++) {
                $planQuery = Plan::where('witel', $witel[$i])->where('activity', 'like', 'PATROLI%');
                $actualQuery = Actual::join('plans', function ($join) {
                    $join->on('plans.phone_number', '=', 'actuals.phone_number')
                        ->on('plans.date', '=', 'actuals.date');
                })->where('plans.witel', $witel[$i])->where('plans.activity', 'like', 'PATROLI%');
        
                if ($start_date && $end_date) {
                    $planQuery->whereBetween('date', [$start_date, $end_date]);
                    $actualQuery->whereBetween('plans.date', [$start_date, $end_date]);
                } else {
                    $planQuery->whereDate('date', $today);
                    $actualQuery->whereDate('plans.date', $today);
                }
        
                $data_chart_plan_patroli = $planQuery->count();
                $data_chart_actual_patroli = $actualQuery->count();

                $chart_patroli[] = [
                    'witel' => $witel[$i],
                    'plan' => $data_chart_plan_patroli,
                    'actual' => $data_chart_actual_patroli
                ];
            }
            return response()->json($chart_patroli);    
        }
        if ($method == 'chart_wasman') {
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];
            $chart_wasman = [];

            for ($i = 0; $i < count($witel); $i++) {
                $planQuery = Plan::where('witel', $witel[$i])->where('activity', 'like', 'WASMAN%');
                $actualQuery = Actual::join('plans', function ($join) {
                    $join->on('plans.phone_number', '=', 'actuals.phone_number')
                        ->on('plans.date', '=', 'actuals.date');
                })->where('plans.witel', $witel[$i])->where('plans.activity', 'like', 'WASMAN%');
        
                if ($start_date && $end_date) {
                    $planQuery->whereBetween('date', [$start_date, $end_date]);
                    $actualQuery->whereBetween('plans.date', [$start_date, $end_date]);
                } else {
                    $planQuery->whereDate('date', $today);
                    $actualQuery->whereDate('plans.date', $today);
                }
        
                $data_chart_plan_wasman = $planQuery->count();
                $data_chart_actual_wasman = $actualQuery->count();

                $chart_wasman[] = [
                    'witel' => $witel[$i],
                    'plan' => $data_chart_plan_wasman,
                    'actual' => $data_chart_actual_wasman
                ];
            }  
            return response()->json($chart_wasman);    
        }
        
        
        
        
    }

}
