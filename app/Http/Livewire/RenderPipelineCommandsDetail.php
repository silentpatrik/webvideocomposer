<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WebVideo\Models\Command;
use WebVideo\Models\RenderPipeline;

class RenderPipelineCommandsDetail extends Component
{
    use AuthorizesRequests;

    public RenderPipeline $renderPipeline;
    public Command $command;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Command';

    protected $rules = [
        'command.executable' => ['required', 'max:255', 'string'],
        'command.title' => ['nullable', 'max:255', 'string'],
        'command.parallel' => ['nullable', 'numeric'],
        'command.enabled' => ['nullable', 'boolean'],
    ];

    public function mount(RenderPipeline $renderPipeline)
    {
        $this->renderPipeline = $renderPipeline;
        $this->resetCommandData();
    }

    public function resetCommandData()
    {
        $this->command = new Command();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCommand()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.render_pipeline_commands.new_title');
        $this->resetCommandData();

        $this->showModal();
    }

    public function editCommand(Command $command)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.render_pipeline_commands.edit_title');
        $this->command = $command;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->command->render_pipeline_id) {
            $this->authorize('create', Command::class);

            $this->command->render_pipeline_id = $this->renderPipeline->id;
        } else {
            $this->authorize('update', $this->command);
        }

        $this->command->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Command::class);

        Command::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCommandData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->renderPipeline->commands as $command) {
            array_push($this->selected, $command->id);
        }
    }

    public function render()
    {
        return view('livewire.render-pipeline-commands-detail', [
            'commands' => $this->renderPipeline->commands()->paginate(20),
        ]);
    }
}
