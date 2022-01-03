<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArgumentCollection;
use App\Http\Resources\ArgumentResource;
use Illuminate\Http\Request;
use WebVideo\Models\Command;

class CommandArgumentsController extends Controller
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

        $arguments = $command
            ->arguments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ArgumentCollection($arguments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \WebVideo\Models\Command $command
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Command $command)
    {
        $this->authorize('create', Argument::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'value' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $argument = $command->arguments()->create($validated);

        return new ArgumentResource($argument);
    }
}
