<div>
    <div>
        @can('create', App\Models\Command::class)
        <button class="button" wire:click="newCommand">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Command::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="command.executable"
                            label="Executable"
                            wire:model="command.executable"
                            maxlength="255"
                            placeholder="Executable"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="command.title"
                            label="Title"
                            wire:model="command.title"
                            maxlength="255"
                            placeholder="Title"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="command.parallel"
                            label="Parallel"
                            wire:model="command.parallel"
                            max="255"
                            placeholder="Parallel"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.checkbox
                            name="command.enabled"
                            label="Enabled"
                            wire:model="command.enabled"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.render_pipeline_commands.inputs.executable')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.render_pipeline_commands.inputs.title')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.render_pipeline_commands.inputs.parallel')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.render_pipeline_commands.inputs.enabled')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($commands as $command)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $command->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $command->executable ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $command->title ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $command->parallel ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $command->enabled ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $command)
                            <button
                                type="button"
                                class="button"
                                wire:click="editCommand({{ $command->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="mt-10 px-4">{{ $commands->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
