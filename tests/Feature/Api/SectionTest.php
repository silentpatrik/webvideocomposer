<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use WebVideo\Models\Page;
use WebVideo\Models\Section;

class SectionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_gets_sections_list()
    {
        $sections = Section::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sections.index'));

        $response->assertOk()->assertSee($sections[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_section()
    {
        $data = Section::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sections.store'), $data);

        unset($data['page_id']);

        $this->assertDatabaseHas('sections', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.sections.update', $section),
            $data
        );

        unset($data['page_id']);

        $data['id'] = $section->id;

        $this->assertDatabaseHas('sections', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_section()
    {
        $section = Section::factory()->create();

        $response = $this->deleteJson(route('api.sections.destroy', $section));

        $this->assertDeleted($section);

        $response->assertNoContent();
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
