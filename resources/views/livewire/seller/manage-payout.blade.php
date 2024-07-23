<div>
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>
    <div class="p-6 pb-5 mb-0 bg-white rounded-t-2xl">
        <h2 class="text-3xl font-bold mb-2 text-center">Payout</h2>
        <hr class="border-gray-300 mb-4">
    </div>
    <div>
      
        <div
        class="relative p-8 flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        
            <div>
                <form class="my-5 space-y-6" wire:submit.prevent="register">

                <div class="flex mb-4">
                    <div class="text-2xl font-medium text-black-600">Receive Payment via Orange Money</div>
                    <div class="ml-4 mt-1">
                        <input type="checkbox" id="receive_payment_toggle" wire:click="toggleReceivePayment"
                            wire:model="receive_payment" class="form-checkbox h-5 w-5 text-indigo-600"
                            @if ($receive_payment) checked @endif>
                        <label for="receive_payment_toggle"
                            class="ml-2 text-sm font-medium text-gray-600">Enable</label>
                    </div>
                </div>

                @if ($receive_payment)
                    <div class="flex mb-4 ">
                        <div class="w-1/2 pr-2">
                            <label for="orange_money_idType" class="block text-sm font-medium text-gray-600">Orange Money IdType</label>
                            <input type="text" wire:model.live="orange_money_idType"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="MSISDN">
                            <x-input-error for="orange_money_idType" />
                        </div>
                        <div class="w-1/2 pl-2">
                            <label for="orange_money_id" class="block text-sm font-medium text-gray-600">Orange Money Id (9 Digits)</label>
                            <input type="number" wire:model.live="orange_money_id" maxlength="9"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="786175700">
                            <x-input-error for="orange_money_id" />
                        </div>
                    </div>

                    <div class="text-bold text-black mb-4">
                        Please enter your Orange Money account details carefully for payout.
                    </div>
                @endif
                 <!-- Register Button -->
                 <button type="submit"
                 class="bg-blue-500 text-white rounded-full py-2 px-4 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue float-right">
                 Submit
             </button>
         </form>
         

            </div>
        </div>
    </div>



</div>
