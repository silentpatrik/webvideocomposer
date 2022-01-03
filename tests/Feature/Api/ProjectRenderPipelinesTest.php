<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Models\Project;
use WebVideo\Models\RenderPipeline;

class ProjectRenderPipelinesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\WebVideo\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }
}
