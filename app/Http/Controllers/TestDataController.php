<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use App\Models\{
    Property,
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
    PriceTrend,
    ProjectRepository,
    ProjectRepositoryImages,
    SecondaryUnitLevelData,
    UnitAmenityOptionValue,
    UnitImage,
    ProjectStatusLog,
};
use DB;
use Illuminate\Support\Facades\File;


class TestDataController extends Controller
{
    public function removeTestData()
    {

        return $properties = Property::where('created_by', 1)->pluck('id')->toArray();
        // Property::whereIn('id',s  $properties)->delete();
        try {
            foreach ($properties  as $key => $property) {
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
                TowerLog::where('property_id', $property->id)->delete();

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

                PriceTrend::where('property_id', $property->id)->delete();

                //repositories
                $propjectRepositories = ProjectRepository::where('property_id', $property->id)->pluck('id')->toArray();
                //repository images
                ProjectRepositoryImages::where('property_id', $property->id)->whereIn('repository_id', $propjectRepositories)->delete();
                ProjectRepository::whereIn('id', $propjectRepositories)->delete();

                // unit data
                $unit_data = SecondaryUnitLevelData::where('property_id', $property->id)->delete();
                // Compliances Images
                $unit_data_amenities = UnitAmenityOptionValue::whereIn('property_id', $property->id)->delete();

                UnitImage::where('property_id', $property->id)->pluck('id')->delete();
                ProjectStatusLog::where('property_id', $property->id)->pluck('id')->delete();

                // unit price log
                
            }
            // Property::whereIn('id', $properties)->delete();
        } catch (\Exception $e) {
            $statusCode = $e->getCode();
        }

        // OtherCompliances::where('property_id', $property->id)->delete(); 
        // // (1-Project Repository,2-Block/Tower Repository), (repository_id)

    }
}
