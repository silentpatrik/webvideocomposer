<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\RenderPipeline;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RenderPipelineControllerTest extends TestCase
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
    public function it_displays_index_view_with_render_pipelines()
    {
        $renderPipelines = RenderPipeline::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('render-pipelines.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.render_pipelines.index')
            ->assertViewHas('renderPipelines');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_render_pipeline()
    {
        $response = $this->get(route('render-pipelines.create'));

        $response->assertOk()->assertViewIs('app.render_pipelines.create');
    }

    /**
     * @test
     */
    public function it_stores_the_render_pipeline()
    {
        $data = RenderPipeline::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('render-pipelines.store'), $data);

        $this->assertDatabaseHas('render_pipelines', $data);

        $renderPipeline = RenderPipeline::latest('id')->first();

        $response->assertRedirect(
            route('render-pipelines.edit', $renderPipeline)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->get(route('render-pipelines.show', $renderPipeline));

        $response
            ->assertOk()
            ->assertViewIs('app.render_pipelines.show')
            ->assertViewHas('renderPipeline');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->get(route('render-pipelines.edit', $renderPipeline));

        $response
            ->assertOk()
            ->assertViewIs('app.render_pipelines.edit')
            ->assertViewHas('renderPipeline');
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

        $response = $this->put(
            route('render-pipelines.update', $renderPipeline),
            $data
        );

        $data['id'] = $renderPipeline->id;

        $this->assertDatabaseHas('render_pipelines', $data);

        $response->assertRedirect(
            route('render-pipelines.edit', $renderPipeline)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_render_pipeline()
    {
        $renderPipeline = RenderPipeline::factory()->create();

        $response = $this->delete(
            route('render-pipelines.destroy', $renderPipeline)
        );

        $response->assertRedirect(route('render-pipelines.index'));

        $this->assertDeleted($renderPipeline);
    }
}
