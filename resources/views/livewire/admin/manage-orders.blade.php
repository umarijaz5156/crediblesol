<div>
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="fixed inset-0 text-center flex items-center justify-center bg-gray-500 opacity-70" wire:loading>
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                <div class="text-white text-2xl" style="margin-top: 25%">Loading...</div>
            </div>

            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Orders</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">

                <div class="p-3 overflow-x-auto text-center">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Order id</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    buyer Name</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Buyer email </th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Seller Name </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Seller Email </th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    product</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  text-slate-400 opacity-70">
                                    quantity</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  text-slate-400 opacity-70">
                                    Total Price</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Payout Status</th>

                                <th
                                    class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Order Status</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Payout with Orange Money</th>


                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <x-admin.table.cell>
                                        {{ $order->id }}

                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <a class="text-blue-500"
                                            href="{{ route('admin.user.view', $order->user->id) }}">

                                            {{ $order->user->name }}
                                        </a>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>

                                        {{ $order->user->email }}

                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <a class="text-blue-500"
                                            href="{{ route('admin.seller.view', $order->product->seller->id) }}">

                                            {{ $order->product->seller->username }}
                                        </a>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>

                                        {{ $order->product->seller->user->email }}

                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        <a target="_blank" class="text-blue-500"
                                            href="{{ route('products.show', [Str::slug($order->product->title), $order->product->id]) }}">
                                            {{ Str::limit($order->product->title, 20, '...') }}
                                        </a>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        {{ $order->quantity . '/' . $order->metric->abbreviation }}
                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        {{ $order->total_price . getCurrency() }}
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        {{ $order->status }}
                                        <small>(
                                            {{ $order->transaction_id ?? 'N/A' }}
                                            @if ($order->transaction_id)
                                                <button
                                                    wire:click="fetchAdditionalInfo('{{ $order->transaction_id }}')"
                                                    type="button" class="text-green-500">
                                                    <span> (Get Info)</span>
                                                </button>
                                            @endif
                                            )
                                        </small>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>

                                        @if ($order->order_status === 'complete')
                                            <span class="text-green-600">{{ ucfirst($order->order_status) }}</span>
                                        @elseif ($order->order_status === 'disputed' || $order->order_status === 'cancel')
                                            <button type="button"
                                                wire:click="confirmChangeStatus('{{ $order->id }}', '{{ $order->order_status }}')"
                                                class="text-white bg-gradient-to-r {{ $order->order_status === 'pending' ? 'from-gray-400 via-gray-500 to-gray-600 focus:ring-gray-300' : 'from-orange-400 via-orange-500 to-orange-600 focus:ring-orange-300' }} hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                {{ ucfirst($order->order_status) }} <small>(Mark Complete or Cancel)</small>
                                            </button>
                                        @else
                                            <span
                                                class=" {{ $order->order_status === 'cancel' ? 'text-red-600' : 'text-grat-600' }}">{{ ucfirst($order->order_status) }}</span>
                                        @endif

                                    </x-admin.table.cell>


                                    <x-admin.table.cell>

                                        @if ($order->product->seller->orange_money_enable)
                                            @if ($order->payout_status === 'complete')
                                                <p class="text-green-500">Already paid out</p>
                                            @else
                                                <button type="button"
                                                    wire:click="confirmPayoutWithOrangeMoney('{{ $order->id }}')"
                                                    class="text-white bg-gradient-to-r {{ $order->payout_status === 'pending' ? 'from-gray-400 via-gray-500 to-gray-600 focus:ring-gray-300' : 'from-orange-400 via-orange-500 to-orange-600 focus:ring-orange-300' }} hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                    Pay with Orange Money
                                                </button>
                                            @endif
                                        @else
                                            <p class="text-red-500">Seller need to enable
                                                <br> Orange money payment
                                            </p>
                                        @endif
                                     
                                    </x-admin.table.cell>





                                </tr>
                            @empty
                                <tr>
                                    <td class="py-4 px-6 text-center" colspan="9">
                                        No Record Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-admin.table>
                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($transactionInfoModel)
        <x-modals.modal wire:model.live="transactionInfoModel" maxWidth="5xl">
            @slot('headerTitle')
                Transaction Detail
            @endslot

            @slot('content')
                <div class="m-5">
                    @if ($responseJson)
                        <pre class="text-sm text-gray-700 whitespace-pre-wrap">{{ $responseJson }}</pre>
                    @else
                        <div>{{ $errors->first('error') }}</div>
                    @endif
                </div>
            @endslot
        </x-modals.modal>
    @endif

    @if ($payoutModal)
        <x-modals.change-status-payout message="You are going to Change Payout status" />
    @endif

    @if ($payoutOrangeMoneyModal)
        <x-modals.change-status-payout-orange-money message="You are going to send the payout with Orange Money" />
    @endif


    @if ($statusPaymentChangeInfo['orderId'] != 0)
        <x-modals.change-status-payment-modal
            message="You are going to {{ $statusPaymentChangeInfo['payment_status'] === 'complete' ? 'Complete' : 'Pending' }} Payment status" />
    @endif

    <x-modals.change-status-complete-or-cancel message="You are going to Change Order status" />

</div>

@push('scripts')
    <script>
        let editorOptions = {
            height: '250px',
            tabSpaces: 4,
            removePlugins: 'forms,smiley,iframe,link,div,save'
        };

        window.addEventListener('initReviewEditor', event => {
            function findDescriptionId() {
                const descriptionId = document.getElementById('description');
                if (descriptionId) {
                    clearInterval(reviewIdInterval);
                    const editorC = CKEDITOR.replace('description', editorOptions);
                    editorC.on('change', function(event) {
                        @this.set('description', event.editor.getData());
                    });

                    window.addEventListener('updateCkEditorBody', event => {
                        let changedVal = @this.get('description');

                        editorC.setData(changedVal);
                    });

                    const updateEvent = new Event('updateCkEditorBody');
                    window.dispatchEvent(updateEvent);
                }

            }

            const reviewIdInterval = setInterval(findDescriptionId, 200);
        });
    </script>
@endpush
