<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\RenderPipeline;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RenderPipelineTest extends TestCase
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
    public function it_gets_render_pipelines_list()
    {
        $renderPipelines = RenderPipeline::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.render-pipelines.index'));

        $response->assertOk()->assertSee($renderPipelines[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_render_pipeline()
    {
        $data = RenderPipeline::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.render-pipelines.store'), $data);

        $this->assertDatabaseHas('render_pipelines', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.render-pipelines.update', $renderPipeline),
            $data
        );

        $data['id'] = $renderPipeline->id;

        $this->assertDatabaseHas('render_pipelines', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->deleteJson(
            route('api.render-pipelines.destroy', $renderPipeline)
        );

        $this->assertDeleted($renderPipeline);

        $response->assertNoContent();
    }
}
