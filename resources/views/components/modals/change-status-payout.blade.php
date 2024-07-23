@props(['message' => 'Are you sure you want to change the status?'])

<x-modals.modal maxWidth="3xl" wire:model.live="payoutModal">
    @slot('headerTitle')
        Are you sure?
    @endslot

    @slot('content')
        <div class="p-6">
            <div class="text-center">
            <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $message }}</h3>
            </div>
            <div class="mb-5">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select status</label>
                <select id="status" wire:model.live="selectedStatus" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option >Select option</option>
                    <option value="complete">Complete</option>
                    <option value="pending">Pending</option>
                </select>
                <x-input-error for="selectedStatus" />
            </div>

            <div class="mb-4">
                <div wire:ignore>
                    <label class='relative w-full'>
                        <textarea maxlength="1000"  wire:model.live="description" id="description"
                            class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200'></textarea>
                        <span
                            class='text-sm text-gray-400 bg-white absolute left-[10px] -top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Description</span>
                    </label>
                </div>
                <x-input-error for="description" />

            </div>

            <div class="mb-4">
                <label for="reviewImages" class="block text-sm font-medium text-gray-600">Attach
                    Image</label>

                <x-form.upload-files  wire:model.live="attachment" previous="{{ $this->previousImage != null ? $this->previousImage : null }}"  perview
                    allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                <x-input-error for="attachment" />
            </div>
            <div class="text-end">

            <button wire:click.prevent="updatePayout()" type="button"
                class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button wire:click="$toggle('payoutModal')" wire:loading.attr="disabled" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                cancel</button>
            </div>
        </div>
    @endslot
</x-modals.modal>
