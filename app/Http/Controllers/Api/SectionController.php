<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionStoreRequest;
use App\Http\Requests\SectionUpdateRequest;
use App\Http\Resources\SectionCollection;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Request;
use WebVideo\Models\Section;

class SectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Section::class);

        $search = $request->get('search', '');

        $sections = Section::search($search)
            ->latest()
            ->paginate();

        return new SectionCollection($sections);
    }

    /**
     * @param \App\Http\Requests\SectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionStoreRequest $request)
    {
        $this->authorize('create', Section::class);

        $validated = $request->validated();

        $section = Section::create($validated);

        return new SectionResource($section);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Section $section)
    {
        $this->authorize('view', $section);

        return new SectionResource($section);
    }

    /**
     * @param \App\Http\Requests\SectionUpdateRequest $request
     * @param \WebVideo\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionUpdateRequest $request, Section $section)
    {
        $this->authorize('update', $section);

        $validated = $request->validated();

        $section->update($validated);

        return new SectionResource($section);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Section $section)
    {
        $this->authorize('delete', $section);

        $section->delete();

        return response()->noContent();
    }
}
