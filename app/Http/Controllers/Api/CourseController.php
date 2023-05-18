<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Services\CourseService;
use Illuminate\Http\Request;

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
        return response()->json(
            $this->courseRepository->all()
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
