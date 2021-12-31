<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Command;
use App\Models\RenderPipeline;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RenderPipelineCommandsTest extends TestCase
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
    public function it_gets_render_pipeline_commands()
    {
        $renderPipeline = RenderPipeline::factory()->create();
        $command = Command::factory()->create();

        $renderPipeline->commands()->attach($command);

        $response = $this->getJson(
            route('api.render-pipelines.commands.index', $renderPipeline)
        );

        $response->assertOk()->assertSee($command->title);
    }

    /**
     * @test
     */
    public function it_can_attach_commands_to_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();
        $command = Command::factory()->create();

        $response = $this->postJson(
            route('api.render-pipelines.commands.store', [
                $renderPipeline,
                $command,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $renderPipeline
                ->commands()
                ->where('commands.id', $command->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_commands_from_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();
        $command = Command::factory()->create();

        $response = $this->deleteJson(
            route('api.render-pipelines.commands.store', [
                $renderPipeline,
                $command,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $renderPipeline
                ->commands()
                ->where('commands.id', $command->id)
                ->exists()
        );
    }
}
