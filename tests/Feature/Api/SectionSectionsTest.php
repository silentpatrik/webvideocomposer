<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Models\Section;

class SectionSectionsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_gets_section_sections()
    {
        $section = Section::factory()->create();
        $section = Section::factory()->create();

        $section->sections()->attach($section);

        $response = $this->getJson(
            route('api.sections.sections.index', $section)
        );

        $response->assertOk()->assertSee($section->title);
    }

    /**
     * @test
     */
    public function it_can_attach_sections_to_section()
    {
        $section = Section::factory()->create();
        $section = Section::factory()->create();

        $response = $this->postJson(
            route('api.sections.sections.store', [$section, $section])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $section
                ->sections()
                ->where('sections.id', $section->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_sections_from_section()
    {
        $section = Section::factory()->create();
        $section = Section::factory()->create();

        $response = $this->deleteJson(
            route('api.sections.sections.store', [$section, $section])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $section
                ->sections()
                ->where('sections.id', $section->id)
                ->exists()
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\WebVideo\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }
}
