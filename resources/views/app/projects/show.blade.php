<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.projects.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('projects.index') }}" class="mr-4"
                    ><i class="mr-1 icon ion-md-arrow-back"></i
                        ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.projects.inputs.title')
                        </h5>
                        <span>{{ $project->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.projects.inputs.description')
                        </h5>
                        <span>{{ $project->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.projects.inputs.user_id')
                        </h5>
                        <span>{{ optional($project->user)->name ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('projects.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', WebVideo\Models\Project::class)
                        <a href="{{ route('projects.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', WebVideo\Models\ProjectOption::class)
                <x-partials.card class="mt-5">
                    <x-slot name="title"> Options</x-slot>

                    <livewire:project-options-detail :project="$project"/>
                </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
