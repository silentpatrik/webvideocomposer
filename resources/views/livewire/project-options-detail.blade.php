<div>
    <div>
        @can('create', WebVideo\Models\ProjectOption::class)
            <button class="button" wire:click="newProjectOption">
                <i class="mr-1 icon ion-md-add text-primary"></i>
                @lang('crud.common.new')
            </button>
        @endcan @can('delete-any', WebVideo\Models\ProjectOption::class)
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
                                name="projectOption.title"
                                label="Title"
                                wire:model="projectOption.title"
                                maxlength="255"
                                placeholder="Title"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                                name="projectOption.value"
                                label="Value"
                                wire:model="projectOption.value"
                                maxlength="255"
                                placeholder="Value"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                                name="projectOption.settings"
                                label="Settings"
                                wire:model="projectOption.settings"
                                maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                                name="projectOption.description"
                                label="Description"
                                wire:model="projectOption.description"
                                maxlength="255"
                        ></x-inputs.textarea>
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
                    @lang('crud.project_options.inputs.title')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.project_options.inputs.value')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.project_options.inputs.settings')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.project_options.inputs.description')
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody class="text-gray-600">
            @foreach ($projectOptions as $projectOption)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                                type="checkbox"
                                value="{{ $projectOption->id }}"
                                wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $projectOption->title ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $projectOption->value ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <pre>
{{ json_encode($projectOption->settings) ?? '-' }}</pre
                        >
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $projectOption->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                                role="group"
                                aria-label="Row Actions"
                                class="relative inline-flex align-middle"
                        >
                            @can('update', $projectOption)
                                <button
                                        type="button"
                                        class="button"
                                        wire:click="editProjectOption({{ $projectOption->id }})"
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
                    <div class="mt-10 px-4">
                        {{ $projectOptions->render() }}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
