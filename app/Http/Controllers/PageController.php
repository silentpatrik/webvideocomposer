<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Page::class);

        $search = $request->get('search', '');

        $pages = Page::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pages.index', compact('pages', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Page::class);

        return view('app.pages.create');
    }

    /**
     * @param \App\Http\Requests\PageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        $this->authorize('create', Page::class);

        $validated = $request->validated();

        $page = Page::create($validated);

        return redirect()
            ->route('pages.edit', $page)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        $this->authorize('view', $page);

        return view('app.pages.show', compact('page'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Page $page)
    {
        $this->authorize('update', $page);

        return view('app.pages.edit', compact('page'));
    }

    /**
     * @param \App\Http\Requests\PageUpdateRequest $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        $this->authorize('update', $page);

        $validated = $request->validated();

        $page->update($validated);

        return redirect()
            ->route('pages.edit', $page)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Page $page)
    {
        $this->authorize('delete', $page);

        $page->delete();

        return redirect()
            ->route('pages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
