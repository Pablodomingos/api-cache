<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Services\CourseService;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function __construct(
        private readonly CourseService             $courseService,
        private readonly CourseRepositoryInterface $courseRepository
    )
    {
    }

    public function index()
    {
        return CourseResource::collection(
            $this->courseRepository->all()
        );
    }

    public function store(CreateUpdateCourseRequest $request)
    {
        return new CourseResource(
            $this->courseRepository->create($request->validated())
        );
    }

    public function show(string $uuid)
    {
        return new CourseResource(
            $this->courseRepository->findByUuid($uuid)
        );
    }

    public function update(CreateUpdateCourseRequest $request, string $uuid)
    {
        return new CourseResource(
            $this->courseRepository->updateByUuid($request->validated(), $uuid)
        );
    }

    public function destroy(string $uuid)
    {
        return response()->json(
            $this->courseRepository->deleteByUuid($uuid),
            Response::HTTP_NO_CONTENT
        );
    }
}
