<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RenderPipeline;
use App\Http\Requests\RenderPipelineStoreRequest;
use App\Http\Requests\RenderPipelineUpdateRequest;

class RenderPipelineController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', RenderPipeline::class);

        $search = $request->get('search', '');

        $renderPipelines = RenderPipeline::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.render_pipelines.index',
            compact('renderPipelines', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', RenderPipeline::class);

        return view('app.render_pipelines.create');
    }

    /**
     * @param \App\Http\Requests\RenderPipelineStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RenderPipelineStoreRequest $request)
    {
        $this->authorize('create', RenderPipeline::class);

        $validated = $request->validated();

        $renderPipeline = RenderPipeline::create($validated);

        return redirect()
            ->route('render-pipelines.edit', $renderPipeline)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, RenderPipeline $renderPipeline)
    {
        $this->authorize('view', $renderPipeline);

        return view('app.render_pipelines.show', compact('renderPipeline'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, RenderPipeline $renderPipeline)
    {
        $this->authorize('update', $renderPipeline);

        return view('app.render_pipelines.edit', compact('renderPipeline'));
    }

    /**
     * @param \App\Http\Requests\RenderPipelineUpdateRequest $request
     * @param \App\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function update(
        RenderPipelineUpdateRequest $request,
        RenderPipeline $renderPipeline
    ) {
        $this->authorize('update', $renderPipeline);

        $validated = $request->validated();

        $renderPipeline->update($validated);

        return redirect()
            ->route('render-pipelines.edit', $renderPipeline)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RenderPipeline $renderPipeline)
    {
        $this->authorize('delete', $renderPipeline);

        $renderPipeline->delete();

        return redirect()
            ->route('render-pipelines.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
