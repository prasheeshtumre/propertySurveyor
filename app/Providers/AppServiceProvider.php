<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\IBuilderRepository;
use App\Repositories\BuilderRepository;
use App\Services\BuilderService;

use App\Repositories\ICityRepository;
use App\Repositories\CityRepository;
use App\Services\CityService;

use App\Repositories\IAreaRepository;
use App\Repositories\AreaRepository;
use App\Services\AreaService;

use App\Repositories\IConstructionPartnerRepository;
use App\Repositories\ConstructionPartnerRepository;
use App\Services\ConstructionPartnerService;

use App\Repositories\IBuilderSubGroupRepository;
use App\Repositories\BuilderSubGroupRepository;
use App\Services\BuilderSubGroupService;

use App\Repositories\ISplitGISIDRepository;
use App\Repositories\SplitGISIDRepository;
use App\Services\SplitGISIDService;

use App\Repositories\IMergeGISIDRepository;
use App\Repositories\MergeGISIDRepository;
use App\Services\MergeGISIDService;

use App\Repositories\IGenerateGISIDRepository;
use App\Repositories\GenerateGISIDRepository;
use App\Services\GenerateGISIDService;

use App\Repositories\IGeoCodeRepository;
use App\Repositories\GeoCodeRepository;
use App\Services\GisEngineerPropertyService;

use App\Repositories\GisEngineer\IPropertyRepository as IGEPropertyRepository;
use App\Repositories\GisEngineer\PropertyRepository as GEPropertyRepository;

use App\Repositories\Units\IUnitImagesRepository;
use App\Repositories\Units\UnitImagesRepository;
use App\Services\Units\UnitImagesService;


use App\Repositories\IDashboardRepository;
use App\Repositories\DashboardRepository;
use App\Services\DashboardService;

use App\Repositories\GatedCommunity\BlockRepositoryFilesRepository;
use App\Repositories\GatedCommunity\IBlockRepositoryFilesRepository;
use App\Services\GatedCommunity\BlockRepositoryFilesService;

use App\Repositories\GatedCommunity\IProjectRepositoryFilesRepository;
use App\Repositories\GatedCommunity\ProjectRepositoryFilesRepository;
use App\Services\GatedCommunity\ProjectRepositoryFilesService;

use App\Repositories\GatedCommunity\ComplianceFilesRepository;
use App\Repositories\GatedCommunity\IComplianceFilesRepository;
use App\Services\GatedCommunity\CompliancesFileService;

use App\Repositories\CommercialTower\CTComplianceFilesRepository;
use App\Repositories\CommercialTower\ICTComplianceFilesRepository;
use App\Services\CommercialTower\CTCompliancesFileService;

use App\Repositories\CommercialTower\ICTProjectRepositoryFilesRepository;
use App\Repositories\CommercialTower\CTProjectRepositoryFilesRepository;
use App\Services\CommercialTower\CTProjectRepositoryFilesService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(IBuilderRepository::class, BuilderRepository::class);
        $this->app->bind(BuilderService::class, BuilderService::class);

        $this->app->bind(IConstructionPartnerRepository::class, ConstructionPartnerRepository::class);
        $this->app->bind(ConstructionPartnerService::class, ConstructionPartnerService::class);

        $this->app->bind(IBuilderSubGroupRepository::class, BuilderSubGroupRepository::class);
        $this->app->bind(BuilderSubGroupService::class, BuilderSubGroupService::class);

        $this->app->bind(ISplitGISIDRepository::class, SplitGISIDRepository::class);
        $this->app->bind(SplitGISIDService::class, SplitGISIDService::class);

        $this->app->bind(IMergeGISIDRepository::class, MergeGISIDRepository::class);
        $this->app->bind(MergeGISIDService::class, MergeGISIDService::class);

        $this->app->bind(IGenerateGISIDRepository::class, GenerateGISIDRepository::class);
        $this->app->bind(GenerateGISIDService::class, GenerateGISIDService::class);

        $this->app->bind(IGeoCodeRepository::class, GeoCodeRepository::class);
        $this->app->bind(GisEngineerPropertyService::class, GisEngineerPropertyService::class);
        $this->app->bind(IGEPropertyRepository::class, GEPropertyRepository::class);

        $this->app->bind(IDashboardRepository::class, DashboardRepository::class);
        $this->app->bind(DashboardService::class, DashboardService::class);

        $this->app->bind(IUnitImagesRepository::class, UnitImagesRepository::class);
        $this->app->bind(UnitImagesService::class, UnitImagesService::class);

        $this->app->bind(IProjectRepositoryFilesRepository::class, ProjectRepositoryFilesRepository::class);
        $this->app->bind(ProjectRepositoryFilesService::class, ProjectRepositoryFilesService::class);
        $this->app->bind(IBlockRepositoryFilesRepository::class, BlockRepositoryFilesRepository::class);
        $this->app->bind(BlockRepositoryFilesService::class, BlockRepositoryFilesService::class);

        $this->app->bind(IComplianceFilesRepository::class, ComplianceFilesRepository::class);
        $this->app->bind(CompliancesFileService::class, CompliancesFileService::class);

        $this->app->bind(ICTComplianceFilesRepository::class, CTComplianceFilesRepository::class);
        $this->app->bind(CTCompliancesFileService::class, CTCompliancesFileService::class);

        $this->app->bind(ICTProjectRepositoryFilesRepository::class, CTProjectRepositoryFilesRepository::class);
        $this->app->bind(CTProjectRepositoryFilesService::class, CTProjectRepositoryFilesService::class);
        $this->app->bind(ICityRepository::class, CityRepository::class);
        $this->app->bind(CityService::class, CityService::class);

        $this->app->bind(IAreaRepository::class, AreaRepository::class);
        $this->app->bind(AreaService::class, AreaService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'local') {
            \URL::forceScheme('https');
        }
    }
}
