<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RenderPipelineCollection;
use Illuminate\Http\Request;
use WebVideo\Models\Command;
use WebVideo\Models\RenderPipeline;

class CommandRenderPipelinesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Command $command)
    {
        $this->authorize('view', $command);

        $search = $request->get('search', '');

        $renderPipelines = $command
            ->renderPipelines()
            ->search($search)
            ->latest()
            ->paginate();

        return new RenderPipelineCollection($renderPipelines);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request        $request,
        Command        $command,
        RenderPipeline $renderPipeline
    )
    {
        $this->authorize('update', $command);

        $command
            ->renderPipelines()
            ->syncWithoutDetaching([$renderPipeline->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request        $request,
        Command        $command,
        RenderPipeline $renderPipeline
    )
    {
        $this->authorize('update', $command);

        $command->renderPipelines()->detach($renderPipeline);

        return response()->noContent();
    }
}
