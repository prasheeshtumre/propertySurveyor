<?php

namespace App\Services;

use App\DTO\BuilderSearchRequestDTO;
use App\DTO\BuilderSubGroupSearchRequestDTO;
use App\Models\Property;
use App\Models\UnitImage;
use App\Repositories\IBuilderRepository;
use App\Repositories\IBuilderSubGroupRepository;
use File;
use Illuminate\Http\Request;
use DB;

class BuilderSubGroupService
{
    private $builderSubGroupRepository;

    public function __construct(IBuilderSubGroupRepository $builderSubGroupRepository)
    {
        $this->builderSubGroupRepository = $builderSubGroupRepository;
    }

    public function getSuggestions(BuilderSubGroupSearchRequestDTO $builderSubGroupSearchRequestDTO)
    {
        $suggestions = $this->builderSubGroupRepository->getSuggestions($builderSubGroupSearchRequestDTO);
        return view('admin.pages.builder_sub_group.partials.suggestions', ['suggestions' => $suggestions, 'builderSubGroupIds' => $builderSubGroupSearchRequestDTO->builderSGIdArr]);
    }

    public function createPropertyBuilderSubGrops($builderArr, $propertyId)
    {
        try {
            foreach ($builderArr as $key => $builderId) {
                $this->builderSubGroupRepository->createPropertyBuilderSubGroup($builderId, $propertyId);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updatePropertyBuilderSubGrops($builderArr, $propertyId)
    {
        try {

            $property = Property::find($propertyId);
            $existingBuilderSubGroups = [];
            $existingBuilderSubGroups = $property->builderSubGroups->pluck('id')->toArray();
            $builderSubGroupsToBeRemoved = array_diff($existingBuilderSubGroups, $builderArr ?? []);
            $builderSubGroupsToBeAdded = array_diff($builderArr ?? [], $existingBuilderSubGroups);

            if (count($builderSubGroupsToBeRemoved) > 0) {
                DB::table('property_builder_sub_group')->where('property_id', $propertyId)->whereIn('builder_sub_group_id', $builderSubGroupsToBeRemoved)->delete();
            }

            foreach ($builderSubGroupsToBeAdded as $key => $builderId) {
                $this->builderSubGroupRepository->updatePropertyBuilderSubGroup($builderId, $propertyId);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
