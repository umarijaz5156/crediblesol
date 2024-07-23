@props(['message' => 'Are you sure you want to change the status?'])

<x-modals.modal maxWidth="2xl" wire:model.live="changeStatusModal">
    @slot('headerTitle')
        Are you sure?
    @endslot

    @slot('content')
        <div class="p-6 text-center">
            <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $message }}</h3>

            <div class="mb-5">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select
                    status</label>
                <select id="status" wire:model.live="selectedStatus" required
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>Select option</option>
                    <option value="complete">I have received the order. Mark as completed.</option>
                    <option value="disputed">I haven't received the order. Start a dispute</option>
                </select>
                <x-input-error for="selectedStatus" />

            </div>

            <button wire:click.prevent="updateStatus()" wire:loading.attr="disabled" type="submit"
                class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-8 py-2">
                <span> Yes, I'm sure</span>
            </button>
            <span wire:loading wire:target="updateStatus()">
                <i class="fa fa-spinner fa-spin"></i> Loading...
            </span>

            <button wire:click="$toggle('changeStatusModal')" wire:loading.attr="disabled" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                cancel</button>
        </div>
    @endslot
</x-modals.modal>
