<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Property, TowerLog};

class CTTowerStatusController extends Controller
{
    public function disabled_options(Request $request)
    {
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        if ($property) {
            $disabled_options = self::get_project_tower_disabled_options($property, $request->tower_id);
            return response()->json(['disabled_options' => $disabled_options], 200);
        }
        return response()->json(['msg' => 'Log not found with this property.'], 404);
    }
    public function get_project_tower_disabled_options($property, $tower_id)
    {
        $status_logs = TowerLog::where('property_id', $property->id)->where('tower_id', $tower_id)->distinct()->pluck('tower_status')->toArray();
        $disabled_options = [];
        if (count($status_logs)) {
            (in_array(config('constants.PROJECT_STATUS.UNDER_CONSTRUCTION'), $status_logs))
                ? array_push($disabled_options, config('constants.PROJECT_STATUS.GROUNDED')) : '';
            ((in_array(config('constants.PROJECT_STATUS.COMPLETED'), $status_logs)) || (in_array(config('constants.PROJECT_STATUS.EXTERIOR_WORKS'), $status_logs)))
                ? $disabled_options = [config('constants.PROJECT_STATUS.GROUNDED'), config('constants.PROJECT_STATUS.UNDER_CONSTRUCTION')] : '';
        }
        return $disabled_options;
    }
}
