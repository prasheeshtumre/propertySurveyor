<?php

namespace App\DTO\GatedCommunity\BlockRepositories;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class TowerVideoRequestDTO
{
    public $file;
    public $property_id;
    public $gis_id;
    public $cat_id;
    public $residential_type;
    public $residential_sub_type;
    public $block_tower_id;

    /**
     * Create a new notificationDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Request $request)
    {
        //     dd($request->all());
        $this->file = $request->file('file');
        $this->property_id = $request->input('property_id');
        $this->gis_id = $request->input('gis_id');
        $this->cat_id = $request->input('cat_id');
        $this->residential_type = $request->input('residential_type');
        $this->residential_sub_type = $request->input('residential_sub_type');
        $this->block_tower_id = $request->input('block_tower_id');
        $request->validate([
            'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'block_tower_id' => 'required',
            // 'unit_id' => 'required',
        ]);
    }

    /**
     * Validate the given request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws ValidationException
     */
    private function validate(Request $request): Validator
    {
        $rules = [
            'split_id' => 'required',
            'pincode' => 'required',
        ];
        // dd($request->all());
        return validator($request->all(), $rules);
    }

    /**
     * Convert the DTO to an array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'file' => $this->file,
            'property_id' => $this->property_id,
            'gis_id' => $this->gis_id,
            'cat_id' => $this->cat_id,
            'residential_type' => $this->residential_type,
            'residential_sub_type' => $this->residential_sub_type,
            'block_tower_id' => $this->block_tower_id,
        ];
    }
}
