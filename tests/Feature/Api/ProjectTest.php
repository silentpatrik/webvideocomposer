<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Project;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_projects_list()
    {
        $projects = Project::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.projects.index'));

        $response->assertOk()->assertSee($projects[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_project()
    {
        $data = Project::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.projects.store'), $data);

        $this->assertDatabaseHas('projects', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_project()
    {
        $project = Project::factory()->create();

        $user = User::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.projects.update', $project),
            $data
        );

        $data['id'] = $project->id;

        $this->assertDatabaseHas('projects', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson(route('api.projects.destroy', $project));

        $this->assertDeleted($project);

        $response->assertNoContent();
    }
}
