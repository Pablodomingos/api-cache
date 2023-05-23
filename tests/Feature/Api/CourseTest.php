<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function test_get_all_courses(): void
    {
        $response = $this->getJson('/api/courses');

        $response->assertOk();
    }

    public function test_get_count_courses(): void
    {
        Course::factory()->count(5)->create();
        $response = $this->getJson('/api/courses');

        $response->assertJsonCount(5, 'data');
        $response->assertOk();
    }

    public function test_list_specific_course(): void
    {
        /** @var Course */
        $course = Course::factory()->create();

        $response = $this->getJson("api/course/{$course->uuid}");

        $response->assertOk();
    }

    public function test_not_found_course(): void
    {
        $response = $this->getJson('api/course/fake_id');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_create_course(): void
    {
        $response = $this->postJson('api/course/', [
            'name' => 'Curso teste'
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'date'
            ]
        ]);

        $response->assertOk();
    }

    public function teste_validation_course(): void
    {
        $response = $this->postJson('api/course/', []);

        $response->assertJsonValidationErrors('name', 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function teste_update_course(): void
    {
        /** @var Course */
        $course = Course::factory()->create();
        $response = $this->putJson("api/course/{$course->uuid}", [
            'name' => 'Teste na atualização do curso',
            'description' => 'Nova descrição!'
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'date'
            ]
        ]);

        $response->assertOk();
    }

    public function teste_validation_delete_course(): void
    {
        $response = $this->deleteJson("api/course/fake_id");

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function teste_delete_course(): void
    {
        /** @var Course */
        $course = Course::factory()->create();
        $response = $this->deleteJson("api/course/{$course->uuid}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
