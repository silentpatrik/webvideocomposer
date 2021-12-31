<?php
namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageCollection;

class SectionPagesController extends Controller
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

        $pages = $section
            ->pages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PageCollection($pages);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Section $section, Page $page)
    {
        $this->authorize('update', $section);

        $section->pages()->syncWithoutDetaching([$page->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Section $section, Page $page)
    {
        $this->authorize('update', $section);

        $section->pages()->detach($page);

        return response()->noContent();
    }
}
