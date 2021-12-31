<?php

namespace App\Http\Controllers\Api;

use App\Models\Argument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArgumentResource;
use App\Http\Resources\ArgumentCollection;
use App\Http\Requests\ArgumentStoreRequest;
use App\Http\Requests\ArgumentUpdateRequest;

class ArgumentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Argument::class);

        $search = $request->get('search', '');

        $arguments = Argument::search($search)
            ->latest()
            ->paginate();

        return new ArgumentCollection($arguments);
    }

    /**
     * @param \App\Http\Requests\ArgumentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArgumentStoreRequest $request)
    {
        $this->authorize('create', Argument::class);

        $validated = $request->validated();

        $argument = Argument::create($validated);

        return new ArgumentResource($argument);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Argument $argument
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Argument $argument)
    {
        $this->authorize('view', $argument);

        return new ArgumentResource($argument);
    }

    /**
     * @param \App\Http\Requests\ArgumentUpdateRequest $request
     * @param \App\Models\Argument $argument
     * @return \Illuminate\Http\Response
     */
    public function update(ArgumentUpdateRequest $request, Argument $argument)
    {
        $this->authorize('update', $argument);

        $validated = $request->validated();

        $argument->update($validated);

        return new ArgumentResource($argument);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Argument $argument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Argument $argument)
    {
        $this->authorize('delete', $argument);

        $argument->delete();

        return response()->noContent();
    }
}
