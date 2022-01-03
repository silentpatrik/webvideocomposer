<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommandCollection;
use Illuminate\Http\Request;
use WebVideo\Models\Command;
use WebVideo\Models\RenderPipeline;

class RenderPipelineCommandsController extends Controller
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

        $commands = $renderPipeline
            ->commands()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommandCollection($commands);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request        $request,
        RenderPipeline $renderPipeline,
        Command        $command
    )
    {
        $this->authorize('update', $renderPipeline);

        $renderPipeline->commands()->syncWithoutDetaching([$command->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\RenderPipeline $renderPipeline
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request        $request,
        RenderPipeline $renderPipeline,
        Command        $command
    )
    {
        $this->authorize('update', $renderPipeline);

        $renderPipeline->commands()->detach($command);

        return response()->noContent();
    }
}
