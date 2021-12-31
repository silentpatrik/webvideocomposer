@php $editing = isset($command) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="executable"
            label="Executable"
            value="{{ old('executable', ($editing ? $command->executable : '')) }}"
            maxlength="255"
            placeholder="Executable"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            value="{{ old('title', ($editing ? $command->title : '')) }}"
            maxlength="255"
            placeholder="Title"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="parallel"
            label="Parallel"
            value="{{ old('parallel', ($editing ? $command->parallel : '1')) }}"
            max="255"
            placeholder="Parallel"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="enabled"
            label="Enabled"
            :checked="old('enabled', ($editing ? $command->enabled : 1))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
