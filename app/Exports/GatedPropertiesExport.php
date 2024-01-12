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

error_reporting(0);

class GatedPropertiesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $type_of_project;
    protected $gis_id;
    protected $project_name;
    protected $builder_name;
    protected $pin_code;

    public function __construct($type_of_project = '', $gis_id = '', $project_name = '', $builder_name = '', $pin_code = '')
    {
        $this->type_of_project = $type_of_project;
        $this->gis_id = $gis_id;
        $this->project_name = $project_name;
        $this->builder_name = $builder_name;
        $this->pin_code = $pin_code;
    }

    public function collection()
    {
        $properties = Property::query();
        $properties
            ->when($this->gis_id, function ($query) {
                $query->where('gis_id', 'like', '%' . $this->gis_id . '%');
            })
            ->when($this->project_name, function ($query) {
                $query->where('project_name', 'like', '%' . $this->project_name . '%');
            })
            // ->when($this->pin_code, function ($query) {
            //     $query->where('pincode', 'like', '%' . $this->pin_code . '%');
            // })
            ->when($this->builder_name, function ($query) {
                $query->where('builder_id', $this->builder_name);
            });

        if (isset($this->pin_code) && !empty($this->pin_code)) {
            $properties = $properties->whereHas('pincode', function ($query) {
                $query->where('pincode_id', $this->pin_code);
            });
        }

        if (isset($this->type_of_project) && !empty($this->type_of_project)) {
            if ($this->type_of_project == '4') {
                $properties = $properties->where('cat_id', $this->type_of_project);
                $properties = $properties->where('plot_land_type', 14);
            } else {
                $properties = $properties->where('residential_type', $this->type_of_project);
                $properties->whereIn('residential_sub_type', [10, 12]);
            }
        } else {
            $properties->whereIn('residential_sub_type', [10, 12]);
            $properties->orWhere('plot_land_type', '14');
        }
        $properties = $properties->orderBy('id', 'DESC')->get();
        foreach ($properties as $key => $property) {
            $towers = Tower::where('gis_id', $property->gis_id)->first();
            $properties1[$key]['created_at'] = $property->created_at->format('d-m-Y');
            $properties1[$key]['updated_at'] = $property->created_at->format('H:i:s');
            $properties1[$key]['gis_id'] = $property->gis_id;
            $properties1[$key]['latitude'] = $property->latitude;
            $properties1[$key]['longitude'] = $property->longitude;
            $properties1[$key]['residential_type'] = $property->residential_category->cat_name ?? $property->category->cat_name;
            $properties1[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? $property->plot_land_type_category->cat_name;
            $properties1[$key]['locality_name'] = $property->locality_name ?? 'N/A';
            $properties1[$key]['street_details'] = $property->street_details ?? 'N/A';
            $properties1[$key]['project_name'] = $property->project_name ?? 'N/A';
            $properties1[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
            $properties1[$key]['no_of_towers'] = $towers->no_of_towers ?? 'N/A';
            $properties1[$key]['latest_price'] = 'N/A';
            $properties1[$key]['remarks'] = $property->remarks ?? 'N/A';
        }
        $properties1 = collect($properties1);
        return $properties1;
    }

    public function headings(): array
    {
        return ['Date', 'Time', 'GIS ID', 'Latitude', 'Longitude', 'Category of the Property', 'Residential Sub-Type', 'Colony/Locality Name', 'Street Details', 'Project Name', 'Builder Name', 'No of Towers', 'Latest Price', 'Remarks'];
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
