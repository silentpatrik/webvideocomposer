<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\RenderPipeline;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectRenderPipelinesTest extends TestCase
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
    public function it_gets_project_render_pipelines()
    {
        $project = Project::factory()->create();
        $renderPipeline = RenderPipeline::factory()->create();

        $project->renderPipelines()->attach($renderPipeline);

        $response = $this->getJson(
            route('api.projects.render-pipelines.index', $project)
        );

        $response->assertOk()->assertSee($renderPipeline->title);
    }

    /**
     * @test
     */
    public function it_can_attach_render_pipelines_to_project()
    {
        $project = Project::factory()->create();
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->postJson(
            route('api.projects.render-pipelines.store', [
                $project,
                $renderPipeline,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $project
                ->renderPipelines()
                ->where('render_pipelines.id', $renderPipeline->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_render_pipelines_from_project()
    {
        $project = Project::factory()->create();
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->deleteJson(
            route('api.projects.render-pipelines.store', [
                $project,
                $renderPipeline,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $project
                ->renderPipelines()
                ->where('render_pipelines.id', $renderPipeline->id)
                ->exists()
        );
    }
}
