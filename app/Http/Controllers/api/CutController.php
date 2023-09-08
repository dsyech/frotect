<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cut;
use Ramsey\Uuid\Uuid;

class CutController extends Controller {
    public function index ( Request $request ) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $witel = $request->witel;
        $page = $request->input( 'page', 1 );

        if ( $witel ) {
            $cuts = Cut::select( '*' )
            ->where( 'witel', '=', $witel )
            ->whereBetween( 'date', [ $request->input( 'start_date' ), $request->input( 'end_date' ) ] )
            ->orderBy( 'witel', 'asc' )
            ->paginate( 10 );
        } else {
            $cuts = Cut::select( '*' )
            ->whereBetween( 'date', [ $request->input( 'start_date' ), $request->input( 'end_date' ) ] )
            ->orderBy( 'witel', 'asc' )
            ->paginate( 10 );
        }
        return response()->json( [
            'data' => $cuts->items(),
            'current_page' => $cuts->currentPage(),
            'last_page' => $cuts->lastPage(),
            'total' => $cuts->total(),
        ] );

    }

    public function report ( Request $request ) {
        $cut = Cut::create( [
            'id' => Uuid::uuid4()->toString(),
            'id_telegram' => $request->id_telegram,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'witel' => $request->witel,
            'link' => $request->link,
            'report' => $request->report,
            'photo' => $request->photo,
            'lat' => null,
            'long' => null,
            'date' => $request->date,
        ] );

        if ( $cut ) {
            return response()->json( [ 'status' => 'success', 'message' => 'Data updated successfully' ] );
        } else {
            return response()->json( [ 'status' => 'fail', 'message' => 'Data not updated' ] );
        }
    }

    public function location( Request $request ) {
        $idTelegram = $request->input( 'id_telegram' );
        $lat = $request->input( 'lat' );
        $long = $request->input( 'long' );

        // Find the Cut record with the matching id_telegram
        $cut = Cut::where( 'id_telegram', $idTelegram )->first();

        if ( !$cut ) {
            // If the record doesn't exist, you may return a response indicating it's not found.
            return response()->json( [ 'status' => 'fail', 'message' => 'Cut record not found for the provided id_telegram' ], 404 );
        }

        // Update the lat and long fields
        $cut->lat = $lat;
        $cut->long = $long;
        $edit = $cut->save();

        if($edit){
            return response()->json( [ 'status' => 'success', 'message' => 'Location updated successfully' ] );
        }
        else {
            return response()->json( [ 'status' => 'fail', 'message' => 'Location not updated' ] );
        }
    }

}
