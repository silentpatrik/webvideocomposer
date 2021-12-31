<?php
namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\RenderPipeline;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;

class RenderPipelineProjectsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RenderPipeline $renderPipeline
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
     * @param \App\Models\RenderPipeline $renderPipeline
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        RenderPipeline $renderPipeline,
        Project $project
    ) {
        $this->authorize('update', $renderPipeline);

        $renderPipeline->projects()->syncWithoutDetaching([$project->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RenderPipeline $renderPipeline
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        RenderPipeline $renderPipeline,
        Project $project
    ) {
        $this->authorize('update', $renderPipeline);

        $renderPipeline->projects()->detach($project);

        return response()->noContent();
    }
}
