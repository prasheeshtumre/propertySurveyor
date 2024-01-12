<?php

namespace App\Repositories;

use App\DTO\BuilderSubGroupSearchRequestDTO;
use App\Models\{Area, Builder, City, Pincode, PropertyBuilderSubGroup, PropertyImage, UnitImage};
use Illuminate\Http\Request;
use DB;

class BuilderSubGroupRepository implements IBuilderSubGroupRepository
{

    public function getSuggestions(BuilderSubGroupSearchRequestDTO $builderSubGroupSearchRequestDTO)
    {
        try {
            $builderKey = $builderSubGroupSearchRequestDTO->searchKey ?? '';
            $buildersArr = $builderSubGroupSearchRequestDTO->builderIdArr ?? [];
            $suggestions = Builder::with(['sub_groups' => function ($query) use ($builderKey) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($builderKey) . '%']);
            }])
                ->whereIn('id', $buildersArr)->get();
            // ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($builderKey) . '%'])
            return $suggestions;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function createPropertyBuilderSubGroup($builderSubGroupId, $propertyId)
    {
        try {
            DB::table('property_builder_sub_group')->insert(['builder_sub_group_id' => $builderSubGroupId, 'property_id' => $propertyId]);
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function updatePropertyBuilderSubGroup($builderSubGroupId, $propertyId)
    {
        try {
            $check = DB::table('property_builder_sub_group')->where(['builder_sub_group_id' => $builderSubGroupId, 'property_id' => $propertyId])->first();
            if (!$check) {
                DB::table('property_builder_sub_group')->insert(['builder_sub_group_id' => $builderSubGroupId, 'property_id' => $propertyId]);
            }
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
