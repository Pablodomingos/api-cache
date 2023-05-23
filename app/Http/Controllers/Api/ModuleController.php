<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Services\ModuleService;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    public function __construct(
        private readonly ModuleService              $moduleService,
        private readonly ModuleRepositoryInterface  $moduleRepository
    )
    {
    }

    public function index(string $courseUuid)
    {
        return ModuleResource::collection(
            $this->moduleService->listModulesByCourse($courseUuid)
        );
    }

    public function store(CreateUpdateModuleRequest $request, string $courseUuid)
    {
        return new ModuleResource(
            $this->moduleService->createModule($request->validated())
        );
    }

    public function show(string $courseUuid, string $uuid)
    {
        return new ModuleResource(
            $this->moduleRepository->findByUuid($uuid)
        );
    }

    public function update(CreateUpdateModuleRequest $request, string $courseUuid, string $uuid)
    {
        return new ModuleResource(
            $this->moduleService->updateByCourse($request->validated(), $uuid)
        );
    }

    public function destroy(string $courseUuid, string $uuid)
    {
        return response()->json(
            $this->moduleRepository->deleteByUuid($uuid),
            Response::HTTP_NO_CONTENT
        );
    }
}
