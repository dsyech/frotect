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
        
            foreach ($witel as $w) {
                $total_plan = Plan::
                    where('witel', $w)
                    ->where( 'activity', 'LIKE', '%PATROLI%' )
                    ->whereBetween('date', [$start_date, $end_date])
                    ->count();

                $total_actual = Actual::join( 'plans', 'actuals.phone_number', '=', 'plans.phone_number' )
                ->where('witel', $w)
                ->where( 'plans.activity', 'LIKE', '%PATROLI%' )
                ->whereColumn( 'plans.date', 'actuals.date' )
                ->whereBetween( 'actuals.date', [ $start_date, $end_date ] )
                ->count();
        
                $chart_patroli[] = [
                    'witel' => $w,
                    'plan' => $total_plan,
                    'actual' => $total_actual
                ];
            }
            return response()->json($chart_patroli);    
        }
        if ($method == 'chart_wasman') {
            $witel = ['ACEH', 'MEDAN', 'SUMUT', 'SUMBAR', 'RIDAR', 'RIKEP', 'JAMBI', 'BENGKULU', 'BABEL', 'SUMSEL', 'LAMPUNG'];
            $chart_patroli = [];
        
            foreach ($witel as $w) {
                $total_plan = Plan::
                    where('witel', $w)
                    ->where( 'activity', 'LIKE', '%WASMAN%' )
                    ->whereBetween('date', [$start_date, $end_date])
                    ->count();

                $total_actual = Actual::join( 'plans', 'actuals.phone_number', '=', 'plans.phone_number' )
                ->where('witel', $w)
                ->where( 'plans.activity', 'LIKE', '%WASMAN%' )
                ->whereColumn( 'plans.date', 'actuals.date' )
                ->whereBetween( 'actuals.date', [ $start_date, $end_date ] )
                ->count();
        
                $chart_patroli[] = [
                    'witel' => $w,
                    'plan' => $total_plan,
                    'actual' => $total_actual
                ];
            }
            return response()->json($chart_patroli);    
        }
        
        
        
        
    }

}
