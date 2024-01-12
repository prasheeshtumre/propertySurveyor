<?php

use App\Models\{Category, SubCategory, PropertyImage, Property, FloorUnitCategory, Tower, FloorUnitMap, PropertyFloorMap, Builder, ProjectStatusFilterField, ConstructionStage, ProjectStatus};
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;


if (!function_exists('get_psdd_options')) {
    function get_psdd_options($model, $property_id, $level, $field_title, $tower_type)
    {
        $options = '<option value="" selected>--Choose ' . $field_title . '--</option>';
        $model_name = $model;
        $model = 'App\Models\\' . $model;

        if ($model_name == 'Tower') {
            $data = $model
                ::where('property_id', $property_id)
                ->where('no_of_towers', '>', 0)
                ->where('status', '1')
                ->get();

            foreach ($data as $key => $value) {
                $options .= '<option value="' . $value->id . '" data-def_psddop_name="field-options-s' . $level . '" data-level="' . $level . '">' . $value->tower_name . '</option>';
            }
        } elseif ($model_name == 'ProjectStatus') {
            $data = $model
                ::where('status', '1')
                ->orderBy('sort_by', 'ASC')
                ->get();
            foreach ($data as $key => $value) {
                $options .= '<option value="' . $value->id . '" data-def_psddop_name="field-options-s' . $level . '" data-level="' . $level . '">' . $value->name . '</option>';
            }
        } elseif ($model_name == 'ConstructionStage') {
            $data = $model::all();
            $totl_records = $tower_type == 1 ? $data->count() : 1;
            foreach ($data->take($totl_records) as $key => $value) {
                $options .= '<option value="' . $value->id . '" data-def_psddop_name="field-options-s' . $level . '" data-level="' . $level . '">' . $value->stage_name . '</option>';
            }
        } elseif ($model_name == 'FloorRangesPerTower') {
            $data = $model::all();
            foreach ($data as $key => $value) {
                $options .= '<option value="' . $value->id . '" data-def_psddop_name="field-options-s' . $level . '" data-level="' . $level . '">' . $value->floor_range . '</option>';
            }
        }

        return $options;
    }
}

if (!function_exists('get_project_status')) {
    function get_project_status($id)
    {
        $status = ProjectStatus::where('id', $id)->value('name');
        $status = !empty($status) ? $status : '';
        return $status;
    }
}

if (!function_exists('get_response_description')) {
    function get_response_description($response_code)
    {
        $response_descriptions = [
            '100' => 'Continue',
            '101' => 'Switching Protocols',
            '200' => 'OK',
            '201' => 'Created',
            '202' => 'Accepted',
            '203' => 'Non-Authoritative Information',
            '204' => 'No Content',
            '205' => 'Reset Content',
            '206' => 'Partial Content',
            '300' => 'Multiple Choices',
            '301' => 'Moved Permanently',
            '302' => 'Found',
            '303' => 'See Other',
            '304' => 'Not Modified',
            '305' => 'Use Proxy',
            '307' => 'Temporary Redirect',
            '400' => 'Bad Request',
            '401' => 'Unauthorized',
            '402' => 'Payment Required',
            '403' => 'Forbidden',
            '404' => 'Not Found',
            '405' => 'Method Not Allowed',
            '406' => 'Not Acceptable',
            '407' => 'Proxy Authentication Required',
            '408' => 'Request Timeout',
            '409' => 'Conflict',
            '410' => 'Gone',
            '411' => 'Length Required',
            '412' => 'Precondition Failed',
            '413' => 'Payload Too Large',
            '414' => 'URI Too Long',
            '415' => 'Unsupported Media Type',
            '416' => 'Range Not Satisfiable',
            '417' => 'Expectation Failed',
            '418' => "I'm a Teapot",
            '500' => 'Internal Server Error',
            '501' => 'Not Implemented',
            '502' => 'Bad Gateway',
            '503' => 'Service Unavailable',
            '504' => 'Gateway Timeout',
            '505' => 'HTTP Version Not Supported',
            // ... add more response codes and descriptions as needed
        ];

        return $response_descriptions[$response_code] ?? 'Unknown Response Code';
    }
}

if (!function_exists('exception_logging')) {
    function exception_logging($e)
    {
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
            $exceptionMessage = $e->getMessage() ?? 'No message available';
        }

        // Validate the status code range
        if ($statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500;
        }

        // Get the response message based on the status code
        $message = get_response_description($statusCode);

        $response = [
            'status_code' => $statusCode,
            'message' => $message,
            'exception' => $exceptionMessage,
            'user'      => Auth::user()->name
        ];

        // Log the information
        Log::channel('exception')->info('Details', $response);
        return response()->json($response);
    }
}
