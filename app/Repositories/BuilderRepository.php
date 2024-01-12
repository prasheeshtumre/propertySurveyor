<?php

namespace App\Repositories;

use App\DTO\AreaRequestDTO;
use App\DTO\BuilderSearchRequestDTO;
use App\Models\{Area, Builder, City, Pincode, PropertyBuilder, PropertyImage, UnitImage};
use Illuminate\Http\Request;
use DB;
use File;
use FFMpeg\Format\Video\X264;
use FFMpeg;

class BuilderRepository implements IBuilderRepository
{

    public function getSuggestions(BuilderSearchRequestDTO $builderSearchRequestDTO)
    {
        try {
            $builderKey = $builderSearchRequestDTO->searchKey;
            $suggestions = Builder::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($builderKey) . '%'])->paginate(10);
            return $suggestions;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function createPropertyBuilder($builderId, $propertyId)
    {
        try {
            DB::table('property_builder')->insert(['builder_id' => $builderId, 'property_id' => $propertyId]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function updatePropertyBuilder($builderId, $propertyId)
    {
        try {
            $check = DB::table('property_builder')->where(['builder_id' => $builderId, 'property_id' => $propertyId])->first();
            if (!$check) {
                DB::table('property_builder')->insert(['builder_id' => $builderId, 'property_id' => $propertyId]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
