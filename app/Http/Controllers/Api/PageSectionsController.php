<?php
namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionCollection;

class PageSectionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Page $page)
    {
        $this->authorize('view', $page);

        $search = $request->get('search', '');

        $sections = $page
            ->sections()
            ->search($search)
            ->latest()
            ->paginate();

        return new SectionCollection($sections);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Page $page, Section $section)
    {
        $this->authorize('update', $page);

        $page->sections()->syncWithoutDetaching([$section->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Page $page, Section $section)
    {
        $this->authorize('update', $page);

        $page->sections()->detach($section);

        return response()->noContent();
    }
}
