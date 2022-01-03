<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Models\Project;
use WebVideo\Models\RenderPipeline;

class RenderPipelineProjectsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_gets_render_pipeline_projects()
    {
        $renderPipeline = RenderPipeline::factory()->create();
        $project = Project::factory()->create();

        $renderPipeline->projects()->attach($project);

        $response = $this->getJson(
            route('api.render-pipelines.projects.index', $renderPipeline)
        );

        $response->assertOk()->assertSee($project->title);
    }

    /**
     * @test
     */
    public function it_can_attach_projects_to_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();
        $project = Project::factory()->create();

        $response = $this->postJson(
            route('api.render-pipelines.projects.store', [
                $renderPipeline,
                $project,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $renderPipeline
                ->projects()
                ->where('projects.id', $project->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_projects_from_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();
        $project = Project::factory()->create();

        $response = $this->deleteJson(
            route('api.render-pipelines.projects.store', [
                $renderPipeline,
                $project,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $renderPipeline
                ->projects()
                ->where('projects.id', $project->id)
                ->exists()
        );
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
