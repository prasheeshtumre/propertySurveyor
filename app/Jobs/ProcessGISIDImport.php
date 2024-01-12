<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{ProjectStatus, GeoID, GeoIDUploadedFileLog, UnderConstruction, SecondaryFeatures, SecondaryFeaturesOptions, FloorType, Unit, Property, Category, FloorUnitCategory, Block, Tower, PropertyFloorMap, FloorUnitMap, Ammenitity, PropertyAmenity, Compliances, ProjectRepository, BlockTowerRepository, PropertyAmenityAmenityOption, PriceTrend, ProjectStatusLog, TowerLog};
use Session;
use Auth;

class ProcessGISIDImport implements ShouldQueue 
{
     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $files;
    
    public function __construct($files)
    {
        $this->files = $files;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $files = $this->files;
        // Define the chunk size (number of rows per chunk)
        $chunk_size = 50;
        // Open the CSV file for reading
        $handle = fopen(storage_path('app/' . $files), "r");
        // Skip the header row
        fgetcsv($handle);
        // Read the data from the CSV file in chunks
        $chunks = [];
        while (!feof($handle)) {
            $chunk = [];
            for ($i = 0; $i < $chunk_size && !feof($handle); $i++) {
                $row = fgetcsv($handle);
                if ($row) {
                    $chunk[] = $row;
                }
            }
            if (!empty($chunk)) {
                $chunks[] = $chunk;
            }
        }
        // Close the CSV file
        fclose($handle);
        $progress = 0;
        $chunkCount = count($chunks);
        foreach ($chunks as  $array_values) {
            foreach ($array_values as $key => $chunk) {
                $gis_id = $chunk[0];
                $pincode = $chunk[1];

                $geoId = new GeoID;
                $geoId->gis_id =  $gis_id;
                $geoId->pincode_id = $pincode;
                $geoId->save();

                $progress = ($key + 1) + ($chunkCount * array_search($array_values, $chunks));
                Session::put('import_progress', $progress);
            }
        }
        return Session::get('import_progress', $progress);
    }
}
