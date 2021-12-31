<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Argument;

use App\Models\Command;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArgumentControllerTest extends TestCase
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
    public function it_displays_index_view_with_arguments()
    {
        $arguments = Argument::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('arguments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.arguments.index')
            ->assertViewHas('arguments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_argument()
    {
        $response = $this->get(route('arguments.create'));

        $response->assertOk()->assertViewIs('app.arguments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_argument()
    {
        $data = Argument::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('arguments.store'), $data);

        unset($data['command_id']);
        unset($data['enabled']);

        $this->assertDatabaseHas('arguments', $data);

        $argument = Argument::latest('id')->first();

        $response->assertRedirect(route('arguments.edit', $argument));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_argument()
    {
        $argument = Argument::factory()->create();

        $response = $this->get(route('arguments.show', $argument));

        $response
            ->assertOk()
            ->assertViewIs('app.arguments.show')
            ->assertViewHas('argument');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_argument()
    {
        $argument = Argument::factory()->create();

        $response = $this->get(route('arguments.edit', $argument));

        $response
            ->assertOk()
            ->assertViewIs('app.arguments.edit')
            ->assertViewHas('argument');
    }

    /**
     * @test
     */
    public function it_updates_the_argument()
    {
        $argument = Argument::factory()->create();

        $command = Command::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'value' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'enabled' => '1',
            'command_id' => $command->id,
        ];

        $response = $this->put(route('arguments.update', $argument), $data);

        unset($data['command_id']);
        unset($data['enabled']);

        $data['id'] = $argument->id;

        $this->assertDatabaseHas('arguments', $data);

        $response->assertRedirect(route('arguments.edit', $argument));
    }

    /**
     * @test
     */
    public function it_deletes_the_argument()
    {
        $argument = Argument::factory()->create();

        $response = $this->delete(route('arguments.destroy', $argument));

        $response->assertRedirect(route('arguments.index'));

        $this->assertDeleted($argument);
    }
}
