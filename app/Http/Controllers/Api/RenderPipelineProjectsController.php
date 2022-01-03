<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;
use Illuminate\Http\Request;
use WebVideo\Models\Project;
use WebVideo\Models\RenderPipeline;

class RenderPipelineProjectsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RenderPipeline $renderPipeline)
    {
        $this->authorize('view', $renderPipeline);

        $search = $request->get('search', '');

        $projects = $renderPipeline
            ->projects()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProjectCollection($projects);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @param \WebVideo\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request        $request,
        RenderPipeline $renderPipeline,
        Project        $project
    )
    {
        $this->authorize('update', $renderPipeline);

        $renderPipeline->projects()->syncWithoutDetaching([$project->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @param \WebVideo\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request        $request,
        RenderPipeline $renderPipeline,
        Project        $project
    )
    {
        $this->authorize('update', $renderPipeline);

        $renderPipeline->projects()->detach($project);

        return response()->noContent();
    }
}
