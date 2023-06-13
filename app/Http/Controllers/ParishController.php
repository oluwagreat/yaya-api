<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParishController extends Controller
{
    public function get_areas(Request $request){
       $zone = $request->input('zone');
     //  dd($zone);
       $areas = DB::table('areas')->where('zone',$zone)->pluck('area');
   //  $areas = Area::where('zone','excellence zone')->get();
        return response()->json([ 
            'message' => 'Areas retrieved successfully for '.$zone,
            'areas' => $areas
        ],200); 
    }

    public function get_zones(){
        $zones = DB::table('zones')->pluck('zone');

         return response()->json([ 
             'message' => 'LP10 Zones retrieved successfully',
             'zones' => $zones
         ],200); 
     }


     public function get_parishes(Request $request){
        $area = $request->input('area');
        $areas = DB::table('parish')->where('area',$area)->pluck('parish');
        
         return response()->json([ 
             'message' => 'Parishes retrieved successfully for '.$area,
             'parishes' => $areas
         ],200); 
     }
}
