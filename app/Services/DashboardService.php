<?php

namespace App\Services;

use App\DTO\NotificationRequestDTO;
use App\DTO\NotificationResponseDTO;
use App\Repositories\IDashboardRepository;

class DashboardService
{
    private $dashboardRepository;

    public function __construct(IDashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getThisDayProperties(): int
    {
        return $this->dashboardRepository->thisDayProperties();
    }

    public function getThisMonthProperties(): int
    {
        return $this->dashboardRepository->thisMonthProperties();
    }

    public function getThisWeekProperties(): int
    {
        return $this->dashboardRepository->thisWeekProperties();
    }

    public function getForSalePropertiesBefore30Days(): int
    {
        return $this->dashboardRepository->forSalePropertiesBefore30Days();
    }

    public function getForRentPropertiesBefore30Days(): int
    {
        return $this->dashboardRepository->forRentPropertiesBefore30Days();
    }

    public function getVacantPropertiesBefore30Days(): int
    {
        return $this->dashboardRepository->forVacantPropertiesBefore30Days();
    }

    public function getUnderConstructionPropertiesBefore30Days(): int
    {
        return $this->dashboardRepository->underConstructionPropertiesBefore30Days();
    }


}
