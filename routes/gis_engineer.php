<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebGis\WebGisController;
use App\Http\Controllers\GisEngineer\{DashboardController, PropertyController, GISIDImportController,
     SecondaryController, SurveyorController, PropertyImagesController, AmenitiesController, CompliancesController, GatedCommunityDetailsController, GetProjectStatusFilterFieldsController, ProjectStatusController, PriceTrendsController, CategoryController, TaskController, UnitController, HospitalityController, UnitOfficeController, PlotlandController, UnitRetailController, ServicedApartmentsController, GatedCommunityController, UnitDemolishedController, UnitOtherController, UnitStorageController, OneRkController, GISIDController, BackupController, TowerStatusController, GenerateGISIDController
};
use App\Http\Controllers\CommercialTowerGatedCommunity\{CommercialTowerController, CTAmmenitiesController, CTCompliancesController, CTProjectStatusController, CTTowerStatusController};
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\QueryException;

/*
|--------------------------------------------------------------------------
| gis_engineer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register gis_engineer routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "gis_engineer" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'role:gis-engineer'])->group(function () {
    Route::group(['as' => 'gis-engineer.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/filter/{type?}', [PropertyController::class, 'index'])->name('properties');
        
        Route::group(['prefix' => 'geo-ids-import', 'as' => 'geo-ids-import.'], function () {
            Route::get('/', [GISIDImportController::class, 'index'])->name('index');
            // Route::post('/', [GISIDImportController::class, 'store'])->name('store');
            Route::post('/', [GISIDImportController::class, 'processGeoIds'])->name('store');
        });
        
         Route::group(['prefix' => 'property'], function () {
            Route::get('/reports/{type?}', [PropertyController::class, 'ajaxReports'])->name('reports');
            Route::post('/', [PropertyController::class, 'store'])->name('property.store');
            Route::post('/store_detto', [PropertyController::class, 'store_detto'])->name('property.store_detto');
            Route::get('/demo-reports', [PropertyController::class, 'reports'])->name('property.demo-reports');
            Route::get('/reports', [PropertyController::class, 'ajaxReports'])->name('property.reports');
            Route::get('/ajaxGet', [PropertyController::class, 'ajaxGet'])->name('property.ajax-get');
            Route::get('/reports/{type}', [PropertyController::class, 'reportsByType'])->name('property.type-reports');

            Route::get('/report_details/{id}/{type?}', [PropertyController::class, 'show'])->name('property.report_details');
            Route::get('/edit_details/{id}', [PropertyController::class, 'edit'])->name('property.edit_details');
            
            Route::get('/edit_details/{id}/splits', [PropertyController::class, 'editSplits'])->name('property.edit_details.splits');
            Route::get('/edit_details/{id}/merged', [PropertyController::class, 'editMerged'])->name('property.edit_details.splits.merged');
            Route::get('/edit_details/{id}/temporary-gis-id', [PropertyController::class, 'editTemporaryGisId'])->name('property.edit_details.temporary-gis-id');

            Route::post('/update-details/{id}/splits', [PropertyController::class, 'updateSplits'])->name('property.update-details.splits');
            Route::post('/update-details/{id}/merged', [PropertyController::class, 'updateMerged'])->name('property.update-details.merged');
            Route::post('/update-details/{id}/temporary-gis-id', [PropertyController::class, 'updateTemporaryGisId'])->name('property.update-details.temporary-gis-id');
            
            Route::post('/update_details/{id}', [PropertyController::class, 'update'])->name('property.update_details');
            Route::get('/completed', [PropertyController::class, 'completed'])->name('completed');
            Route::get('update', [PropertyController::class, 'update_screen'])->name('update_screen');

            // Route::get('/unit_details/{unit_id}/{proprty_id}/{unit_type_id}/{unit_cat_id}', [UnitController::class, 'unitDetails'])->name('property.unit_details');
            Route::get('/unit_details/{unit_id}/{residential_type?}', [UnitController::class, 'unitDetails'])->name('property.unit_details');
            Route::get('/unit-details-dfd/{unit_id}/{residential_type?}', [UnitController::class, 'unitDetails_dfd'])->name('property.unit_details-dfd');
            Route::get('/edit_unit_details/{unit_id}/{residential_type?}', [UnitController::class, 'editUnitDetails'])->name('property.edit.unit_details');
            Route::get('/plot-land/edit_unit_details/{prop_id}', [UnitController::class, 'editPlotLandDetails'])->name('property.edit.plot_land_details');
            Route::post('/add-unit-apartment-type/{unit_id}', [UnitController::class, 'unitApartmentType'])->name('property.unit_details.apartment_type');
            Route::get('plot-land/unit_details/{prop_id}', [UnitController::class, 'plotLandUnitDetails'])->name('property.plot_land.unit_details');
            Route::any('add-sub-category/{unit_id}', [UnitController::class, 'addSubCategory'])->name('property.unit_details.addSubCategory');
            Route::post('get-sub-categories', [UnitController::class, 'getSubCategories'])->name('property.unit_details.getSubCategories');

            Route::group(['prefix' => 'unit_details/commercial/office/'], function () {
                Route::post('store-property-details', [UnitOfficeController::class, 'storeCommOfcPropertyDetails'])->name('property.unit_details.commercial.office.store_property_details');
                Route::post('store-pricing-details', [UnitOfficeController::class, 'storePricingDetails'])->name('property.unit_details.commercial.office.store_pricing_details');
                Route::post('store-images', [UnitOfficeController::class, 'storeImages'])->name('property.unit_details.commercial.office.store_images');
                Route::post('update-images', [UnitOfficeController::class, 'updateImages'])->name('property.unit_details.commercial.office.update_images');
                Route::post('store-amenitis', [UnitOfficeController::class, 'storeAmenities'])->name('property.unit_details.commercial.office.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/commercial/retail/'], function () {
                Route::post('store-property-details', [UnitRetailController::class, 'storeCommOfcPropertyDetails'])->name('property.unit_details.commercial.retail.store_property_details');
                Route::post('store-pricing-details', [UnitRetailController::class, 'storePricingDetails'])->name('property.unit_details.commercial.retail.store_pricing_details');
                Route::post('update-images', [UnitRetailController::class, 'updateImages'])->name('property.unit_details.commercial.retail.update_images');
                Route::post('store-images', [UnitRetailController::class, 'storeImages'])->name('property.unit_details.commercial.retail.store_images');
                Route::post('store-amenitis', [UnitRetailController::class, 'storeAmenities'])->name('property.unit_details.commercial.retail.store_amenities');
            });

            Route::group(['prefix' => 'unit_details/commercial/storage/'], function () {
                Route::post('store-property-details', [UnitStorageController::class, 'storeCommOfcPropertyDetails'])->name('property.unit_details.commercial.storage.store_property_details');
                Route::post('store-pricing-details', [UnitStorageController::class, 'storePricingDetails'])->name('property.unit_details.commercial.storage.store_pricing_details');
                Route::post('store-images', [UnitStorageController::class, 'storeImages'])->name('property.unit_details.commercial.storage.store_images');
                Route::post('update-images', [UnitStorageController::class, 'updateImages'])->name('property.unit_details.commercial.storage.update_images');
                Route::post('store-amenitis', [UnitStorageController::class, 'storeAmenities'])->name('property.unit_details.commercial.storage.store_amenities');
            });

            Route::group(['prefix' => 'unit_details/commercial/other/'], function () {
                Route::post('store-property-details', [UnitOtherController::class, 'storeCommOfcPropertyDetails'])->name('property.unit_details.commercial.other.store_property_details');
                Route::post('store-pricing-details', [UnitOtherController::class, 'storePricingDetails'])->name('property.unit_details.commercial.other.store_pricing_details');
                Route::post('store-images', [UnitOtherController::class, 'storeImages'])->name('property.unit_details.commercial.other.store_images');
                Route::post('update-images', [UnitOtherController::class, 'updateImages'])->name('property.unit_details.commercial.other.update_images');
                Route::post('store-amenitis', [UnitOtherController::class, 'storeAmenities'])->name('property.unit_details.commercial.other.store_amenities');
            });
            Route::get('/demolished/unit_details/{unit_id}', [UnitDemolishedController::class, 'unitDetails'])->name('property.demolished.unit_details');
            Route::get('/demolished/edit_unit_details/{property_id}', [UnitDemolishedController::class, 'editUnitDetails'])->name('property.demolished.edit_unit_details');
            Route::group(['prefix' => 'unit_details/demolished/'], function () {
                Route::post('store-property-details', [UnitDemolishedController::class, 'storeCommOfcPropertyDetails'])->name('property.unit_details.demolished.store_property_details');
                Route::post('update-property-details', [UnitDemolishedController::class, 'updateCommOfcPropertyDetails'])->name('property.unit_details.demolished.update_property_details');
            });

            Route::group(['prefix' => 'unit_details/commercial/hospitality/'], function () {
                Route::post('store-property-details', [HospitalityController::class, 'storeHospitalityPropertyDetails'])->name('property.unit_details.commercial.hospitality.store_property_details');
                Route::post('store-pricing-details', [HospitalityController::class, 'storeHospitalityPricingDetails'])->name('property.unit_details.commercial.hospitality.store_pricing_details');
                Route::post('store-unit-images', [HospitalityController::class, 'storeHospitalityunitImages'])->name('property.unit_details.commercial.hospitality.store_unit_images');
                Route::post('update-unit-images', [HospitalityController::class, 'updateHospitalityunitImages'])->name('property.unit_details.commercial.hospitality.update_unit_images');
                Route::post('store-amenitis', [HospitalityController::class, 'storeAmenities'])->name('property.unit_details.commercial.hospitality.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/plotland/openplotland/'], function () {
                Route::post('store-property-details', [PlotlandController::class, 'storePlotlandPropertyDetails'])->name('property.unit_details.plotland.openPlotLand.store_property_details');
                Route::post('store-pricing-details', [PlotlandController::class, 'storePlotlandPricingDetails'])->name('property.unit_details.plotland.openPlotLand.store_pricing_details');
                Route::post('store-unit-images', [PlotlandController::class, 'storePlotlandunitImages'])->name('property.unit_details.plotland.openPlotLand.store_images');
                Route::post('update-unit-images', [PlotlandController::class, 'updatePlotlandunitImages'])->name('property.unit_details.plotland.openPlotLand.update_images');
            });
            Route::group(['prefix' => 'unit_details/resedential/servided-apartments/'], function () {
                Route::post('store-property-details', [ServicedApartmentsController::class, 'storeServicedApartmentsDetails'])->name('property.unit_details.resedential.serviced_apartments.store_property_details');
                Route::post('store-pricing-details', [ServicedApartmentsController::class, 'storeServicedApartmentsPricingDetails'])->name('property.unit_details.resedential.serviced_apartments.store_pricing_details');
                Route::post('store-unit-images', [ServicedApartmentsController::class, 'storeServicedApartmentsUnitImages'])->name('property.unit_details.resedential.serviced_apartments.store_unit_images');
                Route::post('edit-unit-images', [ServicedApartmentsController::class, 'updateServicedApartmentsUnitImages'])->name('property.unit_details.resedential.serviced_apartments.edit_unit_images');
                Route::post('store-amenitis', [ServicedApartmentsController::class, 'storeAmenities'])->name('property.unit_details.resedential.serviced_apartments.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/resedential/gated-community/'], function () {
                Route::post('store-property-details', [GatedCommunityController::class, 'storeServicedApartmentsDetails'])->name('property.unit_details.resedential.gated_community.store_property_details');
                Route::post('store-pricing-details', [GatedCommunityController::class, 'storeServicedApartmentsPricingDetails'])->name('property.unit_details.resedential.gated_community.store_pricing_details');
                Route::post('store-unit-images', [GatedCommunityController::class, 'storeServicedApartmentsUnitImages'])->name('property.unit_details.resedential.gated_community.store_unit_images');
                Route::post('edit-unit-images', [GatedCommunityController::class, 'updateServicedApartmentsUnitImages'])->name('property.unit_details.resedential.gated_community.edit_unit_images');
                Route::post('store-amenitis', [GatedCommunityController::class, 'storeAmenities'])->name('property.unit_details.resedential.gated_community.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/resedential/one-rk/'], function () {
                Route::get('edit/{id}', [OneRkController::class, 'editDetails'])->name('property.unit_details.resedential.one_rk.edit_details');
                Route::post('store-property-details', [OneRkController::class, 'storePropertyDetails'])->name('property.unit_details.resedential.one_rk.store_property_details');
                Route::post('store-pricing-details', [OneRkController::class, 'storePricingDetails'])->name('property.unit_details.resedential.one_rk.store_pricing_details');
                Route::post('store-unit-images', [OneRkController::class, 'storeUnitImages'])->name('property.unit_details.resedential.one_rk.store_unit_images');
                Route::post('edit-unit-images', [OneRkController::class, 'updateUnitImages'])->name('property.unit_details.resedential.one_rk.edit_unit_images');
                Route::post('store-amenitis', [OneRkController::class, 'storeAmenities'])->name('property.unit_details.resedential.one_rk.store_amenities');
            });

            Route::group(['prefix' => 'image'], function () {
                Route::post('/store', [PropertyImagesController::class, 'store'])->name('property.image.store');
                Route::post('dropzone/store', [PropertyImagesController::class, 'dropzoneStore'])->name('property.image.dropzone.store');
                Route::get('/destroy/{id}', [PropertyImagesController::class, 'destroy'])->name('property.image.destroy');
            });

            Route::get('csv/export', [PropertyController::class, 'exportCsv'])->name('properties.export.csv');
            Route::get('excel/export', [PropertyController::class, 'exportExcel'])->name('properties.export.excel');
            Route::get('pdf/export', [PropertyController::class, 'exportPdf'])->name('properties.export.pdf');
            Route::post('import', [PropertyController::class, 'import'])->name('import');

            Route::get('/add-gated-comunity', [SecondaryController::class, 'add_gated_comunity'])->name('add_gated_comunity');
            Route::post('/create-blocks', [SecondaryController::class, 'createBlocks'])->name('create-blocks');
            Route::post('/add-amenities-comunity', [GatedCommunityDetailsController::class, 'store_amenities'])->name('add_amminities');

            Route::get('/search-gis', [AmenitiesController::class, 'serach_by_gis'])->name('serach_by_gis');
            Route::post('/search-gis', [AmenitiesController::class, 'serach_by_gis_post'])->name('serach_by_gis_post');

            ////chaitanya routes 26-05-2023
            Route::post('/store-compliances', [CompliancesController::class, 'store_compliances'])->name('store-compliances');
            Route::post('/project-repository', [CompliancesController::class, 'project_repository'])->name('project-repository');
            Route::any('/block-tower-repository', [CompliancesController::class, 'block_tower_repository'])->name('block-tower-repository');
            //Route::any('/block-tower', [CompliancesController::class, 'block_tower_repository'])->name('block-tower');

            Route::get('/gated-community-details/{id}', [GatedCommunityDetailsController::class, 'gated_community_details'])->name('gated-community-details');

            Route::group(['prefix' => 'gated-community-details', 'as' => 'gated-community-details.'], function () {
                Route::get('/edit/{id}', [GatedCommunityDetailsController::class, 'edit'])->name('edit');
                Route::post('/store-amenities', [GatedCommunityDetailsController::class, 'store_amenities'])->name('store_amenities');

                Route::group(['prefix' => 'project-status', 'as' => 'project-status.'], function () {
                    Route::get('/disabled-options', [ProjectStatusController::class, 'disabled_options'])->name('index');
                });
                Route::group(['prefix' => 'tower-status', 'as' => 'tower-status.'], function () {
                    Route::get('/disabled-options', [TowerStatusController::class, 'disabled_options'])->name('index');
                });
            });
        });
    });
    
});
        