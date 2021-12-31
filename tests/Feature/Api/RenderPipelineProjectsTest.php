<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\RenderPipeline;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RenderPipelineProjectsTest extends TestCase
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
}
