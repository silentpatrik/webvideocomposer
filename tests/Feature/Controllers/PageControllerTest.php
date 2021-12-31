<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Page;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
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
    public function it_displays_index_view_with_pages()
    {
        $pages = Page::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pages.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pages.index')
            ->assertViewHas('pages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_page()
    {
        $response = $this->get(route('pages.create'));

        $response->assertOk()->assertViewIs('app.pages.create');
    }

    /**
     * @test
     */
    public function it_stores_the_page()
    {
        $data = Page::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pages.store'), $data);

        $this->assertDatabaseHas('pages', $data);

        $page = Page::latest('id')->first();

        $response->assertRedirect(route('pages.edit', $page));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_page()
    {
        $page = Page::factory()->create();

        $response = $this->get(route('pages.show', $page));

        $response
            ->assertOk()
            ->assertViewIs('app.pages.show')
            ->assertViewHas('page');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_page()
    {
        $page = Page::factory()->create();

        $response = $this->get(route('pages.edit', $page));

        $response
            ->assertOk()
            ->assertViewIs('app.pages.edit')
            ->assertViewHas('page');
    }

    /**
     * @test
     */
    public function it_updates_the_page()
    {
        $page = Page::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug,
        ];

        $response = $this->put(route('pages.update', $page), $data);

        $data['id'] = $page->id;

        $this->assertDatabaseHas('pages', $data);

        $response->assertRedirect(route('pages.edit', $page));
    }

    /**
     * @test
     */
    public function it_deletes_the_page()
    {
        $page = Page::factory()->create();

        $response = $this->delete(route('pages.destroy', $page));

        $response->assertRedirect(route('pages.index'));

        $this->assertDeleted($page);
    }
}
