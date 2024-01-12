<?php

namespace App\Repositories;

use App\DTO\NotificationRequestDTO;
use App\DTO\NotificationResponseDTO;
use App\Models\PushNotification;

interface IDashboardRepository
{
    public function thisDayProperties(): int;
    public function thisMonthProperties(): int;
    public function thisWeekProperties(): int;
    public function forSalePropertiesBefore30Days(): int;
    public function forRentPropertiesBefore30Days(): int;
    public function forVacantPropertiesBefore30Days(): int;
    public function underConstructionPropertiesBefore30Days(): int;
}
