<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;
use App\Models\Section;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionPagesTest extends TestCase
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
    public function it_gets_section_pages()
    {
        $section = Section::factory()->create();
        $page = Page::factory()->create();

        $section->pages()->attach($page);

        $response = $this->getJson(route('api.sections.pages.index', $section));

        $response->assertOk()->assertSee($page->title);
    }

    /**
     * @test
     */
    public function it_can_attach_pages_to_section()
    {
        $section = Section::factory()->create();
        $page = Page::factory()->create();

        $response = $this->postJson(
            route('api.sections.pages.store', [$section, $page])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $section
                ->pages()
                ->where('pages.id', $page->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_pages_from_section()
    {
        $section = Section::factory()->create();
        $page = Page::factory()->create();

        $response = $this->deleteJson(
            route('api.sections.pages.store', [$section, $page])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $section
                ->pages()
                ->where('pages.id', $page->id)
                ->exists()
        );
    }
}
