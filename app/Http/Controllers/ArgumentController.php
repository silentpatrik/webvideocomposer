<?php

namespace App\Http\Controllers;

use App\Models\Argument;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.arguments.index', compact('arguments', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Argument::class);

        return view('app.arguments.create');
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

        return redirect()
            ->route('arguments.edit', $argument)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Argument $argument
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Argument $argument)
    {
        $this->authorize('view', $argument);

        return view('app.arguments.show', compact('argument'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Argument $argument
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Argument $argument)
    {
        $this->authorize('update', $argument);

        return view('app.arguments.edit', compact('argument'));
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

        return redirect()
            ->route('arguments.edit', $argument)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('arguments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
