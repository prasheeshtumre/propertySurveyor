<?php

namespace App\Http\Controllers;

use App\DTO\BuilderSearchRequestDTO;
use Illuminate\Http\Request;
use App\Models\Builder;
use App\Services\BuilderService;
use Symfony\Component\HttpKernel\Exception\HttpException;


class BuilderController extends Controller
{
    public $builderService;

    public function __construct(BuilderService $builderService)
    {
        $this->builderService = $builderService;
    }

    public function index()
    {
        $builders = Builder::all();
        return view('builder.index', compact('builders'));
    }

    public function sub_groups(Request $request)
    {
        $builder = Builder::with('sub_groups')->find($request->builder_id);
        if ($builder) {
            $builder_groups = $builder->sub_groups;
            return response()->json(['groups' => $builder_groups], 200);
        }
        return response()->json(['status' => false, 'msg' => 'Builder Not Found.'], 404);
    }

    public function getSuggestions(BuilderSearchRequestDTO $builderSearchRequestDTO)
    {
        try {
            return $this->builderService->getSuggestions($builderSearchRequestDTO);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
}
