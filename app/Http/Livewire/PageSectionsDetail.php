<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use App\Models\Section;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PageSectionsDetail extends Component
{
    use AuthorizesRequests;

    public Page $page;
    public Section $section;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Section';

    protected $rules = [
        'section.title' => ['required', 'max:255', 'string'],
        'section.content' => ['required', 'max:255', 'string', 'json'],
    ];

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->resetSectionData();
    }

    public function resetSectionData()
    {
        $this->section = new Section();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSection()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.page_sections.new_title');
        $this->resetSectionData();

        $this->showModal();
    }

    public function editSection(Section $section)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.page_sections.edit_title');
        $this->section = $section;

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
        if (!$this->section->page_id) {
            $this->validate();
        } else {
            $this->validate([
                'section.title' => ['required', 'max:255', 'string'],
                'section.content' => ['required', 'max:255', 'string'],
            ]);
        }

        if (!$this->section->page_id) {
            $this->authorize('create', Section::class);

            $this->section->page_id = $this->page->id;
        } else {
            $this->authorize('update', $this->section);
        }

        $this->section->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Section::class);

        Section::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSectionData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->page->sections as $section) {
            array_push($this->selected, $section->id);
        }
    }

    public function render()
    {
        return view('livewire.page-sections-detail', [
            'sections' => $this->page->sections()->paginate(20),
        ]);
    }
}
