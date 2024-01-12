<?php

namespace App\DTO\CommercialTower\Compliances;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ReraHmdaFormRequestDTO
{
    public $rera_approval_copy;
    public $hmda_file;
    public $property_id;
    public $gis_id;
    public $cat_id;
    public $residential_type;
    public $residential_sub_type;
    public $rear_number;
    public $hmda_number;

    /**
     * Create a new notificationDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Request $request)
    {
        $this->rera_approval_copy = $request->file('rera_approval_copy');
        $this->hmda_file = $request->file('hmda_file');
        $this->property_id = $request->input('property_id');
        $this->gis_id = $request->input('gis_id');
        $this->cat_id = $request->input('cat_id');
        $this->residential_type = $request->input('residential_type');
        $this->residential_sub_type = $request->input('residential_sub_type');
        $this->rear_number = $request->input('rear_number');
        $this->hmda_number = $request->input('hmda_number');

        $request->validate([
            'rera_approval_copy' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'hmda_file' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'rear_number' => 'required_with:rera_approval_copy',
            'hmda_number' => 'required_with:hmda_file',
        ]);
    }

    /**
     * Validate the given request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws ValidationException
     */
    private function validate(Request $request)
    {
        $rules = [
            'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
        ];
        $validator = validator($request->all(), $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Convert the DTO to an array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'rera_approval_copy' => $this->rera_approval_copy,
            'hmda_file' => $this->hmda_file,
            'property_id' => $this->property_id,
            'gis_id' => $this->gis_id,
            'cat_id' => $this->cat_id,
            'residential_type' => $this->residential_type,
            'residential_sub_type' => $this->residential_sub_type,
            'rear_number' => $this->rear_number,
            'hmda_number' => $this->hmda_number,
        ];
    }
}
