<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;
use App\Models\Section;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageSectionsTest extends TestCase
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
    public function it_gets_page_sections()
    {
        $page = Page::factory()->create();
        $section = Section::factory()->create();

        $page->sections()->attach($section);

        $response = $this->getJson(route('api.pages.sections.index', $page));

        $response->assertOk()->assertSee($section->title);
    }

    /**
     * @test
     */
    public function it_can_attach_sections_to_page()
    {
        $page = Page::factory()->create();
        $section = Section::factory()->create();

        $response = $this->postJson(
            route('api.pages.sections.store', [$page, $section])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $page
                ->sections()
                ->where('sections.id', $section->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_sections_from_page()
    {
        $page = Page::factory()->create();
        $section = Section::factory()->create();

        $response = $this->deleteJson(
            route('api.pages.sections.store', [$page, $section])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $page
                ->sections()
                ->where('sections.id', $section->id)
                ->exists()
        );
    }
}
