<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Actual;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Ramsey\Uuid\Uuid;

class PlanController extends Controller {
    public function index(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $witel = $request->witel;
        $page = $request->input('page', 1);

        if($witel){
            $plans = Plan::select('plans.*', 'actuals.id AS id_actual', 'actuals.phone_number AS phone_number_actual', 'actuals.photo')
            ->where('witel', '=', $witel)
            ->leftJoin('actuals', function ($join) {
                $join->on('plans.phone_number', '=', 'actuals.phone_number')
                    ->on('plans.date', '=', 'actuals.date');
            })
            ->whereBetween('plans.date', [$request->input('start_date'), $request->input('end_date')])
            ->orderBy('witel', 'asc')
            ->paginate(10);

        }
        else {
            $plans = Plan::select('plans.*', 'actuals.id AS id_actual', 'actuals.phone_number AS phone_number_actual', 'actuals.photo')
            ->leftJoin('actuals', function ($join) {
                $join->on('plans.phone_number', '=', 'actuals.phone_number')
                    ->on('plans.date', '=', 'actuals.date');
            })
            ->whereBetween('plans.date', [$request->input('start_date'), $request->input('end_date')])
            ->orderBy('witel', 'asc')
            ->paginate(10);

        }
        return response()->json([
            'data' => $plans->items(),
            'current_page' => $plans->currentPage(),
            'last_page' => $plans->lastPage(),
            'total' => $plans->total(),
        ]);      
    }

    public function file(Request $request)
    {
        // $user = auth()->user();
        $date = $request->date;
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
                $phone_number = $sheet->getCell("F{$row}")->getValue();
                if (!(str_starts_with($phone_number, '0'))) {
                    $phone_number = "0".$phone_number;
                    $phone_number = str_replace(" ","", $phone_number);
                }

               try {
                // Kode yang mungkin menyebabkan kesalahan
                $plan = Plan::create([
                    'id' => Uuid::uuid4()->toString(),
                    'witel' => $witel,
                    'link_a' => $sheet->getCell("A{$row}")->getValue(),
                    'link_b' => $sheet->getCell("B{$row}")->getValue(),
                    'activity' => $sheet->getCell("C{$row}")->getValue(),
                    'km' => $sheet->getCell("D{$row}")->getValue(),
                    'name' => $sheet->getCell("E{$row}")->getValue(),
                    'phone_number' => $phone_number,
                    'operator' => $sheet->getCell("G{$row}")->getValue(),
                    'operator_pic' => $sheet->getCell("H{$row}")->getValue(),
                    'operator_phone_number' =>  $sheet->getCell("I{$row}")->getValue(),
                    'date' => $date,
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

    public function delete(Request $request){
        $id = $request->id;
        try {
            $plan = Plan::findOrFail($id);
            $plan->delete();
            
            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete data']);
        }
    }
    
    
    
}
