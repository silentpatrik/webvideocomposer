<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RenderPipeline;
use App\Http\Controllers\Controller;
use App\Http\Resources\RenderPipelineResource;
use App\Http\Resources\RenderPipelineCollection;
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
            ->paginate();

        return new RenderPipelineCollection($renderPipelines);
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

        return new RenderPipelineResource($renderPipeline);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, RenderPipeline $renderPipeline)
    {
        $this->authorize('view', $renderPipeline);

        return new RenderPipelineResource($renderPipeline);
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

        return new RenderPipelineResource($renderPipeline);
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

        return response()->noContent();
    }
}
