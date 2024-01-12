<?php

namespace App\Http\Controllers;

use App\DTO\BuilderSubGroupSearchRequestDTO;
use App\Services\BuilderSubGroupService;
use Symfony\Component\HttpKernel\Exception\HttpException;


class BuilderSubGroupController extends Controller
{
    public $builderSubGroupService;

    public function __construct(BuilderSubGroupService $builderSubGroupService)
    {
        $this->builderSubGroupService = $builderSubGroupService;
    }

    public function getSuggestions(BuilderSubGroupSearchRequestDTO $builderSubGroupSearchRequestDTO)
    {
        try {
            return $this->builderSubGroupService->getSuggestions($builderSubGroupSearchRequestDTO);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
}
