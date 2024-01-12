<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use App\Models\{Property,
     FloorUnitMap,
     PropertyFloorMap,
     Block,
     Tower,
     PropertyAmenityAmenityOption,
     BlockTowerRepository,
     BlockTowerRepositoryImages,
     Compliances,
     CompliancesImages,
     User,
     GisIDMapping,
     SecondaryUnitLevelData,
    UnitAmenityOptionValue,
    UnitImage,
    ProjectStatusLog,
    };
use DB;
    use Illuminate\Support\Facades\File;


class BackupController extends Controller
{
   
    public function backupDatabase()
    {
        $tables = DB::select("SELECT table_name FROM information_schema.columns WHERE table_schema = 'public'");
        $tableNames = [];
        $webGisTables = [
            'DUMMY_FOR_BHANU',
            'GHMC_Boundary',
            'Link_Roads',
            'Metro_Proposed_Line',
            'Metro_locations',
            'Parcel',
            'Pincode_Boundarys',
            'RRR_North_South_Boundarys',
            'RRR_Villages_Points',
            'Road_Centerline',
            'Road_Polygon',
            'spatial_ref_sys',
            'geography_columns',
            'geography_columns',
            'raster_columns',
            'raster_overviews',
            'geometry_columns'
        ];
        foreach ($tables as $table) {
            foreach ($table as $key => $name) {
                if(!in_array($name, $tableNames) ){
                    array_push($tableNames, $name);
                }
            }
        }
        // return $tables;
        // echo "<pre>";
        // print_r($tables);
        foreach ($tableNames as $key => $tableName) {
           
            if(!in_array($tableName, $webGisTables)){
                // echo $tableName. PHP_EOL;
            // $tableName = 'properties';
            $outputFilePath = public_path('db_backup/'.$tableName.'.csv'); // Replace with desired output file path
    
            $columns = DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = '$tableName'");
    
            $columnNames = array_column($columns, 'column_name');
            $headerString = implode(", ", $columnNames);
    
            // Execute PostgreSQL COPY command using DB facade
            DB::connection('pgsql')->statement(
                "COPY (select * from $tableName) TO '$outputFilePath' WITH CSV"
            );

            // DB::connection('pgsql')->statement(
            //     "COPY (SELECT '$columnNamesString' UNION ALL SELECT * FROM $tableName) TO '$outputFilePath' WITH CSV HEADER"
            // );
    
            
    
            // Specify the relative path to the existing CSV file within the public directory
            $relativeFilePath = 'db_backup/'.$tableName.'.csv';
    
            // Get the absolute path to the CSV file using public_path()
            $absoluteFilePath = public_path($relativeFilePath);
    
            // Read the existing content from the file
            $existingContent = File::get($absoluteFilePath);
    
            // // Define the header string to be added
            // $headerString = "Column1,Column2,Column3\n"; // Modify this according to your CSV header structure
    
            // Prepend the header string to the existing content
            $newContent = $headerString ."\n". $existingContent;
    
            // Write the modified content back to the file
            File::put($absoluteFilePath, $newContent);
    
    
        }
    }
    
        // // Optional: Provide the file for download
        // return response()->download($outputFilePath)->deleteFileAfterSend(true);
       
        
    }
    public function removeTestData()
    {
        $tables = DB::select("SELECT table_name FROM information_schema.columns WHERE table_schema = 'public'");
        $tableNames = [];
        foreach ($tables as $table) {
            
            foreach ($table as $key => $name) {
                if(!in_array($name, $tableNames)){
                    
                    array_push($tableNames, $name);
                }
            }
        }
        // echo "<pre>";
        // print_r($tables);
        foreach ($tableNames as $key => $tableName) {
            // echo $tableName. PHP_EOL;
            // $tableName = 'properties';
            $outputFilePath = public_path('db_backup/'.$tableName.'.csv'); // Replace with desired output file path
    
            $columns = DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = '$tableName'");
    
            $columnNames = array_column($columns, 'column_name');
            $headerString = implode(", ", $columnNames);
    
            // Execute PostgreSQL COPY command using DB facade
            DB::connection('pgsql')->statement(
                "COPY (select * from $tableName) TO '$outputFilePath' WITH CSV"
            );
    
            // DB::connection('pgsql')->statement(
            //     "COPY (SELECT '$columnNamesString' UNION ALL SELECT * FROM $tableName) TO '$outputFilePath' WITH CSV HEADER"
            // );
    
            
    
            // Specify the relative path to the existing CSV file within the public directory
            $relativeFilePath = 'db_backup/'.$tableName.'.csv';
    
            // Get the absolute path to the CSV file using public_path()
            $absoluteFilePath = public_path($relativeFilePath);
    
            // Read the existing content from the file
            $existingContent = File::get($absoluteFilePath);
    
            // // Define the header string to be added
            // $headerString = "Column1,Column2,Column3\n"; // Modify this according to your CSV header structure
    
            // Prepend the header string to the existing content
            $newContent = $headerString ."\n". $existingContent;
    
            // Write the modified content back to the file
            File::put($absoluteFilePath, $newContent);
    
    
        }
    
        // // Optional: Provide the file for download
        // return response()->download($outputFilePath)->deleteFileAfterSend(true);
       
        
    }
    public function removeTestData()
    {
        // $property = Property::find(2742);
        // $splits = Property::where('parent_split_id', $property->parent_split_id)->get();
        // $splits = ($splits) ? $splits->count() : 0;
        // $merges = GisIDMapping::where('gis_id' ,$property->gis_id)->pluck('merge_id')->toArray();
        
        // return User::get();
        // return "hi";
          return $properties = Property::where('created_by', 1)->pluck('id')->toArray();
        // Property::whereIn('id',s  $properties)->delete();
        try{ 
            foreach($properties  as $key=>$property){
            // units
            $units = FloorUnitMap::where('property_id', $property->id)->pluck('id')->toArray();
            FloorUnitMap::whereIn('id',  $units)->delete();

            // floors
            $floors = PropertyFloorMap::where('property_id', $property->id)->pluck('id')->toArray();
            PropertyFloorMap::whereIn('id',  $floors)->delete();

            $blocks = Block::where('property_id', $property->id)->pluck('id')->toArray();
            Block::whereIn('id',  $blocks)->delete();

            $towers = Tower::where('property_id', $property->id)->pluck('id')->toArray();
            Tower::whereIn('id',  $towers)->delete();
            // TowerLog::where('property_id', $property->id)->delete();

            $amenities = PropertyAmenityAmenityOption::where('property_id', $property->id)->pluck('id')->toArray();
            PropertyAmenityAmenityOption::whereIn('id',  $amenities)->delete();

            // Block Tower Repository
            $block_tower_repositories = BlockTowerRepository::where('property_id', $property->id)->pluck('id')->toArray();
            // Block Tower Repository Images
            BlockTowerRepositoryImages::whereIn('block_tower_id', $block_tower_repositories)->delete();
            BlockTowerRepository::whereIn('id', $block_tower_repositories)->delete();

            // Compliances
            $compliances = Compliances::where('property_id', $property->id)->pluck('id')->toArray();
            // Compliances Images
            CompliancesImages::whereIn('comp_id', $compliances)->delete();
            Compliances::whereIn('id', $compliances)->delete();

             // unit data
             $unit_data = SecondaryUnitLevelData::where('property_id', $property->id)->delete();
             // Compliances Images
             $unit_data_amenities = UnitAmenityOptionValue::whereIn('property_id', $property->id)->delete();

             UnitImage::where('property_id', $property->id)->pluck('id')->delete();

             ProjectStatusLog::where('property_id', $property->id)->pluck('id')->delete();

            }

        } catch (\Exception $e) {
            $statusCode = $e->getCode();
        }

        // OtherCompliances::where('property_id', $property->id)->delete(); 
        // // (1-Project Repository,2-Block/Tower Repository), (repository_id)

        // PriceTrend::where('property_id', $property->id)->delete();
        // ProjectRepository::where('property_id', $property->id)->delete();
        // ProjectRepositoryImages::where('property_id', $property->id)->delete(); 
        // // (repository_id)

        // ProjectStatusLog::where('property_id', $property->id)->delete();
       
       
        
    }
}
