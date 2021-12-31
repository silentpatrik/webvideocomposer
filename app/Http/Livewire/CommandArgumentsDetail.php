<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Command;
use App\Models\Argument;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommandArgumentsDetail extends Component
{
    use AuthorizesRequests;

    public Command $command;
    public Argument $argument;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Argument';

    protected $rules = [
        'argument.title' => ['required', 'max:255', 'string'],
        'argument.value' => ['required', 'max:255', 'string'],
        'argument.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(Command $command)
    {
        $this->command = $command;
        $this->resetArgumentData();
    }

    public function resetArgumentData()
    {
        $this->argument = new Argument();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newArgument()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.command_arguments.new_title');
        $this->resetArgumentData();

        $this->showModal();
    }

    public function editArgument(Argument $argument)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.command_arguments.edit_title');
        $this->argument = $argument;

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

        if (!$this->argument->command_id) {
            $this->authorize('create', Argument::class);

            $this->argument->command_id = $this->command->id;
        } else {
            $this->authorize('update', $this->argument);
        }

        $this->argument->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Argument::class);

        Argument::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetArgumentData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->command->arguments as $argument) {
            array_push($this->selected, $argument->id);
        }
    }

    public function render()
    {
        return view('livewire.command-arguments-detail', [
            'arguments' => $this->command->arguments()->paginate(20),
        ]);
    }
}
