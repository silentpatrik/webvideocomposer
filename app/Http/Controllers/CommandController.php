<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandStoreRequest;
use App\Http\Requests\CommandUpdateRequest;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.commands.index', compact('commands', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Command::class);

        return view('app.commands.create');
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

        return redirect()
            ->route('commands.edit', $command)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Command $command)
    {
        $this->authorize('view', $command);

        return view('app.commands.show', compact('command'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Command $command)
    {
        $this->authorize('update', $command);

        return view('app.commands.edit', compact('command'));
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

        return redirect()
            ->route('commands.edit', $command)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('commands.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
