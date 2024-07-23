<div class="px-6">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif
    </div>

    <div class="mx-3">
        <div wire:ignore.self id="accordion-collapse" data-accordion="collapse">

            
        
            {{-- System Settings --}}
            <livewire:admin.settings.system-settings />

            {{-- Mail Settings --}}
            <livewire:admin.settings.mail-settings />

            {{-- payment gateway --}}
            <livewire:admin.settings.payment-gateway />

            <div>
                <h2 id="accordion-collapse-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                        data-accordion-target="#accordion-collapse-admin-email" aria-expanded="false"
                        aria-controls="accordion-collapse-admin-email">
                        <span>Config Admin Email</span>
                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-admin-email" class="hidden"
                    aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <form>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <x-admin.form.label>Admin Email</x-admin.form.label>
        
                                    <x-admin.form.input wire:model="adminEmail" />
                                </div>
                            </div>
        
                            <x-admin.button wire:click.prevent="saveAdminEmail">Save</x-admin.button>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <h2 id="accordion-collapse-ornage">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                        data-accordion-target="#accordion-collapse-orange-money" aria-expanded="false"
                        aria-controls="accordion-collapse-orange-money">
                        <span>Orange Money Account</span>
                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-orange-money" class="hidden"
                    aria-labelledby="accordion-collapse-ornage">
                    <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <form>
                            <div class="flex mb-4 ">
                                <div class="w-1/3 pr-2">
                                    <label for="orange_money_idType" class="block text-sm font-medium text-gray-600">Orange Money IdType</label>
                                    <input type="text" wire:model="orange_money_idType" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="MSISDN">
                                    <x-input-error for="orange_money_idType" />
            
                                </div>
                                <div class="w-1/3 pl-2">
                                    <label for="orange_money_id" class="block text-sm font-medium text-gray-600">Orange Money Id (9 Digits)</label>
                                    <input type="number" wire:model="orange_money_id" maxlength="9" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="786175700">
                                    <x-input-error for="orange_money_id" />
            
                                </div>
                                <div class="w-1/3 pl-2">
                                    <label for="orange_money_id" class="block text-sm font-medium text-gray-600">Orange Money Pin </label>
                                    <input type="text" wire:model="orange_money_pin" maxlength="10" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="786175700">
                                    <x-input-error for="orange_money_pin" />
            
                                </div>
                            </div>
                            <div class="text-bold text-black mb-4">
                                Please enter your Orange Money account details carefully for payout.
                            </div>

        
                            <x-admin.button wire:click.prevent="saveOrangeMoneyInfo">Save</x-admin.button>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <h2 id="accordion-collapse-commissionPercentage">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                        data-accordion-target="#accordion-collapse-commission-Percentage" aria-expanded="false"
                        aria-controls="accordion-collapse-commissionPercentage">
                        <span>Commission Percentage</span>
                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-commission-Percentage" class="hidden"
                    aria-labelledby="accordion-collapse-commissionPercentage">
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
            </div>
            <div>
                <h2 id="accordion-collapse-holdPayment">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                        data-accordion-target="#accordion-collapse-hold-payment" aria-expanded="false"
                        aria-controls="accordion-collapse-holdPayment">
                        <span>Numbers of days to hold payment</span>
                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-hold-payment" class="hidden"
                    aria-labelledby="accordion-collapse-holdPayment">
                    <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <form>
                            <div class="flex mb-4">
                                <div class="w-1/3 pl-2">
                                    <label for="numberOfDaysHoldPayment" class="block text-sm font-medium text-gray-600">number of days to hold payment:</label>
                                    <div class="relative">
                                        <input type="number" wire:model="numberOfDaysHoldPayment" maxlength="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pr-10" placeholder="100">
                                    </div>
                                    <x-input-error for="numberOfDaysHoldPayment" />
                                </div>
                            </div>
                            
                
                            <x-admin.button wire:click.prevent="saveHoldPayment">Save</x-admin.button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
