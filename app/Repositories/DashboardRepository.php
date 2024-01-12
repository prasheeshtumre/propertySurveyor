<?php

namespace App\Repositories;

use App\DTO\NotificationRequestDTO;
use App\DTO\NotificationResponseDTO;
use App\Models\property;
use Auth;
use Carbon\Carbon;

class DashboardRepository implements IDashboardRepository
{
    public function thisDayProperties(): int
    {
        $properties = Property::whereDate('created_at', Carbon::today())
                                ->where('created_by', Auth::user()->id)
                                ->count();
        return $properties;
    }
    public function thisMonthProperties(): int
    {
        $properties = Property::whereMonth('created_at', Carbon::now()->month)
                                ->where('created_by', Auth::user()->id)
                                ->count();
            return $properties;
    }
    public function thisWeekProperties(): int
    {
        $properties = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                ->where('created_by', Auth::user()->id)
                                ->count();
            return $properties;
    }

    public function forSalePropertiesBefore30Days(): int
    {
        $properties = property::where(function ($query) {
            $query->orWhere('up_for_sale', 1);
            if (true) {
                $query->orWhereHas('floors', function ($floorsQuery)  {
                    $floorsQuery->where('up_for_sale', 1);
                });
            }
        })
        ->whereDate('created_at', '<=', now()->subDays(30))
        ->where('created_by', auth()->id())
        ->get();
        return count($properties);
    }
    public function forRentPropertiesBefore30Days(): int
    {
        $properties = property::where(function ($query) {
            $query->orWhere('up_for_rent', 1);
            if (true) {
                $query->orWhereHas('floors', function ($floorsQuery)  {
                    $floorsQuery->where('up_for_rent', 1);
                });
            }
        })
        ->whereDate('created_at', '<=', now()->subDays(30))
        ->where('created_by', auth()->id())
        ->get();
        return count($properties);
    }

    public function forVacantPropertiesBefore30Days(): int
    {
        $properties = property::whereHas('floor_units', function ($query) {
            $query->where('unit_type_id', 1);
        })
        ->whereDate('created_at', '<=', now()->subDays(30))
        ->where('created_by', auth()->id())
        ->get();
        return count($properties);
    }

    public function underConstructionPropertiesBefore30Days(): int
    {
        $properties = Property::where('cat_id', 5)
                                    ->whereDate('created_at', '<=', now()->subDays(90))
                                    ->where('created_by', Auth::user()->id)
                                    ->get();
        return count($properties);
    }
}
