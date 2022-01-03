<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Database\Seeders\PermissionsSeeder;
use WebVideo\Models\Command;
use WebVideo\Models\RenderPipeline;

class RenderPipelineCommandsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'user@localhost', 'password' => Hash::make('asdasd')]);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }
}
