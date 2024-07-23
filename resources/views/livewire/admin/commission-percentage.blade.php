<div>
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif
    </div>
    <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <form>
            <div class="flex mb-4">
                <div class="w-1/3 pl-2">
                    <label for="commissionPercentage" class="block text-sm font-medium text-gray-600">Commission Percentage:</label>
                    <div class="relative">
                        <input type="number" wire:model="commissionPercentage" maxlength="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pr-10" placeholder="100">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            %
                        </div>
                    </div>
                    <x-input-error for="commissionPercentage" />
                </div>
            </div>
            

            <x-admin.button wire:click.prevent="saveInfo">Save</x-admin.button>
        </form>
    </div>
</div>
