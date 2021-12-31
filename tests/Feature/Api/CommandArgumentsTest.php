<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Command;
use App\Models\Argument;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandArgumentsTest extends TestCase
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
    public function it_gets_command_arguments()
    {
        $command = Command::factory()->create();
        $arguments = Argument::factory()
            ->count(2)
            ->create([
                'command_id' => $command->id,
            ]);

        $response = $this->getJson(
            route('api.commands.arguments.index', $command)
        );

        $response->assertOk()->assertSee($arguments[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_command_arguments()
    {
        $command = Command::factory()->create();
        $data = Argument::factory()
            ->make([
                'command_id' => $command->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.commands.arguments.store', $command),
            $data
        );

        unset($data['command_id']);
        unset($data['enabled']);

        $this->assertDatabaseHas('arguments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $argument = Argument::latest('id')->first();

        $this->assertEquals($command->id, $argument->command_id);
    }
}
