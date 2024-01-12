<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BuilderSubGroupSearchRequestDTO
{

    public $searchKey;
    public $builderIdArr;
    public $builderSGIdArr;
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
        $this->page = $request->input('page');
        $this->builderIdArr = $request->input('builderIdArr');
        $this->builderSGIdArr = $request->input('builderSGIdArr');
        $request->validate(
            [
                // 'searchKey' => 'required',
                'page' => 'required',
                'builderIdArr' => 'required',
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
            'searchKey' => 'required',
            'page' => 'required',
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
            'searchKey' => $this->searchKey,
            'page' => $this->page,
            'builderIdArr' => $this->builderIdArr,
            'builderSGIdArr' => $this->builderSGIdArr
        ];
    }
}
