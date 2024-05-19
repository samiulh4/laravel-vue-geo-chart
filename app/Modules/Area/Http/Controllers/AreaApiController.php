<?php

namespace App\Modules\Area\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Area\Models\Area;

class AreaApiController extends Controller
{
    public function getWebAreas(Request $request)
    {
        try {
            $areas = Area::where('area_type', 6)
                ->where('is_active', 1)
                ->orderBy('area_name_en', 'asc')
                ->get([
                    'area_name_en',
                    'area_name',
                    'area_img',
                    'area_latitude',
                    'area_longitude'
                ]);
            return response()->json(['responseCode' => 1, 'areas' => $areas]);
        }catch (\Exception $e){
            $message = $e->getMessage();
            return response()->json(['responseCode' => 0, 'message' => $message]);
        }
    }// end -:- getWebAreas()
}// end -:- AreaApiController()
