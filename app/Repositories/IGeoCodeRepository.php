<?php

namespace App\Repositories;

interface IGeoCodeRepository
{
    public function getPincode($latitude, $longitude);
}
