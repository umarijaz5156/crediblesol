@props(['message'])

<x-modals.modal wire:model="warningAlertModal">
    <x-slot name="title">
        <div class="text-yellow-500 text-lg font-semibold mb-4">
            Warning!
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="bg-white w-full p-6 rounded shadow-lg">

            <p class="text-gray-700">
                {{ $message }}
            </p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button class="bg-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            wire:click="$toggle('warningAlertModal')" wire:loading.attr="disabled">
            Close
        </button>
    </x-slot>
</x-modals.modal>
