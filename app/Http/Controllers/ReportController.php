<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function submit_report(Request $request){
        $request->validate([
            'zone' => 'required|string',
            'area' => 'required|string',
        ]);

        $report = Report::create([
            'zone' => $request->zone,
            'area' => $request->area,
            'men' => $request->men,
            'women' => $request->women,
            'children' => $request->children,
            'total_offering' => $request->total_offering,
            'remittance' => $request->remittance,
            'comment' => $request->comment,
            'receipt' => $request->receipt ? $this->store_image($request) : null,
        ]);
        
        $report = Report::find($report->id);
       
        return response()->json([
            'message' => 'Report submitted',
            'report' => $report,
          ],201)->withHeaders([
              'Content-Type' => 'application/json',
          ]);

    }

    private function store_image($request){
        $suffix = Str::slug($request->area);
        $newImageName = uniqid().'-'.$suffix.'.'. $request->receipt->extension();
    
        return $request->receipt->move(public_path('receipts'),$newImageName);
       }

    function get_reports(){
        $reports = Report::all();

        return response()->json([
            'message' => 'Reports retrieved',
            'reports' => $reports,
          ],200)->withHeaders([
              'Content-Type' => 'application/json',
          ]);
    }
}
