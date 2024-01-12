<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BuilderSearchRequestDTO
{
    public $searchKey;
    public $selectedBuilders;
    public $page;

    /**
     * Create a new notificationDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Request $request)
    {
     
        $this->searchKey = $request->input('searchKey');
        $this->selectedBuilders = $request->input('selectedBuilders');
        $this->page = $request->input('page');
        $request->validate(
            [
                'searchKey' => 'required',
                'page' => 'required',
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
            'property_id' => $this->searchKey,
            'unit_id' => $this->page
        ];
    }
}
