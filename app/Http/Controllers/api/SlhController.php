<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\Slh;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class SlhController extends Controller {
    public function index( Request $request ) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $page = $request->input( 'page', 1 );

        $slh = Slh::select( '*' )
        ->orderBy( 'created_at', 'desc' ) // Order by created_at in descending order
        ->orderBy( 'delta', 'desc' )
        ->paginate( 10 );

        return response()->json( [
            'data' => $slh->items(),
            'current_page' => $slh->currentPage(),
            'last_page' => $slh->lastPage(),
            'total' => $slh->total(),
        ] );
    }

    public function file(Request $request)
    {
        // $user = auth()->user();
        $witel = $request->witel;
        $path = storage_path() . '/app/' . request()->file('file')->store('tmp');

        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($path);
        $sheet  = $spreadsheet->getActiveSheet();

        $worksheetInfo = $reader->listWorksheetInfo($path);
        $totalRows = $worksheetInfo[0]['totalRows'];
        $totalRows = $sheet->getHighestDataRow();
        
        for ($row = 2; $row <= $totalRows; $row++) {
            if ($sheet->getCell("A{$row}")->getValue() != '') {
               try {
                // Kode yang mungkin menyebabkan kesalahan
                $slh = Slh::create([
                    'witel' => $sheet->getCell("A{$row}")->getValue(),
                    'link_a' => $sheet->getCell("B{$row}")->getValue(),
                    'link_b' => $sheet->getCell("C{$row}")->getValue(),
                    'system' => $sheet->getCell("D{$row}")->getValue(),
                    'ne' => $sheet->getCell("E{$row}")->getValue(),
                    'shelf' => $sheet->getCell("F{$row}")->getValue(),
                    'slot' => $sheet->getCell("G{$row}")->getValue(),
                    'port' => $sheet->getCell("H{$row}")->getValue(),
                    'level' => $sheet->getCell("I{$row}")->getValue(),
                    'level_ref' =>  $sheet->getCell("J{$row}")->getValue(),
                    'delta' => $sheet->getCell("K{$row}")->getValue(),
                ]);
            } catch (Exception $e) {
                // Tindakan jika terjadi kesalahan
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
            } else {
                return "Done";
            }
        }

    }

}
