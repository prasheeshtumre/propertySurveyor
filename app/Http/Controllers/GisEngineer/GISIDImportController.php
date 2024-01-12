<?php

namespace App\Http\Controllers\GisEngineer;

use Illuminate\Http\Request;
use App\Imports\GISIDsImport; 
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{ProjectStatus, GeoID, GeoIDUploadedFileLog, UnderConstruction, SecondaryFeatures, SecondaryFeaturesOptions, FloorType, Unit, Property, Category, FloorUnitCategory, Block, Tower, PropertyFloorMap, FloorUnitMap, Ammenitity, PropertyAmenity, Compliances, ProjectRepository, BlockTowerRepository, PropertyAmenityAmenityOption, PriceTrend, ProjectStatusLog, TowerLog};
use App\Jobs\ProcessGISIDImport;
use Session;
use Auth;
set_time_limit(0);

class GISIDImportController extends Controller
{
    public function index(Request $request)
    {
        $geo_id_logs = GeoIDUploadedFileLog::orderBy('id', 'DESC')->paginate(50);
        $geo_id_logs_count = count($geo_id_logs);
        // $geo_ids = $geo_ids->;
        if ($request->ajax()) {
            return view('gis_engineer.pages.geo_ids.pagination', ['geo_id_logs' => $geo_id_logs, 'geo_ids_count' => $geo_id_logs_count]);
        }
        return view('gis_engineer.pages.geo_ids.index',get_defined_vars());
    }

    public function processGeoIds(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|file|mimes:csv,txt',
        // ]);

        $files = $request->file('file')->store('excel/temp');
        
        $duplicateErrors = [];
        // Open the CSV file for reading
        $csvFile = fopen(storage_path('app/' . $files), "r");
        $header = fgetcsv($csvFile); // Read the header row
        $header_error = 0;
        $row_data_error = 0;
        if ($header !== false) {
            // // Define the column names you want to check for
            // $requiredColumns = ['gis_id', 'pincode']; // Add the names of the columns you want to check
        
            // foreach ($requiredColumns as $columnName) {
            //     if (!in_array($columnName, $header)) {
            //         $header_error++;
            //     }
            // }
            if(count($header) < 2 || count($header) > 2){
                return redirect()->back()->with('header_error', 'Invalid Headers file uploaded.');
            }
        }
        $total_rows = 0;

        // Iterate through the CSV file line by line
        while ($row = fgetcsv($csvFile)) {
            $gisId = $row[0]; // Assuming "gis_id" is in the first column (index 0)
            
            // Check if the gis_id already exists in the duplicates array
            if (isset($duplicates[$gisId])) {
                $duplicates[$gisId]++;
            } else {
                $duplicates[$gisId] = 1;

            }
            $row_data_error++;
            $total_rows++;
        }
        if($row_data_error == 0){
            return redirect()->back()->with('header_error', 'Data not found.');
        }


        fclose($csvFile);

        // Iterate through the duplicates array to find and display duplicates
        foreach ($duplicates as $gisId => $count) {
            if ($count > 1) {
                $errorMessage = "Duplicate gis_id: $gisId (found $count times)";
                $duplicateErrors[] = $errorMessage;
            }
        }
        if(count($duplicateErrors) > 1){
            return redirect()->back()->with('duplicate_errors', $duplicateErrors);
        }
        Excel::import(new GISIDsImport,request()->file('file'));

        $file = fopen(storage_path('app/' . $files), "r");
        fgetcsv($file);
        $response  = ProcessGISIDImport::dispatch($files);
        // Close CSV file and database connection
        fclose($file);

        $geo_id_uploaded_file = $request->file('file');
        $file_name = uniqid() . "." . $geo_id_uploaded_file->getClientOriginalExtension();
        $geo_id_uploaded_file->move(public_path('/uploads/property/geo_id_uploaded_files/'), $file_name);

        $importProgress = Session::get('import_progress');

        if($total_rows > 0){
            $geoIdUploadedFileLog = new GeoIDUploadedFileLog;
            $geoIdUploadedFileLog->file_name = $file_name;
            $geoIdUploadedFileLog->geo_ids_count = $total_rows;
            $geoIdUploadedFileLog->created_by = Auth::user()->id;
            $geoIdUploadedFileLog->save();
        }

        return redirect()->back()->with('success', 'GIS-ID\'s Successfully imported.');
    }
}
