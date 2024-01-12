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
     GisIDMapping
    };

use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function backupDatabase()
    {
        $property = Property::find(2742);
        $splits = Property::where('parent_split_id', $property->parent_split_id)->get();
        $splits = ($splits) ? $splits->count() : 0;
        $merges = GisIDMapping::where('gis_id' ,$property->gis_id)->pluck('merge_id')->toArray();
        
        return User::get();
        // return "hi";
          $properties = Property::where('created_by', 1)->pluck('id')->toArray();
        Property::whereIn('id',  $properties)->delete();
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
