<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\UnitImage;
use JsonSerializable;

class ImageGalleryResponseDTO implements JsonSerializable
{

    public $fileId;
    public $unitId;
    public $fileName;
    public $filePath;

    /**
     * Create a new PandalDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(UnitImage $unitImage)
    {
        $this->fileId       = $unitImage->id;
        $this->unitId       = $unitImage->unit_id;
        $this->fileName     = $unitImage->pincode;
        $this->filePath     = $unitImage->created_by;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
