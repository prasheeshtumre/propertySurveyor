<?php



namespace App\DTO;



use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Request;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Validation\ValidationException;



class MergeGISIDRequestDTO

{

    public $merge_id;

    public $gis_id;

    public $created_by;



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
                'errors' => $validator->getMessageBag()->toArray(),
                'merge_id' => $request->input('merge_id'),
                'type' => 'merge-gis'
            ], 422));

        }


        // {"success":false,"errors":{"gis_id":["The gis id field is required."]}}


        $this->gis_id = $request->input('gis_id');

        $this->merge_id = $request->input('merge_id');

        $this->created_by = $request->input('created_by');

        

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

            'gis_id' => 'required',

            'merge_id' => 'required|unique:gis_id_mappings',

            'created_by' => 'required',

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

            'gis_id' => $this->gis_id,

            'merge_id' => $this->merge_id,

            'created_by' => $this->created_by,

        ];

    }

}

