<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technical;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class TechnicalController extends Controller
{
    public function index( Request $request ) {
        $page = $request->input( 'page', 1 );

        $datek = Technical::select( '*' )
        ->orderBy( 'witel', 'asc' )
        ->paginate( 10 );

        return response()->json( [
            'data' => $datek->items(),
            'current_page' => $datek->currentPage(),
            'last_page' => $datek->lastPage(),
            'total' => $datek->total(),
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
                $technical = Technical::create([
                    'witel' => $witel,
                    'node' => $sheet->getCell("A{$row}")->getValue(),
                    'platform' => $sheet->getCell("B{$row}")->getValue(),
                    'ne' => $sheet->getCell("C{$row}")->getValue(),
                    'shelf' => $sheet->getCell("D{$row}")->getValue(),
                    'slot' => $sheet->getCell("E{$row}")->getValue(),
                    'port' => $sheet->getCell("F{$row}")->getValue(),
                    'type_from' => $sheet->getCell("G{$row}")->getValue(),
                    'ne_from' =>  $sheet->getCell("H{$row}")->getValue(),
                    'port_from' =>  $sheet->getCell("I{$row}")->getValue(),
                    'type_to' => $sheet->getCell("J{$row}")->getValue(),
                    'ne_to' => $sheet->getCell("K{$row}")->getValue(),
                    'port_to' => $sheet->getCell("L{$row}")->getValue(),
                    'keterangan' => $sheet->getCell("M{$row}")->getValue(),
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
