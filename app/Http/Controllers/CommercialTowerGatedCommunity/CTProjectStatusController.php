<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Property, Tower, ProjectStatusFilterField, ProjectStatusLog, TowerLog};
use App\Rules\UniqueCombination;
use Validator;
use Auth;

class CTProjectStatusController extends Controller
{
    public function get_project_status_block()
    {
        return view('admin.pages.property.commercial_tower_gated_community.', get_defined_vars());
    }
    public function store(Request $request)
    {
        $property = Property::where('id', $request->property_id)
            ->where('status', 1)
            ->first();
        if ($property) {
            $towers = TowerLog::where('property_id', $request->property_id)
                ->orderBy('id', 'DESC')
                ->get();
            $project_status_log = ProjectStatusLog::where('property_id', $request->property_id)
                ->orderBy('id', 'DESC')
                ->get();
            // dd($project_status_log);
            $disabled_options = self::get_project_tower_disabled_options($property);
            $status_list = view('admin.pages.property.commercial_tower_gated_community.project_status.index_log', get_defined_vars())->render();
            return response()->json(
                [
                    'status' => true,
                    'statusList' => $status_list,
                    'disabled_options' => $disabled_options,
                    'message' => 'This property status already Exterior works under progress.',
                ],
                200,
            );
        }
        Validator::extend('required_if_not_empty', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];

            return !empty($validator->getData()[$otherField]) ? !empty($value) : true;
        });

        $validation = [
            // 'project_status' => 'required',
            'project_status' => ['required', new UniqueCombination('project_status_log', ['project_status', 'project_expected_date_of_start', 'project_expected_date_of_completion', 'project_date_of_completion', 'property_id', 'created_at'], [$request->project_status, $request->project_expected_date_of_start, $request->project_expected_date_of_completion, $request->project_date_of_completion, $request->property_id, date('Y-m-d H:i:s')])],
            'project_expected_date_of_start' => 'required_if:project_status,1',
            'project_expected_date_of_completion' => 'required_if:project_status,1',
            // 'tower' => 'required_if:project_status,2',
            'tower' => ['required_if:project_status,2', new UniqueCombination('tower_status_log', ['tower_id', 'tower_status', 'tower_expected_date_of_start', 'tower_expected_date_of_completion', 'tower_date_of_completion', 'construction_stage', 'floor_range', 'property_id'], [$request->tower, $request->tower_status, $request->tower_expected_date_of_start, $request->tower_expected_date_of_completion, $request->tower_date_of_completion, $request->construction_stage, $request->floor_range, $request->property_id])],
            'tower_status' => 'required_if_not_empty:tower',
            'tower_expected_date_of_start' => 'required_if:tower_status,1',
            'tower_expected_date_of_completion' => 'required_if:tower_status,1',
            'project_date_of_completion' => 'required_if:project_status,3',
            'construction_stage' => 'required_if:tower_status,2',
            'floor_range' => 'required_if:construction_stage,2',
            'tower_date_of_completion' => 'required_if:tower_status,3',
        ];
        $customMessages = [
            'project_expected_date_of_start.required_if' => 'The project expected date of start field is required.',
            'project_expected_date_of_completion.required_if' => 'The project expected date of completion field is required.',
            'tower.required_if' => 'The tower field is required.',
            'tower_expected_date_of_start.required_if' => 'The tower expected date of start field is required.',
            'tower_expected_date_of_completion.required_if' => 'The tower expected date of completion field is required.',
            'project_date_of_completion.required_if' => 'The project date of completion field is required.',
            'tower_status.required_if_not_empty' => 'The tower status field is required.',
            'construction_stage.required_if' => 'The construction stage field is required.',
            'floor_range.required_if' => 'The floor range field is required.',
            'tower_date_of_completion.required_if' => 'The tower date of completion field is required.',
        ];
        $validator = Validator::make($request->all(), $validation, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // exit();

        $property = Property::find($request->property_id);
        $property->project_status = isset($request->project_status) ? $request->project_status : null;
        $property->project_expected_date_of_start = isset($request->project_expected_date_of_start) ? $request->project_expected_date_of_start : null;
        $property->project_expected_date_of_completion = isset($request->project_expected_date_of_completion) ? $request->project_expected_date_of_completion : null;
        $property->project_date_of_completion = isset($request->project_date_of_completion) ? $request->project_date_of_completion : null;
        $property->status = isset($request->project_status) && $request->project_status == 4 ? 1 : 0;
        $property->save();

        $project_status_log = new ProjectStatusLog();
        $project_status_log->property_id = $request->property_id;
        $project_status_log->project_status = isset($request->project_status) ? $request->project_status : null;
        $project_status_log->project_expected_date_of_start = isset($request->project_expected_date_of_start) ? $request->project_expected_date_of_start : null;
        $project_status_log->project_expected_date_of_completion = isset($request->project_expected_date_of_completion) ? $request->project_expected_date_of_completion : null;
        $project_status_log->project_date_of_completion = isset($request->project_date_of_completion) ? $request->project_date_of_completion : null;
        $project_status_log->created_by = Auth::user()->id;
        $project_status_log->save();

        if (isset($request->tower)) {
            $tower = Tower::find($request->tower);
            $tower->tower_status = isset($request->tower_status) ? $request->tower_status : null;
            $tower->tower_expected_date_of_start = isset($request->tower_expected_date_of_start) ? $request->tower_expected_date_of_start : null;
            $tower->tower_expected_date_of_completion = isset($request->tower_expected_date_of_completion) ? $request->tower_expected_date_of_completion : null;
            $tower->tower_date_of_completion = isset($request->tower_date_of_completion) ? $request->tower_date_of_completion : null;
            $tower->construction_stage = isset($request->construction_stage) ? $request->construction_stage : null;
            $tower->floor_range = isset($request->floor_range) ? $request->floor_range : null;
            $tower->status = isset($request->tower_status) && $request->tower_status == 4 ? '0' : '1';
            $tower->save();

            $tower_log = new TowerLog();
            $tower_log->property_status_log_id = $project_status_log->id;
            $tower_log->property_id = $request->property_id;
            $tower_log->tower_id = $request->tower;
            $tower_log->tower_status = isset($request->tower_status) ? $request->tower_status : null;
            $tower_log->tower_expected_date_of_start = isset($request->tower_expected_date_of_start) ? $request->tower_expected_date_of_start : null;
            $tower_log->tower_expected_date_of_completion = isset($request->tower_expected_date_of_completion) ? $request->tower_expected_date_of_completion : null;
            $tower_log->tower_date_of_completion = isset($request->tower_date_of_completion) ? $request->tower_date_of_completion : null;
            $tower_log->construction_stage = isset($request->construction_stage) ? $request->construction_stage : null;
            $tower_log->floor_range = isset($request->floor_range) ? $request->floor_range : null;
            $tower_log->created_by = Auth::user()->id;
            $tower_log->save();
        }
        $towers = TowerLog::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->get();
        $project_status_log = ProjectStatusLog::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->get();
        // dd($project_status_log);
        $disabled_options = self::get_project_tower_disabled_options($property);
        $status_list = view('admin.pages.property.commercial_tower_gated_community.project_status.index_log', get_defined_vars())->render();
        return response()->json(
            [
                'status' => true,
                'statusList' => $status_list,
                'disabled_options' => $disabled_options,
                'message' => 'Project Status Updated Successfully.',
            ],
            200,
        );
    }

    public function project_status_fields(Request $request)
    {
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        $toggle_class_name = $request->class_name;

        $tower_type = $property->cat_id == config('constants.COMMERCIAL') ? 1 : 2;
        $options = ProjectStatusFilterField::where('type', $request->type)
            ->where('status_id', $request->status_id)
            ->where('construction_stage_id', $request->construction_stage)
            ->where('tower_type', $tower_type)
            ->get();

        return view('admin.pages.property.commercial_tower_gated_community.project_status_fields', get_defined_vars());
    }

    public function project_status_history(Request $request)
    {
        $property = Property::find($request->property_id);
        $project_status_log = ProjectStatusLog::where('property_id', $property->id)
            ->orderBy('id', 'DESC')
            ->get();
        // $towers = Tower::where('property_id', $request->property_id)->where('tower_status', '!=', '')->get();
        $towers = TowerLog::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->get();
        $status_history = view('admin.pages.property.commercial_tower_gated_community.project_status.index_log', get_defined_vars())->render();
        return response()->json(
            [
                'status' => true,
                'statusList' => $status_history,
                'message' => 'Project Status Updated Successfully.',
            ],
            200,
        );
    }

    public function disabled_options(Request $request)
    {
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        if ($property) {
            $disabled_options = self::get_project_tower_disabled_options($property);
            return response()->json(['disabled_options' => $disabled_options], 200);
        }
        return response()->json(['msg' => 'Log not found with this property.'], 404);
    }
    public function get_project_tower_disabled_options($property)
    {
        $status_logs = ProjectStatusLog::where('property_id', $property->id)
            ->distinct()
            ->pluck('project_status')
            ->toArray();
        $disabled_options = [];
        if (count($status_logs)) {
            in_array(config('constants.PROJECT_STATUS.UNDER_CONSTRUCTION'), $status_logs) ? array_push($disabled_options, config('constants.PROJECT_STATUS.GROUNDED')) : '';
            in_array(config('constants.PROJECT_STATUS.COMPLETED'), $status_logs) || in_array(config('constants.PROJECT_STATUS.EXTERIOR_WORKS'), $status_logs) ? ($disabled_options = [config('constants.PROJECT_STATUS.GROUNDED'), config('constants.PROJECT_STATUS.UNDER_CONSTRUCTION')]) : '';
        }
        return $disabled_options;
    }
}
