<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Models\Command;
use WebVideo\Models\RenderPipeline;

class CommandTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_gets_commands_list()
    {
        $commands = Command::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.commands.index'));

        $response->assertOk()->assertSee($commands[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_command()
    {
        $data = Command::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.commands.store'), $data);

        unset($data['render_pipeline_id']);

        $this->assertDatabaseHas('commands', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_command()
    {
        $command = Command::factory()->create();

        $renderPipeline = RenderPipeline::factory()->create();

        $data = [
            'executable' => $this->faker->text(255),
            'title' => $this->faker->sentence(10),
            'parallel' => '1',
            'enabled' => '1',
            'render_pipeline_id' => $renderPipeline->id,
        ];

        $response = $this->putJson(
            route('api.commands.update', $command),
            $data
        );

        unset($data['render_pipeline_id']);

        $data['id'] = $command->id;

        $this->assertDatabaseHas('commands', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_command()
    {
        $command = Command::factory()->create();

        $response = $this->deleteJson(route('api.commands.destroy', $command));

        $this->assertDeleted($command);

        $response->assertNoContent();
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
