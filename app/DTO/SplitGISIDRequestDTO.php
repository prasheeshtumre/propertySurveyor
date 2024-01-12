<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class SplitGISIDRequestDTO
{
    public $split_id;
    public $pincode;

    /**
     * Create a new notificationDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Request $request)
    {
        //dd($request->all());
        $validator = $this->validate($request);
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422));
        }

        $this->split_id = $request->input('split_id');
        $this->pincode = $request->input('pincode');
        
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
            'gis_id' => $this->split_id,
            'pincode_id' => $this->pincode,
        ];
    }
}
