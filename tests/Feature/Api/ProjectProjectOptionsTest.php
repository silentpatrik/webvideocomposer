<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Models\Project;
use WebVideo\Models\ProjectOption;

class ProjectProjectOptionsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_gets_project_project_options()
    {
        $project = Project::factory()->create();
        $projectOptions = ProjectOption::factory()
            ->count(2)
            ->create([
                'project_id' => $project->id,
            ]);

        $response = $this->getJson(
            route('api.projects.project-options.index', $project)
        );

        $response->assertOk()->assertSee($projectOptions[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_project_project_options()
    {
        $project = Project::factory()->create();
        $data = ProjectOption::factory()
            ->make([
                'project_id' => $project->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.projects.project-options.store', $project),
            $data
        );

        unset($data['project_id']);

        $this->assertDatabaseHas('project_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $projectOption = ProjectOption::latest('id')->first();

        $this->assertEquals($project->id, $projectOption->project_id);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\WebVideo\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }
}
