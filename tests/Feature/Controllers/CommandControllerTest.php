<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Command;

use App\Models\RenderPipeline;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_commands()
    {
        $commands = Command::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('commands.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.commands.index')
            ->assertViewHas('commands');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_command()
    {
        $response = $this->get(route('commands.create'));

        $response->assertOk()->assertViewIs('app.commands.create');
    }

    /**
     * @test
     */
    public function it_stores_the_command()
    {
        $data = Command::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('commands.store'), $data);

        unset($data['render_pipeline_id']);

        $this->assertDatabaseHas('commands', $data);

        $command = Command::latest('id')->first();

        $response->assertRedirect(route('commands.edit', $command));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_command()
    {
        $command = Command::factory()->create();

        $response = $this->get(route('commands.show', $command));

        $response
            ->assertOk()
            ->assertViewIs('app.commands.show')
            ->assertViewHas('command');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_command()
    {
        $command = Command::factory()->create();

        $response = $this->get(route('commands.edit', $command));

        $response
            ->assertOk()
            ->assertViewIs('app.commands.edit')
            ->assertViewHas('command');
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

        $response = $this->put(route('commands.update', $command), $data);

        unset($data['render_pipeline_id']);

        $data['id'] = $command->id;

        $this->assertDatabaseHas('commands', $data);

        $response->assertRedirect(route('commands.edit', $command));
    }

    /**
     * @test
     */
    public function it_deletes_the_command()
    {
        $command = Command::factory()->create();

        $response = $this->delete(route('commands.destroy', $command));

        $response->assertRedirect(route('commands.index'));

        $this->assertDeleted($command);
    }
}
