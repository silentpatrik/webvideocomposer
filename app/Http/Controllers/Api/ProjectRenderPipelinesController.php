<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RenderPipelineCollection;
use Illuminate\Http\Request;
use WebVideo\Models\Project;
use WebVideo\Models\RenderPipeline;

class ProjectRenderPipelinesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Project $project)
    {
        $this->authorize('view', $project);

        $search = $request->get('search', '');

        $renderPipelines = $project
            ->renderPipelines()
            ->search($search)
            ->latest()
            ->paginate();

        return new RenderPipelineCollection($renderPipelines);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Project $project
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request        $request,
        Project        $project,
        RenderPipeline $renderPipeline
    )
    {
        $this->authorize('update', $project);

        $project
            ->renderPipelines()
            ->syncWithoutDetaching([$renderPipeline->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Project $project
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request        $request,
        Project        $project,
        RenderPipeline $renderPipeline
    )
    {
        $this->authorize('update', $project);

        $project->renderPipelines()->detach($renderPipeline);

        return response()->noContent();
    }
}
