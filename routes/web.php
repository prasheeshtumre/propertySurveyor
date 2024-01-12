<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\WebGis\WebGisController;
use App\Http\Controllers\Admin\{PropertyController, SecondaryController, SurveyorController, PropertyImagesController, AmenitiesController, GatedCommunityDetailsController, GetProjectStatusFilterFieldsController, ProjectStatusController, PriceTrendsController, CategoryController, TaskController, GISIDController, GISIDImportController, BackupController, TowerStatusController, GenerateGISIDController, CityController, ConstructionPartnerController};
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\BuilderSubGroupController;
use App\Http\Controllers\CommercialTowerGatedCommunity\{CommercialTowerController, CTAmmenitiesController, CTCompliancesController, CTPriceTrendsController, CTProjectStatusController, CTRepositoriesController, CTTowerStatusController};
use App\Http\Controllers\GatedCommunity\{RepositoriesController, BlockRepositoriesController, CompliancesController};
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TestDataController;
use App\Http\Controllers\Unit\{UnitOtherController, UnitStorageController, OneRkController, UnitController, HospitalityController, UnitOfficeController, PlotlandController, UnitRetailController, ServicedApartmentsController, GatedCommunityController, ImageUploadController, UnitDemolishedController};
use App\Models\FloorUnitCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\QueryException;
use App\Models\GISIDSplitLog;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
// use DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', function () {
    return redirect(route('login'));
});

// Route::get('/destroy-area_table', function () {
//     Schema::dropIfExists('gis_id_split_logs');
// });

// Route::get('/destroy-floor_unit_map', function () {
//     Schema::dropIfExists('floor_unit_map');
// });
// Route::get('/destroy-floor_unit_map', function () {
//     Schema::dropIfExists('floor_unit_map');
// });
// Route::get('/test-logs', function () {
//     return GISIDSplitLog::get();
// });

Route::get('clear_cache', function () {
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');
});

Route::get('/grant_permissions', function () {
    // \DB::select('GRANT ALL PRIVILEGES ON "public"."Parcel" TO "propert", "propert_pgdb" WITH GRANT OPTION');
    // GRANT ALL PRIVILEGES ON "public"."Parcel" TO PUBLIC, "propert", "propert_pgdb", GROUP "propert_property_pgdb" WITH GRANT OPTION
    // \DB::select('ALTER SEQUENCE "public"."floor_unit_map_id_seq" RESTART');
    // \DB::select('ALTER TABLE "public"."floor_unit_map" ALTER COLUMN "unit_brand_id" TYPE character varying(255)');
    // \DB::select('ALTER SEQUENCE geo_ids_id_seq RESTART WITH 58459');
    // \DB::select('ALTER SEQUENCE units_id_seq RESTART WITH 5');
    DB::statement('ALTER TABLE unit_price_logs ALTER COLUMN sqft TYPE numeric(10, 2)');
    // Property::where('gis_id', '15910301-de')->delete();
});
Route::get('/backup-database', [BackupController::class, 'backupDatabase']);
// Route::get('/add_cloumn', function () {
//     try {
//     Schema::table('floor_types', function (Blueprint $table) {
//         // $table->string('floor_name')->after('floor_no')->nullable();
//         $table->string('icon_path')->nullable();
//         });
//     } catch (QueryException $e) {
//         echo $e->getMessage();
//         // Handle any potential exceptions
//         // For example, if the column already exists
//         // You can log the error or perform any desired action
//     }
// });
// Route::get('/remove_cloumn', function () {
//     try {
//         Schema::table('floor_unit_map', function (Blueprint $table) {
//             $table->dropColumn('apartment_id');
//         });
//     } catch (QueryException $e) {
//         echo $e->getMessage();
//         // Handle any potential exceptions
//         // For example, if the column already exists
//         // You can log the error or perform any desired action
//     }
// });

Route::get('/add_floor_unit_categories', function () {
    $FloorUnitCategory = new FloorUnitCategory();
    $FloorUnitCategory->name = 'brand name';
    $FloorUnitCategory->created_by = Auth::user()->id;
    $FloorUnitCategory->parent_id = 86;
    $FloorUnitCategory->category_code = 4;
    $FloorUnitCategory->field_type = 'text';
    $FloorUnitCategory->save();
});

Route::get('/update_floor_unit_categories', function () {
    // 9-12
    \DB::table('floor_unit_categories')
        ->where('id', 2)
        ->update(['field_type' => 'select']);
    // \DB::table('categories')->where('id', 14)->update(['blade_slug' => 'primary_data.plot_land_gated_community']);
    // \DB::table('floor_unit_categories')->whereIn('id', [51])->delete();
});

Route::get('/update_username', function () {
    \DB::table('users')
        ->where('id', 6)
        ->update(['username' => 'vijay']);
});

Route::get('/update-units', function () {
    \DB::table('units')->insert(['name' => 'Lac', 'status' => 1, 'sort_by' => 1]);
    \DB::table('units')->insert(['name' => 'Cr', 'status' => 1, 'sort_by' => 1]);
});

Route::get('/export-database', [BackupController::class, 'backupDatabase']);

Route::middleware(['auth'])->group(function () {
    Route::get('/search-dropdown', [DashboardController::class, 'search_dropdown'])->name('search-dropdown');

    Route::get('/getBasicJson', [PropertyController::class, 'getBasicJson'])->name('getBasicJson');
    Route::get('surveyor/property/details/{id}', [PropertyController::class, 'viewPropertyDetails'])->name('surveyor.property.property_details');
    Route::group(['prefix' => 'surveyor/webgis'], function () {
        Route::get('/', [WebGisController::class, 'index'])->name('surveyor.webgis');
        Route::any('/get-search-feature', [WebGisController::class, 'getSearchedFeature'])->name('surveyor.get-search-feature');
        Route::post('/get-popup-controller', [WebGisController::class, 'getPopupController'])->name('surveyor.get-popup-controller');
        Route::post('/get-place-card-controller', [WebGisController::class, 'getPlaceCardController'])->name('surveyor.get-place-card-controller');
        Route::post('/get-metro-card-controller', [WebGisController::class, 'getMetroCardController'])->name('surveyor.get-metro-card-controller');
        Route::post('/update-building-layer', [WebGisController::class, 'updateBuildingLayer'])->name('surveyor.update-building-layer');
        Route::post('/update-non-survey-layer', [WebGisController::class, 'updateNonServeyLayer'])->name('surveyor.update-non-survey-layer');
        Route::post('/add-data-live-location', [WebGisController::class, 'addDataForLiveLocation'])->name('surveyor.add-data-live-location');
        Route::post('/handle-click-on-map', [WebGisController::class, 'handleClickOnMap'])->name('surveyor.handle-click-on-map');
        Route::post('/google-search-textSearch', [WebGisController::class, 'textSearch'])->name('surveyor.google-search-textSearch');
        Route::post('/google-search-autocomplete', [WebGisController::class, 'autoCompleteSearch'])->name('surveyor.google-search-autocomplete');
        Route::post('/google-search-textSearch', [WebGisController::class, 'textSearch'])->name('surveyor.google-search-textSearch');
        Route::post('/google-search-placeSearch', [WebGisController::class, 'placeSearch'])->name('surveyor.google-search-placeSearch');
        Route::post('/google-search-searchNearBy', [WebGisController::class, 'searchNearBy'])->name('surveyor.google-search-searchNearBy');
        Route::post('/google-search-placeDetail', [WebGisController::class, 'placeDetail'])->name('surveyor.google-search-placeDetail');
        Route::post('/create-icon-image', [WebGisController::class, 'createIconImage'])->name('surveyor.create-icon-image');
    });
    Route::group(['prefix' => 'surveyor', 'middleware' => ['auth', 'role:surveyor']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('surveyor.dashboard');
        Route::get('/basic_details', [PropertyController::class, 'index'])->name('surveyor.basic_details');
        Route::get('/basic_details_detto', [PropertyController::class, 'index_detto'])->name('surveyor.basic_details_detto');
        Route::get('/extended/basic_details', [PropertyController::class, 'basicDetailsExtended'])->name('surveyor.extended.basic_details');
        Route::post('/get-property-count', [DashboardController::class, 'propertyCount'])->name('dashboard.get-property-count');
        Route::get('/builders', [BuilderController::class, 'index'])->name('surveyor.builders');
        /** ajax routes **/
        // get propery sub categories
        Route::get('/ajax/sub_categories', [PropertyController::class, 'get_subcat_options'])->name('surveyor.ajax.sub_categories');
        Route::get('/ajax/get-budget', [WebGisController::class, 'getBudget'])->name('surveyor.ajax.get-budget');

        Route::get('/report-property-details/{id}', [PropertyController::class, 'reportPropertyDetails'])->name('surveyor.report-property-details');
        Route::get('/filter/{type?}', [SurveyorController::class, 'filterData'])->name('surveyor.filter-data');

        Route::get('geo-ids-import', [GISIDImportController::class, 'index']);
        Route::post('geo-ids-import', [GISIDImportController::class, 'store'])->name('surveyor.gis-id-import');

        //property
        Route::group(['prefix' => 'property'], function () {
            Route::get('/reports/{type?}', [PropertyController::class, 'ajaxReports'])->name('reports');
            Route::post('/', [PropertyController::class, 'store'])->name('surveyor.property.store');
            Route::post('/store_detto', [PropertyController::class, 'store_detto'])->name('surveyor.property.store_detto');
            Route::get('/demo-reports', [PropertyController::class, 'reports'])->name('surveyor.property.demo-reports');
            Route::get('/reports', [PropertyController::class, 'ajaxReports'])->name('surveyor.property.reports');
            Route::get('/ajaxGet', [PropertyController::class, 'ajaxGet'])->name('surveyor.property.ajax-get');
            Route::get('/reports/{type}', [PropertyController::class, 'reportsByType'])->name('surveyor.property.type-reports');

            Route::get('/report_details/{id}', [PropertyController::class, 'reportDetails'])->name('surveyor.property.report_details');
            Route::get('/edit_details/{id}', [PropertyController::class, 'editDetails'])->name('surveyor.property.edit_details');
            Route::post('/update_details/{id}', [PropertyController::class, 'updateDetails'])->name('surveyor.property.update_details');
            Route::get('/completed', [PropertyController::class, 'completed'])->name('completed');
            Route::get('update', [PropertyController::class, 'update_screen'])->name('update_screen');

            // Route::get('/unit_details/{unit_id}/{proprty_id}/{unit_type_id}/{unit_cat_id}', [UnitController::class, 'unitDetails'])->name('surveyor.property.unit_details');
            Route::get('/unit_details/{unit_id}/{residential_type?}', [UnitController::class, 'unitDetails'])->name('surveyor.property.unit_details');
            Route::get('/unit-details-dfd/{unit_id}/{residential_type?}', [UnitController::class, 'unitDetails_dfd'])->name('surveyor.property.unit_details-dfd');
            Route::get('/edit_unit_details/{unit_id}/{residential_type?}', [UnitController::class, 'editUnitDetails'])->name('surveyor.property.edit.unit_details');
            Route::get('/plot-land/edit_unit_details/{prop_id}', [UnitController::class, 'editPlotLandDetails'])->name('surveyor.property.edit.plot_land_details');
            Route::post('/add-unit-apartment-type/{unit_id}', [UnitController::class, 'unitApartmentType'])->name('surveyor.property.unit_details.apartment_type');
            Route::get('plot-land/unit_details/{prop_id}', [UnitController::class, 'plotLandUnitDetails'])->name('surveyor.property.plot_land.unit_details');
            Route::any('add-sub-category/{unit_id}', [UnitController::class, 'addSubCategory'])->name('surveyor.property.unit_details.addSubCategory');
            Route::post('get-sub-categories', [UnitController::class, 'getSubCategories'])->name('surveyor.property.unit_details.getSubCategories');

            Route::group(['prefix' => 'unit_details/commercial/office/'], function () {
                Route::post('store-property-details', [UnitOfficeController::class, 'storeCommOfcPropertyDetails'])->name('surveyor.property.unit_details.commercial.office.store_property_details');
                Route::post('store-pricing-details', [UnitOfficeController::class, 'storePricingDetails'])->name('surveyor.property.unit_details.commercial.office.store_pricing_details');
                Route::post('store-images', [UnitOfficeController::class, 'storeImages'])->name('surveyor.property.unit_details.commercial.office.store_images');
                Route::post('update-images', [UnitOfficeController::class, 'updateImages'])->name('surveyor.property.unit_details.commercial.office.update_images');
                Route::post('store-amenitis', [UnitOfficeController::class, 'storeAmenities'])->name('surveyor.property.unit_details.commercial.office.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/commercial/retail/'], function () {
                Route::post('store-property-details', [UnitRetailController::class, 'storeCommOfcPropertyDetails'])->name('surveyor.property.unit_details.commercial.retail.store_property_details');
                Route::post('store-pricing-details', [UnitRetailController::class, 'storePricingDetails'])->name('surveyor.property.unit_details.commercial.retail.store_pricing_details');
                Route::post('update-images', [UnitRetailController::class, 'updateImages'])->name('surveyor.property.unit_details.commercial.retail.update_images');
                Route::post('store-images', [UnitRetailController::class, 'storeImages'])->name('surveyor.property.unit_details.commercial.retail.store_images');
                Route::post('store-amenitis', [UnitRetailController::class, 'storeAmenities'])->name('surveyor.property.unit_details.commercial.retail.store_amenities');
            });

            Route::group(['prefix' => 'unit_details/commercial/storage/'], function () {
                Route::post('store-property-details', [UnitStorageController::class, 'storeCommOfcPropertyDetails'])->name('surveyor.property.unit_details.commercial.storage.store_property_details');
                Route::post('store-pricing-details', [UnitStorageController::class, 'storePricingDetails'])->name('surveyor.property.unit_details.commercial.storage.store_pricing_details');
                Route::post('store-images', [UnitStorageController::class, 'storeImages'])->name('surveyor.property.unit_details.commercial.storage.store_images');
                Route::post('update-images', [UnitStorageController::class, 'updateImages'])->name('surveyor.property.unit_details.commercial.storage.update_images');
                Route::post('store-amenitis', [UnitStorageController::class, 'storeAmenities'])->name('surveyor.property.unit_details.commercial.storage.store_amenities');
            });

            Route::group(['prefix' => 'unit_details/commercial/other/'], function () {
                Route::post('store-property-details', [UnitOtherController::class, 'storeCommOfcPropertyDetails'])->name('surveyor.property.unit_details.commercial.other.store_property_details');
                Route::post('store-pricing-details', [UnitOtherController::class, 'storePricingDetails'])->name('surveyor.property.unit_details.commercial.other.store_pricing_details');
                Route::post('store-images', [UnitOtherController::class, 'storeImages'])->name('surveyor.property.unit_details.commercial.other.store_images');
                Route::post('update-images', [UnitOtherController::class, 'updateImages'])->name('surveyor.property.unit_details.commercial.other.update_images');
                Route::post('store-amenitis', [UnitOtherController::class, 'storeAmenities'])->name('surveyor.property.unit_details.commercial.other.store_amenities');
            });

            Route::group(['prefix' => 'unit-details', 'as' => 'surveyor.property.unit-details.'], function () {
                Route::post('image-gallery', [ImageUploadController::class, 'imageGallery'])->name('image-gallery');
                Route::post('amenity-images', [ImageUploadController::class, 'amenityImages'])->name('amenity-images');
                Route::post('interior-images', [ImageUploadController::class, 'interiorImages'])->name('interior-images');
                Route::post('floor-plan-images', [ImageUploadController::class, 'floorPlanImages'])->name('floor-plan-images');
                Route::post('unit-videos', [ImageUploadController::class, 'unitVideos'])->name('unit-videos');
                Route::post('plot-land-images', [ImageUploadController::class, 'plotLandImages'])->name('plot-land-images');
                Route::get('/delete-unit-file/{file_id}', [ImageUploadController::class, 'deleteUnitFile'])->name('delete-unit-file');
            });

            Route::get('/demolished/unit_details/{unit_id}', [UnitDemolishedController::class, 'unitDetails'])->name('surveyor.property.demolished.unit_details');
            Route::get('/demolished/edit_unit_details/{property_id}', [UnitDemolishedController::class, 'editUnitDetails'])->name('surveyor.property.demolished.edit_unit_details');
            Route::group(['prefix' => 'unit_details/demolished/'], function () {
                Route::post('store-property-details', [UnitDemolishedController::class, 'storeCommOfcPropertyDetails'])->name('surveyor.property.unit_details.demolished.store_property_details');
                Route::post('update-property-details', [UnitDemolishedController::class, 'updateCommOfcPropertyDetails'])->name('surveyor.property.unit_details.demolished.update_property_details');
            });

            Route::group(['prefix' => 'unit_details/commercial/hospitality/'], function () {
                Route::post('store-property-details', [HospitalityController::class, 'storeHospitalityPropertyDetails'])->name('surveyor.property.unit_details.commercial.hospitality.store_property_details');
                Route::post('store-pricing-details', [HospitalityController::class, 'storeHospitalityPricingDetails'])->name('surveyor.property.unit_details.commercial.hospitality.store_pricing_details');
                Route::post('store-unit-images', [HospitalityController::class, 'storeHospitalityunitImages'])->name('surveyor.property.unit_details.commercial.hospitality.store_unit_images');
                Route::post('update-unit-images', [HospitalityController::class, 'updateHospitalityunitImages'])->name('surveyor.property.unit_details.commercial.hospitality.update_unit_images');
                Route::post('store-amenitis', [HospitalityController::class, 'storeAmenities'])->name('surveyor.property.unit_details.commercial.hospitality.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/plotland/openplotland/'], function () {
                Route::post('store-property-details', [PlotlandController::class, 'storePlotlandPropertyDetails'])->name('surveyor.property.unit_details.plotland.openPlotLand.store_property_details');
                Route::post('store-pricing-details', [PlotlandController::class, 'storePlotlandPricingDetails'])->name('surveyor.property.unit_details.plotland.openPlotLand.store_pricing_details');
                Route::post('store-unit-images', [PlotlandController::class, 'storePlotlandunitImages'])->name('surveyor.property.unit_details.plotland.openPlotLand.store_images');
                Route::post('update-unit-images', [PlotlandController::class, 'updatePlotlandunitImages'])->name('surveyor.property.unit_details.plotland.openPlotLand.update_images');
            });
            Route::group(['prefix' => 'unit_details/resedential/servided-apartments/'], function () {
                Route::post('store-property-details', [ServicedApartmentsController::class, 'storeServicedApartmentsDetails'])->name('surveyor.property.unit_details.resedential.serviced_apartments.store_property_details');
                Route::post('store-pricing-details', [ServicedApartmentsController::class, 'storeServicedApartmentsPricingDetails'])->name('surveyor.property.unit_details.resedential.serviced_apartments.store_pricing_details');
                Route::post('store-unit-images', [ServicedApartmentsController::class, 'storeServicedApartmentsUnitImages'])->name('surveyor.property.unit_details.resedential.serviced_apartments.store_unit_images');
                Route::post('edit-unit-images', [ServicedApartmentsController::class, 'updateServicedApartmentsUnitImages'])->name('surveyor.property.unit_details.resedential.serviced_apartments.edit_unit_images');
                Route::post('store-amenitis', [ServicedApartmentsController::class, 'storeAmenities'])->name('surveyor.property.unit_details.resedential.serviced_apartments.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/resedential/gated-community/'], function () {
                Route::post('store-property-details', [GatedCommunityController::class, 'storeServicedApartmentsDetails'])->name('surveyor.property.unit_details.resedential.gated_community.store_property_details');
                Route::post('store-pricing-details', [GatedCommunityController::class, 'storeServicedApartmentsPricingDetails'])->name('surveyor.property.unit_details.resedential.gated_community.store_pricing_details');
                Route::post('store-unit-images', [GatedCommunityController::class, 'storeServicedApartmentsUnitImages'])->name('surveyor.property.unit_details.resedential.gated_community.store_unit_images');
                Route::post('edit-unit-images', [GatedCommunityController::class, 'updateServicedApartmentsUnitImages'])->name('surveyor.property.unit_details.resedential.gated_community.edit_unit_images');
                Route::post('store-amenitis', [GatedCommunityController::class, 'storeAmenities'])->name('surveyor.property.unit_details.resedential.gated_community.store_amenities');
            });
            Route::group(['prefix' => 'unit_details/resedential/one-rk/'], function () {
                Route::get('edit/{id}', [OneRkController::class, 'editDetails'])->name('surveyor.property.unit_details.resedential.one_rk.edit_details');
                Route::post('store-property-details', [OneRkController::class, 'storePropertyDetails'])->name('surveyor.property.unit_details.resedential.one_rk.store_property_details');
                Route::post('store-pricing-details', [OneRkController::class, 'storePricingDetails'])->name('surveyor.property.unit_details.resedential.one_rk.store_pricing_details');
                Route::post('store-unit-images', [OneRkController::class, 'storeUnitImages'])->name('surveyor.property.unit_details.resedential.one_rk.store_unit_images');
                Route::post('edit-unit-images', [OneRkController::class, 'updateUnitImages'])->name('surveyor.property.unit_details.resedential.one_rk.edit_unit_images');
                Route::post('store-amenitis', [OneRkController::class, 'storeAmenities'])->name('surveyor.property.unit_details.resedential.one_rk.store_amenities');
            });

            Route::group(['prefix' => 'image'], function () {
                Route::post('/store', [PropertyImagesController::class, 'store'])->name('surveyor.property.image.store');
                Route::post('dropzone/store', [PropertyImagesController::class, 'dropzoneStore'])->name('surveyor.property.image.dropzone.store');
                Route::get('/destroy/{id}', [PropertyImagesController::class, 'destroy'])->name('surveyor.property.image.destroy');
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
            // Route::post('/store-compliances', [CompliancesController::class, 'store_compliances'])->name('store-compliances');
            // Route::post('/project-repository', [CompliancesController::class, 'project_repository'])->name('project-repository');
            Route::any('/block-tower-repository', [CompliancesController::class, 'block_tower_repository'])->name('block-tower-repository');
            //Route::any('/block-tower', [CompliancesController::class, 'block_tower_repository'])->name('block-tower');

            Route::group(['prefix' => 'builder', 'as' => 'builder.'], function () {
                Route::get('/get-suggestions', [BuilderController::class, 'getSuggestions'])->name('get-suggestions');
            });
            Route::group(['prefix' => 'sub-builder', 'as' => 'sub-builder.'], function () {
                Route::get('/get-suggestions', [BuilderSubGroupController::class, 'getSuggestions'])->name('get-suggestions');
            });
            // Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
            //     Route::get('/get-suggestions', [AreaController::class, 'getSuggestions'])->name('get-suggestions');
            // });
            Route::get('/fetch-city', [CityController::class, 'fetchCity'])->name('fetch-city');
            Route::get('/construction-partner', [ConstructionPartnerController::class, 'getConstructionPartnerBySearchKey'])->name('construction-partner');

            Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
                Route::get('/get-area-by-search-key', [AreaController::class, 'getAreaBySearchKey'])->name('get-area-by-search-key');
            });



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

                Route::group(['prefix' => 'compliances', 'as' => 'compliances.'], function () {
                    Route::post('/ghmc-approval-files', [CompliancesController::class, 'ghmc_approval_files'])->name('ghmc-approval-files');
                    Route::post('/commencement-certificate-files', [CompliancesController::class, 'commencement_certificate_files'])->name('commencement-certificate-files');
                    Route::post('/legal-document-files', [CompliancesController::class, 'legal_document_files'])->name('legal-document-files');
                    Route::post('/rera-hmda-form-submit', [CompliancesController::class, 'rera_hmda_form_submit'])->name('rera-hmda-form-submit');
                    Route::get('/destroy/{id}', [CompliancesController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix' => 'repository', 'as' => 'repository.'], function () {
                    Route::post('/brochure-files', [RepositoriesController::class, 'brochure_files'])->name('brochure-files');
                    Route::post('/promotional-video-files', [RepositoriesController::class, 'promotional_video_files'])->name('promotional-video-files');
                    Route::post('/image-files', [RepositoriesController::class, 'image_files'])->name('image-files');
                    Route::post('/view-video-files', [RepositoriesController::class, 'view_video_files'])->name('view-video-files');
                    Route::post('/floor-files', [RepositoriesController::class, 'floor_files'])->name('floor-files');
                    Route::post('/other-files', [RepositoriesController::class, 'other_files'])->name('other-files');
                    Route::post('/add-project-repository', [RepositoriesController::class, 'add_project_repository'])->name('add-project-repository');
                    Route::get('/destroy/{id}', [RepositoriesController::class, 'destroy'])->name('destroy');
                    Route::get('/destroy-other-files/{id}', [RepositoriesController::class, 'destroy_other_files'])->name('destroy-other-files');
                });

                Route::group(['prefix' => 'block-repository', 'as' => 'block-repository.'], function () {
                    Route::post('/floor-plan-files', [BlockRepositoriesController::class, 'floor_plan_files'])->name('floor-plan-files');
                    Route::post('/image-files', [BlockRepositoriesController::class, 'image_files'])->name('image-files');
                    Route::post('/three-dimentional-view-video-files', [BlockRepositoriesController::class, 'three_dimentional_view_video'])->name('three-dimentional-view-video-files');
                    Route::post('/tower-video', [BlockRepositoriesController::class, 'tower_video'])->name('tower-video');
                    Route::post('/other-files', [BlockRepositoriesController::class, 'other_files'])->name('other-files');
                    Route::post('/add-block-repository', [BlockRepositoriesController::class, 'add_block_repository'])->name('add-block-repository');
                    Route::get('/destroy/{id}', [BlockRepositoriesController::class, 'destroy'])->name('destroy');
                    Route::get('/destroy-other-files/{id}', [BlockRepositoriesController::class, 'destroy_other_files'])->name('destroy-other-files');
                });
            });
        });

        Route::group(['prefix' => 'builder', 'as' => 'builder.'], function () {
            Route::get('/', [BuilderController::class, 'index'])->name('index');
            Route::post('/store', [BuilderController::class, 'store'])->name('store');
            Route::group(['prefix' => 'sub-group', 'as' => 'sub-group.'], function () {
                Route::get('/list', [BuilderController::class, 'sub_groups'])->name('list');
            });
        });

        Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
            Route::get('/', [TaskController::class, 'index'])->name('index');
            Route::get('/create', [TaskController::class, 'create'])->name('create');
            Route::get('/reports', [TaskController::class, 'reports'])->name('reports');
            Route::get('/show', [TaskController::class, 'show'])->name('show');
        });

        Route::group(['prefix' => 'gis-id', 'as' => 'gis-id.'], function () {
            Route::get('/generate-temp-id', [GenerateGISIDController::class, 'generate'])->name('generate');
        });

        Route::get('/amenities', [GatedCommunityDetailsController::class, 'amenities'])->name('amenities.index');
        Route::get('/compliances', [GatedCommunityDetailsController::class, 'compliances'])->name('compliances.index');
        Route::get('/repositories', [GatedCommunityDetailsController::class, 'repositories'])->name('repositories.index');
        Route::get('/floors', [GatedCommunityDetailsController::class, 'floors'])->name('floors.index');

        Route::get('/builder/create', [BuilderController::class, 'index'])->name('index');
        Route::post('/update-general-details', [SecondaryController::class, 'updateGeneralDetails'])->name('update-general-details');
        Route::get('/blocks', [SecondaryController::class, 'index'])->name('blocks.index');
        Route::get('/view-block', [SecondaryController::class, 'viewBlock'])->name('view-block');
        Route::get('/view-tower', [SecondaryController::class, 'viewTower'])->name('view-tower');

        Route::get('/towers', [SecondaryController::class, 'towers'])->name('towers.index');
        Route::post('/create-towers', [SecondaryController::class, 'createTowers'])->name('create-towers');
        Route::post('/update-towers', [GatedCommunityDetailsController::class, 'updateTowers'])->name('update-towers');

        // save project status information
        Route::post('/store-project-status', [ProjectStatusController::class, 'store'])->name('store-project-status');
        Route::get('/project-status-history', [ProjectStatusController::class, 'project_status_history'])->name('project-status-history');

        // save price trends information
        Route::post('/store-price-trends', [PriceTrendsController::class, 'store'])->name('store-price-trends');
        Route::post('/update-price-trends', [PriceTrendsController::class, 'update'])->name('update-price-trends');

        Route::group(['prefix' => 'ajax', 'as' => 'ajax'], function () {
            Route::get('/floor-unit-types', [CategoryController::class, 'floor_unit_categories'])->name('surveyor.ajax.floor_unit_categories');
            Route::get('excel/export/{type?}', [PropertyController::class, 'exportExcel'])->name('.export.excel');

            Route::get('/get-brand-sub-category', [DashboardController::class, 'getBrandSubCategories'])->name('.get-brand-sub-category');
            Route::get('/get-sub-residential', [DashboardController::class, 'getSubResidentials'])->name('.get-sub-residential');
            Route::get('/get-defined-options', [DashboardController::class, 'getDefinedOptions'])->name('.get-defined-options');
        });
        Route::get('/merge-gis-id-valid-search', [GISIDController::class, 'search_mgis'])->name('merge-gis-id-valid-search');
        Route::get('/split-merge-options', [GISIDController::class, 'split_merge_options'])->name('split-merge-options');

        Route::get('/gated-reports', [GatedCommunityController::class, 'gatedReports'])->name('surveyor.gated-reports');
        Route::get('export/gated_community_reports', [GatedCommunityController::class, 'exportReport'])->name('surveyor.export.gated_community_report');
    });

    // commercial towers

    Route::group(['prefix' => 'commercial-tower', 'as' => 'commercial-tower.'], function () {
        Route::get('/add-commercial-tower', [CommercialTowerController::class, 'add_commercial_tower'])->name('add-commercial-tower');
        Route::get('/get-commomercial-defined-block', [CommercialTowerController::class, 'get_commercial_defined_block'])->name('get-commomercial-defined-block');
        Route::get('/blocks', [CommercialTowerController::class, 'index'])->name('blocks.index');
        Route::get('/get-block-towers', [CommercialTowerController::class, 'getBlockTowers'])->name('get-block-towers');
        Route::get('/get-towers', [CommercialTowerController::class, 'getTowers'])->name('get-towers');
        Route::post('/create-towers', [CommercialTowerController::class, 'createTowers'])->name('create-towers');
        Route::get('/floors', [CommercialTowerController::class, 'floors'])->name('floors.index');
        Route::get('/get-edit-commercial-tower-floors', [CommercialTowerController::class, 'editCommercialTowerFloors'])->name('get-edit-commercial-tower-floors');
        Route::get('/get-ct-floors', [CommercialTowerController::class, 'get_ct_floors'])->name('get-ct-floors');
        Route::get('/get-ct-units', [CommercialTowerController::class, 'get_ct_units'])->name('get-ct-units');
        Route::post('/store-ct-floors', [CommercialTowerController::class, 'store_ct_floors'])->name('store-ct-floors');

        Route::get('/ct-details/{id}', [CommercialTowerController::class, 'commercialTowerDetails'])->name('ct-details');
        Route::get('/ct-floor-details', [CommercialTowerController::class, 'commercialTowerFloorDetails'])->name('ct-floor-details');
        Route::get('/ct-edit-details/{id}', [CommercialTowerController::class, 'commercialTowerEditDetails'])->name('ct-edit-details');

        Route::post('/update-general-details', [CommercialTowerController::class, 'updateGeneralDetails'])->name('update-general-details');

        Route::group(['prefix' => 'project-status', 'as' => 'project-status.'], function () {
            Route::post('/store-project-status', [CTProjectStatusController::class, 'store'])->name('store-project-status');
            Route::get('/project-status-history', [CTProjectStatusController::class, 'project_status_history'])->name('project-status-history');
            Route::get('/project-status-fields', [CTProjectStatusController::class, 'project_status_fields'])->name('project-status-fields');

            Route::get('/disabled-options', [CTProjectStatusController::class, 'disabled_options'])->name('disabled-options');
        });
        Route::group(['prefix' => 'tower-status', 'as' => 'tower-status.'], function () {
            Route::get('/disabled-options', [CTTowerStatusController::class, 'disabled_options'])->name('disabled-options');
        });

        Route::group(['prefix' => 'amenities', 'as' => 'amenities.'], function () {
            Route::get('/amenities', [CTAmmenitiesController::class, 'amenities'])->name('index');
            Route::post('/store-amenities', [CTAmmenitiesController::class, 'store_amenities'])->name('store-amenities');
        });
        Route::group(['prefix' => 'compliances', 'as' => 'compliances.'], function () {
            Route::get('/compliances', [CTCompliancesController::class, 'compliances'])->name('index');
            Route::post('/store-compliances', [CTCompliancesController::class, 'store_compliances'])->name('store-compliances');
            Route::post('/ghmc-approval-files', [CTCompliancesController::class, 'ghmc_approval_files'])->name('ghmc-approval-files');
            Route::post('/commencement-certificate-files', [CTCompliancesController::class, 'commencement_certificate_files'])->name('commencement-certificate-files');
            Route::post('/legal-document-files', [CTCompliancesController::class, 'legal_document_files'])->name('legal-document-files');
            Route::post('/rera-hmda-form-submit', [CTCompliancesController::class, 'rera_hmda_form_submit'])->name('rera-hmda-form-submit');
            Route::get('/destroy/{id}', [CTCompliancesController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'repositories', 'as' => 'repositories.'], function () {
            Route::get('/index', [CTRepositoriesController::class, 'repositories'])->name('index');
            Route::post('/project-repository', [CTRepositoriesController::class, 'project_repository'])->name('project-repository');

            Route::post('/brochure-files', [CTRepositoriesController::class, 'brochure_files'])->name('brochure-files');
            Route::post('/promotional-video-files', [CTRepositoriesController::class, 'promotional_video_files'])->name('promotional-video-files');
            Route::post('/image-files', [CTRepositoriesController::class, 'image_files'])->name('image-files');
            Route::post('/view-video-files', [CTRepositoriesController::class, 'view_video_files'])->name('view-video-files');
            Route::post('/floor-files', [CTRepositoriesController::class, 'floor_files'])->name('floor-files');
            Route::post('/other-files', [CTRepositoriesController::class, 'other_files'])->name('other-files');
            Route::post('/add-project-repository', [CTRepositoriesController::class, 'add_project_repository'])->name('add-project-repository');
            Route::get('/destroy/{id}', [CTRepositoriesController::class, 'destroy'])->name('destroy');
            Route::get('/destroy-other-files/{id}', [CTRepositoriesController::class, 'destroy_other_files'])->name('destroy-other-files');
        });
        Route::group(['prefix' => 'price-trends', 'as' => 'price-trends.'], function () {
            Route::get('/', [CTPriceTrendsController::class, 'index'])->name('index');
            Route::post('/store', [CTPriceTrendsController::class, 'store'])->name('store');
            Route::post('/update', [CTPriceTrendsController::class, 'update'])->name('update');
        });
        Route::get('geo-ids-import', [GISIDImportController::class, 'index']);
        Route::post('geo-ids-import', [GISIDImportController::class, 'store'])->name('surveyor.gis-id-import');
    });

    Route::group(['middleware' => 'auth'], function () {
        // secondary blocks
        Route::get('/get_secondary_defined_block', [SecondaryController::class, 'get_secondary_defined_block'])->name('get_secondary_defined_block');
        Route::get('/get_blocks', [SecondaryController::class, 'getBlocks'])->name('get_blocks');
        Route::get('/get-towers', [SecondaryController::class, 'getTowers'])->name('get-towers');
        Route::get('/get-block-towers', [SecondaryController::class, 'getBlockTowers'])->name('get-block-towers');

        // secondary details -- Floors
        Route::group(['prefix' => 'secondary_details', 'as' => 'secondary_details.'], function () {
            Route::get('/search/gis', [GatedCommunityDetailsController::class, 'search_gis'])->name('search.gis');

            Route::get('/get_floors', [SecondaryController::class, 'get_floors'])->name('get_floors');
            Route::get('/get_units', [SecondaryController::class, 'get_units'])->name('get_units');
            Route::get('/test', [GatedCommunityDetailsController::class, 'test'])->name('test');

            Route::any('/save_floor_merge', [GatedCommunityDetailsController::class, 'save_floor_merge'])->name('save_floor_merge');
            Route::any('/save_unit_merge', [GatedCommunityDetailsController::class, 'save_unit_merge'])->name('save_unit_merge');
        });

        Route::post('sd/save_floor_merge', [PropertyController::class, 'sd_save_floor_merge'])->name('sd.save_floor_merge');

        Route::get('/get_defined_block', [PropertyController::class, 'get_defined_block'])->name('get_defined_block');
        Route::get('/get_defined_options', [PropertyController::class, 'get_defined_options'])->name('get_defined_options');
        Route::get('/get_sd_defined_block', [PropertyController::class, 'get_sd_defined_block'])->name('get_sd_defined_block');
        Route::get('/get_block_towers', [PropertyController::class, 'get_block_towers'])->name('get_block_towers');

        Route::get('/get_floors', [PropertyController::class, 'get_floors'])->name('get_floors');
        Route::get('/get_edit_floors', [PropertyController::class, 'editFloors'])->name('get_edit_floors');
        Route::post('/save_floor_merge', [PropertyController::class, 'save_floor_merge'])->name('save_floor_merge');
        Route::post('/save_unit_merge', [PropertyController::class, 'save_unit_merge'])->name('save_unit_merge');
        Route::post('/store_brand', [PropertyController::class, 'store_brand'])->name('surveyor.brand.store');
        Route::get('/remove_merge', [PropertyController::class, 'remove_merge'])->name('remove_merge');
        Route::get('/remove_floor', [PropertyController::class, 'remove_floor'])->name('remove_floor');
        Route::get('/check_gis_id', [PropertyController::class, 'check_gis_id'])->name('check_gis_id');
        Route::get('/remove_unit', [PropertyController::class, 'remove_unit'])->name('remove_unit');
        Route::get('/get_units', [PropertyController::class, 'get_units'])->name('get_units');
        Route::get('/get_unit_categories', [PropertyController::class, 'get_unit_categories'])->name('get_unit_categories');
        Route::get('/get_data_options', [PropertyController::class, 'get_data_options'])->name('get_data_options');

        Route::get('/get_sd_floors', [PropertyController::class, 'get_sd_floors'])->name('get_sd_floors');
        Route::get('/get_sd_units', [PropertyController::class, 'get_sd_units'])->name('get_sd_units');
        Route::get('/get_edit_secondary_data_floors', [PropertyController::class, 'editSecondaryDataFloors'])->name('get_edit_secondary_data_floors');
        Route::post('/store-gc-floors', [GatedCommunityDetailsController::class, 'store_gc_floors'])->name('store-gc-floors');
        Route::post('/save_sd_floor_merge', [PropertyController::class, 'save_sd_floor_merge'])->name('save_sd_floor_merge');
        Route::post('/save_sd_unit_merge', [PropertyController::class, 'save_sd_unit_merge'])->name('save_sd_unit_merge');

        Route::get('/project-status-fields', [ProjectStatusController::class, 'project_status_fields'])->name('project-status-fields');
        Route::get('/get-price-trends-block', [PriceTrendsController::class, 'index'])->name('get-price-trends-block');

        Route::get('/css_loader', [PropertyController::class, 'css_loader'])->name('css_loader');

        // Route::get('/user_loc_details', [UserController::class, 'user_loc_details'])->name('user.ip_location_details');
        // Route::get('/add-role', [App\Http\Controllers\HomeController::class, 'addRole'])->name('user.ip_location_details');
        // Route::get('/create-role', [App\Http\Controllers\HomeController::class, 'createRole'])->name('user.ip_location_details');

        Route::get('/get-gcd-tab-content-header', [GatedCommunityDetailsController::class, 'get_gcd_tab_content_header'])->name('get-gcd-tab-content-header');
        Route::get('/check-log', [DashboardController::class, 'check_log'])->name('check-log');
    });



    Route::get('/remove-test-data', [TestDataController::class, 'removeTestData'])->name('remove-test-data');

    Route::get('/upload-files', [DashboardController::class, 'upload_test'])->name('upload-files');
    Route::any('/store-files', [DashboardController::class, 'store_files'])->name('store-files');
    Route::get('/auth-status', [App\Http\Controllers\HomeController::class, 'auth_status'])->name('auth-status');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
