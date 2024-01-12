<?php

namespace App\DTO\Units;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UnitVideoRequestDTO
{
    public $file;
    public $property_id;
    public $unit_id;

    /**
     * Create a new notificationDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Request $request)
    {
        $this->file = $request->file('file');
        $this->property_id = $request->input('property_id');
        $this->unit_id = $request->input('unit_id');
        $request->validate(
            [
                'file' => 'required',
                'property_id' => 'required',
                'unit_id' => 'required',
            ]
        );
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
            'unit_id' => $this->unit_id
        ];
    }
}
