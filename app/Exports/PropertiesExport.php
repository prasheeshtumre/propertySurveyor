<?php

namespace App\Exports;

use App\Models\Property;
use App\Models\Tower;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Auth;
use Carbon\Carbon;
use DateTime;

error_reporting(0);

class PropertiesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $category;
    protected $gis_id;
    protected $project_name;
    protected $builder_name;
    protected $pincode;
    protected $sale_rent;
    protected $residential_sub_category;
    protected $plot_land_types;
    protected $residential_category;
    protected $building_name;
    protected $house_no;
    protected $locality_name;
    protected $plot_no;
    protected $plot_name;
    protected $street_name;
    protected $owner_name;
    protected $contact_no;
    protected $construction_type;
    protected $no_of_floors;
    protected $property_type;
    protected $brand_category;
    protected $no_of_units;
    protected $brand_sub_category;
    protected $brand_id;
    protected $unit_type_id;
    protected $type;
    protected $start_date;
    protected $end_date;
    protected $search;

    public function __construct($request, $type)
    {
        $this->category = $request->category;
        $this->gis_id = $request->gis_id;
        $this->project_name = $request->project_name;
        $this->builder_name = $request->builder_name;
        $this->pincode = $request->pincode;
        $this->sale_rent = $request->sale_rent;
        $this->category = $request->category;
        $this->residential_sub_category = $request->residential_sub_category;
        $this->plot_land_types = $request->plot_land_types;
        $this->residential_category = $request->residential_category;
        $this->building_name = $request->building_name;
        $this->house_no = $request->house_no;
        $this->locality_name = $request->locality_name;
        $this->plot_no = $request->plot_no;
        $this->plot_name = $request->plot_name;
        $this->street_name = $request->street_name;
        $this->owner_name = $request->owner_name;
        $this->contact_no = $request->contact_no;
        $this->construction_type = $request->construction_type;
        $this->no_of_floors = $request->no_of_floors;
        $this->property_type = $request->property_type;
        $this->brand_category = $request->brand_category;
        $this->no_of_units = $request->no_of_units;
        $this->brand_sub_category = $request->brand_sub_category;
        $this->brand_id = $request->brand_id;
        $this->unit_type_id = $request->unit_type_id;
        $this->type = $type;
        $this->start_date = $request->start_date;
        $this->end_date = $request->end_date;
        $this->search = $request->search;
    }

    public function collection()
    {
        $properties = Property::query();
        if ($this->start_date && !empty($this->start_date)) {
            $from = date($this->start_date . ' 00:00:00');
            $today = new DateTime();
            $to = $today->format('Y-m-d') . ' 23:58:59';
        }

        if ($this->end_date && !empty($this->end_date)) {
            $to = date($this->end_date . ' 23:58:59');
        }
        $properties
            ->when($this->category, function ($query) {
                $query->where('cat_id', $this->category);
            })
            ->when($this->gis_id, function ($query) {
                $query->where('gis_id', 'like', '%' . $this->gis_id . '%');
            })
            // ->when($this->pincode, function ($query) {
            //     $query->where('pincode', $this->pincode);
            // })
            ->when($this->project_name, function ($query) {
                $query->where('project_name', 'like', '%' . $this->project_name . '%');
            })
            ->when($this->residential_category, function ($query) {
                $query->where('residential_type', 'like', '%' . $this->residential_category . '%');
            })
            ->when($this->residential_sub_category, function ($query) {
                $query->where('residential_sub_type', 'like', '%' . $this->residential_sub_category . '%');
            })
            ->when($this->building_name, function ($query) {
                $query->where('building_name', 'like', '%' . $this->building_name . '%');
            })
            ->when($this->house_no, function ($query) {
                $query->where('house_no', 'like', '%' . $this->house_no . '%');
            })
            ->when($this->locality_name, function ($query) {
                $query->where('locality_name', 'like', '%' . $this->locality_name . '%');
            })
            ->when($this->plot_no, function ($query) {
                $query->where('plot_no', 'like', '%' . $this->plot_no . '%');
            })
            ->when($this->plot_name, function ($query) {
                $query->where('plot_name', 'like', '%' . $this->plot_name . '%');
            })
            ->when($this->street_name, function ($query) {
                $query->where('street_details', 'like', '%' . $this->street_name . '%');
            })
            ->when($this->owner_name, function ($query) {
                $query->where('owner_name', 'like', '%' . $this->owner_name . '%');
            })
            ->when($this->builder_name, function ($query) {
                $query->where('builder_id', $this->builder_name);
            })
            ->when($this->contact_no, function ($query) {
                $query->where('contact_no', 'like', '%' . $this->contact_no . '%');
            })
            ->when($this->plot_land_types, function ($query) {
                $query->where('plot_land_type', $this->plot_land_types);
            })
            ->when($this->construction_type, function ($query) {
                $query->where('under_construction_type', $this->construction_type);
            })
            ->when($this->no_of_floors, function ($query) {
                $query->where('no_of_floors', $this->no_of_floors);
            });

        if (isset($this->property_type) && !empty($this->property_type)) {
            $properties = $properties->whereHas('floors', function ($query) {
                $query->where('unit_cat_type_id', $this->property_type);
            });
        }
        if (isset($this->brand_category) && !empty($this->brand_category)) {
            $properties = $properties->whereHas('floors', function ($query) {
                $query->where('unit_cat_id', $this->brand_category);
            });
        }

        if (isset($this->no_of_units) && !empty($this->no_of_units)) {
            $properties = $properties->whereHas('floors', function ($query) {
                $query->selectRaw('COUNT(*) as row_count')->having('row_count', '=', $this->no_of_units);
            });
        }

        if (isset($this->brand_sub_category) && !empty($this->brand_sub_category)) {
            $properties = $properties->whereHas('floors', function ($query) {
                $query->where('unit_sub_cat_id', $this->brand_sub_category);
            });
        }
        if (isset($this->brand_id) && !empty($this->brand_id)) {
            $properties = $properties->whereHas('floors', function ($query) {
                $query->where('unit_brand_id', $this->brand_id);
            });
        }

        if (isset($this->pincode) && !empty($this->pincode)) {
            $properties = $properties->whereHas('pincode', function ($query) {
                $query->where('pincode_id', $this->pincode);
            });
        }

        if (isset($this->unit_type_id) && !empty($this->unit_type_id)) {
            $properties = $properties->whereHas('floors', function ($query) {
                $query->where('unit_type_id', $this->unit_type_id);
            });
        }

        if ($this->sale_rent == 1) {
            $properties = $properties->where('up_for_sale', 1);
            if (isset($this->sale_rent) && !empty($this->sale_rent)) {
                $properties = $properties->whereHas('floors', function ($query) {
                    $query->where('up_for_sale', 1);
                });
            }
        }
        if ($this->sale_rent == 2) {
            $properties = $properties->where('up_for_rent', 1);
            if (isset($this->sale_rent) && !empty($this->sale_rent)) {
                $properties = $properties->whereHas('floors', function ($query) {
                    $query->where('up_for_rent', 1);
                });
            }
        }

        if ($this->start_date && !empty($this->start_date)) {
            $properties = $properties->whereBetween('created_at', [$from, $to]);
        }

        // if ($this->has('type') && !empty($this->get('type'))) {
        if ($this->type && !empty($this->type)) {
            if ($this->type == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($this->type == 'week') {
                // dd($now->startOfWeek()->format('Y-m-d'));
                $properties = $properties->whereBetween('created_at', [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d'),
                ]);
            }

            if ($this->type == 'today') {
                // dd($type);
                $properties = $properties->whereDate('created_at', Carbon::today());
            }
        }

        $searchKeyword = $this->search;
        if (!empty($searchKeyword)) {
            $properties = $properties->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('gis_id', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('owner_name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('house_no', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('locality_name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('contact_no', 'LIKE', '%' . $this->search . '%');
                    // ->whereHas('property.category', function ($query) use ($value) {
                    //         $query->where('title', 'LIKE', '%'.$this->search.'%');
                    //     });
                });
            });
        }

        $properties = $properties->orderBy('id', 'DESC')->get();
        foreach ($properties as $key => $property) {
            $towers = Tower::where('gis_id', $property->gis_id)->first();

            if ($property->up_for_rent == '1' && $property->up_for_sale == '1') {
                $sale_rent = 'For Sale/Rent';
            } elseif ($property->up_for_rent == '1') {
                $sale_rent = 'For Rent';
            } elseif ($property->up_for_sale == '1') {
                $sale_rent = 'For Sale';
            } else {
                $sale_rent = 'N/A';
            }

            if ($this->category == 1 || $this->category == 3) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['no_of_floors'] = $property->no_of_floors ?? 'N/A';
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->residential_sub_category == 10) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['project_name'] = $property->project_name ?? 'N/A';
                $properties1[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
                $properties1[$key]['no_of_towers'] = $towers->no_of_towers ?? 'N/A';
                $properties1[$key]['latest_price'] = $property->price;
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->residential_sub_category == 12) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['project_name'] = $property->project_name ?? 'N/A';
                $properties1[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
                $properties1[$key]['latest_price'] = $property->price;
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->residential_sub_category == 9 || $this->residential_sub_category == 11) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['no_of_floors'] = $property->no_of_floors ?? 'N/A';
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->plot_land_types == 13) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['plot_land_sub_type'] = $property->plot_land_type_category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->plot_land_types == 14) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['plot_land_sub_type'] = $property->plot_land_type_category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['project_name'] = $property->project_name ?? 'N/A';
                $properties1[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
                $properties1[$key]['latest_price'] = $property->price;
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->category == 5) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['construction_type'] = $property->under_construction_category->cat_name ?? 'N/A';
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                $properties1[$key]['project_name'] = $property->project_name ?? 'N/A';
                $properties1[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } elseif ($this->category == 6) {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                $properties1[$key]['latitude'] = $property->latitude;
                $properties1[$key]['longitude'] = $property->longitude;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            } else {
                $properties1[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties1[$key]['time'] = $property->created_at->format('H:i:s');
                $properties1[$key]['gis_id'] = $property->gis_id;
                // $properties1[$key]['latitude'] = $property->latitude;
                // $properties1[$key]['longitude'] = $property->longitude;
                $properties1[$key]['category_type'] = $property->category->cat_name ?? 'N/A';
                $properties1[$key]['house_no'] = $property->house_no ?? 'N/A';

                // $properties1[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? $property->plot_land_type_category->cat_name;
                $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
                $properties1[$key]['owner_name'] = $property->owner_name ?? 'N/A';
                $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
                // $properties1[$key]['project_name'] = $property->project_name ?? 'N/A';
                // $properties1[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
                // $properties1[$key]['no_of_towers'] = $towers->no_of_towers ?? 'N/A';
                // $properties1[$key]['latest_price'] = $property->price;
                $properties1[$key]['sale_rent'] = $sale_rent;
                $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
            }
        }
        $properties1 = collect($properties1);
        return $properties1;
    }

    public function headings(): array
    {
        if ($this->category == 1 || $this->category == 3) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Colony/Locality Name', 'Street Details', 'No of Floors', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->residential_sub_category == 10) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Residential Sub-Type', 'Colony/Locality Name', 'Street Details', 'Project Name', 'Builder Name', 'No of Towers', 'Latest Price', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->residential_sub_category == 12) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Residential Sub-Type', 'Colony/Locality Name', 'Street Details', 'Project Name', 'Builder Name', 'Latest Price', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->residential_sub_category == 9 || $this->residential_sub_category == 11) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Residential Sub-Type', 'Colony/Locality Name', 'Street Details', 'No of Floors', 'For Rent/Sale', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->plot_land_types == 13) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Plot Land Sub-Type', 'Colony/Locality Name', 'Street Details', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->plot_land_types == 14) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Plot Land Sub-Type', 'Colony/Locality Name', 'Street Details', 'Project Name', 'Builder Name', 'Latest Price', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->category == 5) {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'Construction Type', 'Colony/Locality Name', 'Street Details', 'Project Name', 'Builder Name', 'For Rent/Sale', 'Remarks'];
        } elseif ($this->category == 6) {
            return ['Date', 'Time', 'GIS ID', 'Latitude', 'Longitude', 'Category of the Property', 'For Rent/Sale', 'Remarks'];
        } else {
            return ['Date', 'Time', 'GIS ID', 'Category of the Property', 'House No.', 'Colony/Locality Name', 'Owner Full Name', 'Street Details', 'For Rent/Sale', 'Remarks'];
        }
    }

    // Implement WithMapping interface to map data to appropriate columns
    // public function map($row): array
    // {
    //     return [
    //         $row->column1,
    //         $row->column2,
    //         $row->column3,
    //         // Map more columns here
    //     ];
    // }

    public function styles($sheet)
    {
        $sheet->getStyle('A1:O1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
