<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WebVideo\Models\Project;
use WebVideo\Models\ProjectOption;

class ProjectOptionsDetail extends Component
{
    use AuthorizesRequests;

    public Project $project;
    public ProjectOption $projectOption;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ProjectOption';

    protected $rules = [
        'projectOption.title' => ['required', 'max:255', 'string'],
        'projectOption.value' => ['required', 'max:255', 'string'],
        'projectOption.settings' => ['required', 'max:255', 'json'],
        'projectOption.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->resetProjectOptionData();
    }

    public function resetProjectOptionData()
    {
        $this->projectOption = new ProjectOption();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newProjectOption()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.project_options.new_title');
        $this->resetProjectOptionData();

        $this->showModal();
    }

    public function editProjectOption(ProjectOption $projectOption)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.project_options.edit_title');
        $this->projectOption = $projectOption;

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

        if (!$this->projectOption->project_id) {
            $this->authorize('create', ProjectOption::class);

            $this->projectOption->project_id = $this->project->id;
        } else {
            $this->authorize('update', $this->projectOption);
        }

        $this->projectOption->settings = json_decode(
            $this->projectOption->settings,
            true
        );

        $this->projectOption->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', ProjectOption::class);

        ProjectOption::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetProjectOptionData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->project->projectOptions as $projectOption) {
            array_push($this->selected, $projectOption->id);
        }
    }

    public function render()
    {
        return view('livewire.project-options-detail', [
            'projectOptions' => $this->project->projectOptions()->paginate(20),
        ]);
    }
}
