<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Section;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionSectionsTest extends TestCase
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
}
