<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Argument;

use App\Models\Command;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArgumentTest extends TestCase
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
    public function it_gets_arguments_list()
    {
        $arguments = Argument::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.arguments.index'));

        $response->assertOk()->assertSee($arguments[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_argument()
    {
        $data = Argument::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.arguments.store'), $data);

        unset($data['command_id']);
        unset($data['enabled']);

        $this->assertDatabaseHas('arguments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.arguments.update', $argument),
            $data
        );

        unset($data['command_id']);
        unset($data['enabled']);

        $data['id'] = $argument->id;

        $this->assertDatabaseHas('arguments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_argument()
    {
        $argument = Argument::factory()->create();

        $response = $this->deleteJson(
            route('api.arguments.destroy', $argument)
        );

        $this->assertDeleted($argument);

        $response->assertNoContent();
    }
}
