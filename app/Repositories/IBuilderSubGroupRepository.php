<?php

namespace App\Repositories;

use App\DTO\BuilderSubGroupSearchRequestDTO;
use App\Models\PushNotification;
use Illuminate\Http\Request;

interface IBuilderSubGroupRepository
{
    public function getSuggestions(BuilderSubGroupSearchRequestDTO $builderSubGroupSearchRequestDTO);
    public function createPropertyBuilderSubGroup($builderSubGroupId, $propertyId);
    public function updatePropertyBuilderSubGroup($builderSubGroupId, $propertyId);
}
