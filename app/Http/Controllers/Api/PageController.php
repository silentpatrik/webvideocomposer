<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageCollection;
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
            ->paginate();

        return new PageCollection($pages);
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

        return new PageResource($page);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        $this->authorize('view', $page);

        return new PageResource($page);
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

        return new PageResource($page);
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

        return response()->noContent();
    }
}
