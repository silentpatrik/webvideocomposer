<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Command;
use App\Models\RenderPipeline;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandRenderPipelinesTest extends TestCase
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
    public function it_gets_command_render_pipelines()
    {
        $command = Command::factory()->create();
        $renderPipeline = RenderPipeline::factory()->create();

        $command->renderPipelines()->attach($renderPipeline);

        $response = $this->getJson(
            route('api.commands.render-pipelines.index', $command)
        );

        $response->assertOk()->assertSee($renderPipeline->title);
    }

    /**
     * @test
     */
    public function it_can_attach_render_pipelines_to_command()
    {
        $command = Command::factory()->create();
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->postJson(
            route('api.commands.render-pipelines.store', [
                $command,
                $renderPipeline,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $command
                ->renderPipelines()
                ->where('render_pipelines.id', $renderPipeline->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_render_pipelines_from_command()
    {
        $command = Command::factory()->create();
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->deleteJson(
            route('api.commands.render-pipelines.store', [
                $command,
                $renderPipeline,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $command
                ->renderPipelines()
                ->where('render_pipelines.id', $renderPipeline->id)
                ->exists()
        );
    }
}
