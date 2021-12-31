<?php
namespace App\Http\Controllers\Api;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionCollection;

class SectionSectionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Section $section)
    {
        $this->authorize('view', $section);

        $search = $request->get('search', '');

        $sections = $section
            ->sections()
            ->search($search)
            ->latest()
            ->paginate();

        return new SectionCollection($sections);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Section $section, Section $section)
    {
        $this->authorize('update', $section);

        $section->sections()->syncWithoutDetaching([$section->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Section $section,
        Section $section
    ) {
        $this->authorize('update', $section);

        $section->sections()->detach($section);

        return response()->noContent();
    }
}
