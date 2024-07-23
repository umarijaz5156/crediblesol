@props(['message', 'model', 'confirm'])

@php
    $model = isset($model) && $model != '' ? $model : 'twoStepConfirmationModal';
    $confirm = isset($confirm) && $confirm != '' ? $confirm : 'confirm()';
@endphp
<x-modals.modal maxWidth="2xl" wire:model="{{ $model }}">
    @slot('title')
        Are you sure?
    @endslot

    @slot('content')
        <p class="px-5">{{ $message }}</p>
    @endslot

    @slot('footer')
        <button class="w-32 py-3 px-5 bg-[#E53E3E] border border-[#E53E3E] rounded text-white"
            style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"
            wire:click="{{ $confirm }}">
            Confirm
        </button>
        <button class="w-32 py-3 px-5 bg-gray-300 border border-gray-300 rounded text-gray-600 ml-3"
            style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"
            wire:click="$set('{{ $model }}', false)">
            Cancel
        </button>
    @endslot
</x-modals.modal>
