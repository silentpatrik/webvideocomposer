<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionStoreRequest;
use App\Http\Requests\SectionUpdateRequest;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.sections.index', compact('sections', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Section::class);

        return view('app.sections.create');
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

        return redirect()
            ->route('sections.edit', $section)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Section $section)
    {
        $this->authorize('view', $section);

        return view('app.sections.show', compact('section'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Section $section)
    {
        $this->authorize('update', $section);

        return view('app.sections.edit', compact('section'));
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

        return redirect()
            ->route('sections.edit', $section)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('sections.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
