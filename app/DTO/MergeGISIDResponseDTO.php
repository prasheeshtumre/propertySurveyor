<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\GisIDMapping;
use JsonSerializable;

class MergeGISIDResponseDTO implements JsonSerializable
{

    public $gis_id;
    public $merge_id;
    public $created_by;
    
    /**
     * Create a new PandalDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(GisIDMapping $GisIDMapping)
    {
        $this->gis_id       = $GisIDMapping->gis_id;
        $this->merge_id     = $GisIDMapping->pincode;
        $this->created_by   = $GisIDMapping->created_by;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
