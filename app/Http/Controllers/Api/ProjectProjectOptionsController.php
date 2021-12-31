<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectOptionResource;
use App\Http\Resources\ProjectOptionCollection;

class ProjectProjectOptionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Project $project)
    {
        $this->authorize('view', $project);

        $search = $request->get('search', '');

        $projectOptions = $project
            ->options()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProjectOptionCollection($projectOptions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('create', ProjectOption::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'value' => ['required', 'max:255', 'string'],
            'settings' => ['required', 'max:255', 'json'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $projectOption = $project->options()->create($validated);

        return new ProjectOptionResource($projectOption);
    }
}
