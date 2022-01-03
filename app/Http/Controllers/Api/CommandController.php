<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommandStoreRequest;
use App\Http\Requests\CommandUpdateRequest;
use App\Http\Resources\CommandCollection;
use App\Http\Resources\CommandResource;
use Illuminate\Http\Request;
use WebVideo\Models\Command;

class CommandController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Command::class);

        $search = $request->get('search', '');

        $commands = Command::search($search)
            ->latest()
            ->paginate();

        return new CommandCollection($commands);
    }

    /**
     * @param \App\Http\Requests\CommandStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandStoreRequest $request)
    {
        $this->authorize('create', Command::class);

        $validated = $request->validated();

        $command = Command::create($validated);

        return new CommandResource($command);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Command $command)
    {
        $this->authorize('view', $command);

        return new CommandResource($command);
    }

    /**
     * @param \App\Http\Requests\CommandUpdateRequest $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function update(CommandUpdateRequest $request, Command $command)
    {
        $this->authorize('update', $command);

        $validated = $request->validated();

        $command->update($validated);

        return new CommandResource($command);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Command $command)
    {
        $this->authorize('delete', $command);

        $command->delete();

        return response()->noContent();
    }
}
