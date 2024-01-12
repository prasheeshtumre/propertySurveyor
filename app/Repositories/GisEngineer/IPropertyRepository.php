<?php

namespace App\Repositories\GisEngineer;
use Illuminate\Http\Request;

interface IPropertyRepository
{

    public function properties(Request $request, $type);

    public function getProperty(Request $request, $id);

    public function editProperty($id);

    public function update(Request $request, $id);

}
