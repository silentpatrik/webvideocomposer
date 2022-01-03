<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.commands.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('commands.index') }}" class="mr-4"
                    ><i class="mr-1 icon ion-md-arrow-back"></i
                        ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.commands.inputs.executable')
                        </h5>
                        <span>{{ $command->executable ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.commands.inputs.title')
                        </h5>
                        <span>{{ $command->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.commands.inputs.parallel')
                        </h5>
                        <span>{{ $command->parallel ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.commands.inputs.enabled')
                        </h5>
                        <span>{{ $command->enabled ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('commands.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', WebVideo\Models\Command::class)
                        <a href="{{ route('commands.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', WebVideo\Models\Argument::class)
                <x-partials.card class="mt-5">
                    <x-slot name="title"> Arguments</x-slot>

                    <livewire:command-arguments-detail :command="$command"/>
                </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
