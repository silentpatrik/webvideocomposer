<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use WebVideo\Models\Page;
use WebVideo\Models\Section;

class SectionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_displays_index_view_with_sections()
    {
        $sections = Section::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sections.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sections.index')
            ->assertViewHas('sections');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_section()
    {
        $response = $this->get(route('sections.create'));

        $response->assertOk()->assertViewIs('app.sections.create');
    }

    /**
     * @test
     */
    public function it_stores_the_section()
    {
        $data = Section::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sections.store'), $data);

        unset($data['page_id']);

        $this->assertDatabaseHas('sections', $data);

        $section = Section::latest('id')->first();

        $response->assertRedirect(route('sections.edit', $section));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_section()
    {
        $section = Section::factory()->create();

        $response = $this->get(route('sections.show', $section));

        $response
            ->assertOk()
            ->assertViewIs('app.sections.show')
            ->assertViewHas('section');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_section()
    {
        $section = Section::factory()->create();

        $response = $this->get(route('sections.edit', $section));

        $response
            ->assertOk()
            ->assertViewIs('app.sections.edit')
            ->assertViewHas('section');
    }

    /**
     * @test
     */
    public function it_updates_the_section()
    {
        $section = Section::factory()->create();

        $page = Page::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text,
            'page_id' => $page->id,
        ];

        $response = $this->put(route('sections.update', $section), $data);

        unset($data['page_id']);

        $data['id'] = $section->id;

        $this->assertDatabaseHas('sections', $data);

        $response->assertRedirect(route('sections.edit', $section));
    }

    /**
     * @test
     */
    public function it_deletes_the_section()
    {
        $section = Section::factory()->create();

        $response = $this->delete(route('sections.destroy', $section));

        $response->assertRedirect(route('sections.index'));

        $this->assertDeleted($section);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\WebVideo\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }
}
