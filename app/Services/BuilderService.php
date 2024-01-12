<?php

namespace App\Services;

use App\DTO\BuilderSearchRequestDTO;
use App\Models\Builder;
use App\Models\Property;
use App\Models\PropertyBuilder;
use App\Models\UnitImage;
use App\Repositories\IBuilderRepository;
use File;
use Illuminate\Http\Request;
use DB;

class BuilderService
{
    private $builderRepository;

    public function __construct(IBuilderRepository $builderRepository)
    {
        $this->builderRepository = $builderRepository;
    }

    public function getSuggestions(BuilderSearchRequestDTO $builderSearchRequestDTO)
    {
        $suggestions = $this->builderRepository->getSuggestions($builderSearchRequestDTO);
        return view('admin.pages.builder.partials.suggestions', ['suggestions' => $suggestions, 'choosenBuilders' => $builderSearchRequestDTO->selectedBuilders ?? []]);
    }

    public function createPropertyBuilders($builderArr, $propertyId)
    {
        try {
            foreach ($builderArr as $key => $builderId) {
                $this->builderRepository->createPropertyBuilder($builderId, $propertyId);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updatePropertyBuilders($builderArr, $propertyId)
    {
        try {
            $property = property::find($propertyId);
            $existingBuilders = [];
            $existingBuilders = $property->builders->pluck('id')->toArray();
            $buildersToBeRemoved = array_diff($existingBuilders, $builderArr ?? []);
            $buildersToBeAdded = array_diff($builderArr ?? [], $existingBuilders);

            if (count($buildersToBeRemoved) > 0) {
                DB::table('property_builder')->where('property_id', $propertyId)->whereIn('builder_id', $buildersToBeRemoved)->delete();
            }

            foreach ($buildersToBeAdded as $key => $builderId) {
                $this->builderRepository->updatePropertyBuilder($builderId, $propertyId);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
