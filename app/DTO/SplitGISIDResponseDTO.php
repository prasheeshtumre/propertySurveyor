<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\GeoID;
use JsonSerializable;

class SplitGISIDResponseDTO implements JsonSerializable
{

    public $gis_id;
    public $pincode;
    public $updated_by;
    
    /**
     * Create a new PandalDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(GeoID $GeoIDDBModel)
    {
        $this->gis_id       = $GeoIDDBModel->gis_id;
        $this->pincode      = $GeoIDDBModel->pincode;
        $this->updated_by   = $GeoIDDBModel->updated_by;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
