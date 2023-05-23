<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Repositories\Interfaces\LessonRepositoryInterface;
use App\Services\LessonService;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    public function __construct(
        private readonly LessonService              $lessonService,
        private readonly LessonRepositoryInterface  $lessonRepository
    )
    {
    }

    public function index(string $moduleUuid)
    {
        return LessonResource::collection(
            $this->lessonService->listLessonByModule($moduleUuid)
        );
    }

    public function store(CreateUpdateLessonRequest $request, string $moduleUuid)
    {
        return new LessonResource(
            $this->lessonService->createLesson($request->validated())
        );
    }

    public function show(string $moduleUuid, string $uuid)
    {
        return new LessonResource(
            $this->lessonRepository->findByUuid($uuid)
        );
    }

    public function update(CreateUpdateLessonRequest $request, string $moduleUuid, string $uuid)
    {
        return new LessonResource(
            $this->lessonService->updateByModule($request->validated(), $uuid)
        );
    }

    public function destroy(string $moduleUuid, string $uuid)
    {
        return response()->json(
            $this->lessonRepository->deleteByUuid($uuid),
            Response::HTTP_NO_CONTENT
        );
    }
}
