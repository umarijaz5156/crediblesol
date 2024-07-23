<div>
    <h2 id="accordion-collapse-heading-payment-gateway">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-body-payment-gateway" aria-expanded="false"
            aria-controls="accordion-collapse-body-payment-gateway">
            <span>Payment Gateway</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-collapse-body-payment-gateway" class="hidden"
        aria-labelledby="accordion-collapse-heading-payment-gateway">
        <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <form wire:submit.prevent="updatePaymentGateway">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-admin.form.label>PAYTECH_KEY</x-admin.form.label>
                        <x-admin.form.input wire:model="pay_tech_api_key" placeholder="Please leave this field blank if you haven't changed it" />
                        @error('pay_tech_api_key')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <x-admin.form.label>PAYTECH_SECRET_KEY</x-admin.form.label>
                        <x-admin.form.input wire:model="pay_tech_secret_key" placeholder="Please leave this field blank if you haven't changed it" />
                        @error('pay_tech_secret_key')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <x-admin.button type="submit">Save</x-admin.button>
            </form>
        </div>
    </div>
</div>
