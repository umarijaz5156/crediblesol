@props(['message' => 'Are you sure you want to change the status?'])

<x-modals.modal maxWidth="3xl" wire:model.live="payoutOrangeMoneyModal">
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

            <div class="price-info-container space-y-5">
              
                <div class="flex items-center mt-3">
                    <x-admin.form.label for="totalAmount" class="flex-grow">Total order Amount: </x-admin.form.label>
                    <div class="relative flex items-center" style="margin-left: 9%">
                        <span class="price px-3 py-1 border border-gray-300 rounded">{{ $this->totalAmount }}</span>
                        <small class="currency pl-2 text-gray-500">XOF</small>

                    </div>
                </div>
            
                <div class="flex items-center mt-3">
                    <x-admin.form.label for="commissionAmount" class="flex-grow">Commission Amount: </x-admin.form.label>
                    <div class="relative flex items-center" style="margin-left: 8%">
                        <span class="price px-3 py-1 border border-gray-300 rounded">{{ $this->commissionAmount }}</span>
                        <small class="currency pl-2 text-gray-500">XOF</small>

                    </div>
                </div>
                <div class="flex items-center mt-3">
                    <x-admin.form.label for="price" class="flex-grow">Ammount to transfer: </x-admin.form.label>
                    <div class="relative  flex items-center" style="margin-left: 8%">
                        <span class="price px-3 py-1 border border-gray-300 rounded">{{ $this->price }}</span>
                        <small class="currency pl-2 text-gray-500">XOF</small>

                    </div>
                    <x-input-error for="price" class="ml-2" />
                </div>
               
            </div>
            
            
            
            
            
            <div class="mb-4 text-red-500">
                @error('error') {{ $message }} @enderror
            </div>


            <div class="text-end mt-5">

                <button wire:click.prevent="updatePayoutOrangeMoney()" type="button"
                wire:loading.attr="disabled"
                class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        <span wire:loading.remove>Yes, I'm sure</span>
                        <span wire:loading>Loading...</span>
                </button>
        
                <button wire:click="$toggle('payoutOrangeMoneyModal')" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </div>
    @endslot
</x-modals.modal>
