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
        <h2 class="text-3xl font-bold mb-2 text-center">Orders</h2>
        <hr class="border-gray-300 mb-4">
    </div>

    @if (count($orders) > 0)
        <div class="p-3 overflow-x-auto">
            <x-admin.table class="text-center">
                <x-admin.table.thead>
                    <tr>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Order ID</th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Buyer Name</th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  text-slate-400 opacity-70">
                            Product</th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  text-slate-400 opacity-70">
                            Quantity</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Order Amount</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Service Fee</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            you will get</th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Order Status</th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Payout Status</th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Action</th>


                    </tr>
                </x-admin.table.thead>
                <tbody>
                    {{-- Parent Foreach --}}
                    @forelse ($orders as $order)
                        @php
                            $user = auth()->user();
                            $conversation = App\Models\Conversation::where('seller_id', $user->id)
                                ->where('buyer_id', $order->user->id)
                                ->first();
                        @endphp
                        <tr>
                            <x-admin.table.cell>
                                <p>
                                    {{ $order->id }}
                                </p>
                            </x-admin.table.cell>
                            <x-admin.table.cell>
                                <p>
                                    @if ($conversation)
                                        <a class="text-blue-500" href="{{ route('seller.chats', $conversation->id) }}">
                                            {{ $order->user->name }}
                                        </a>
                                    @else
                                        <button wire:click="createConversation({{ $order->user->id }})"
                                            class="text-blue-500">
                                            {{ $order->user->name }}
                                        </button>
                                    @endif
                                </p>
                            </x-admin.table.cell>

                            <x-admin.table.cell>
                                <p>
                                    <a target="_blank" class="text-blue-500"
                                        href="{{ route('products.show', [Str::slug($order->product->title), $order->product->id]) }}">
                                        {{ $order->product->title }}
                                    </a>
                                </p>
                            </x-admin.table.cell>

                            <x-admin.table.cell>
                                <p>
                                    {{ $order->quantity . '/' . $order->metric->abbreviation }}
                                </p>
                            </x-admin.table.cell>

                            @php
                                $settings = App\Models\Setting::whereIn('key', ['commission_percentage'])
                                    ->pluck('value', 'key')
                                    ->all();
                                $commission_percentage = $settings['commission_percentage'] ?? 0;

                                $Tprice = $order->total_price;
                                $commission_amount = ($Tprice * $commission_percentage) / 100;
                                $Payoutprice = $Tprice - $commission_amount;

                            @endphp
                            <x-admin.table.cell>
                                <p>
                                    {{ $order->total_price . getCurrency() }}
                                </p>
                            </x-admin.table.cell>
                            <x-admin.table.cell>
                                <p>
                                    {{ $commission_amount . getCurrency() }}
                                </p>
                            </x-admin.table.cell>
                            <x-admin.table.cell>
                                <p>
                                    {{ $Payoutprice . getCurrency() }}
                                </p>
                            </x-admin.table.cell>

                            <x-admin.table.cell>
                                <p>
                                    @if ($order->order_status === 'complete')
                                        <span class="text-green-600">Your order is completed, you will get paid<br> in
                                            your orange money account within next day.</span>
                                    @elseif ($order->order_status === 'disputed')
                                        <span class="text-red-600">Your order is disputed by the seller, admin <br>will
                                            reach out to you to resolve the issues.</span>
                                    @elseif($order->order_status === 'cancel')
                                        <span class="text-red-600">Your order is cancel by the admin</span>
                                    @elseif($order->order_status === 'delivered')
                                        We have notified the buyer to confirm the products.
                                    @else
                                        Buyer is waiting for shipment from your side,
                                        <br>if you have shipped the items,<br> mark it as shipped for buyer to review.
                                    @endif
                                </p>
                            </x-admin.table.cell>



                            <x-admin.table.cell>
                                <p>
                                    {{ ucfirst($order->payout_status) }} ({{ $order->transaction_id ?? 'N/A' }})
                                </p>
                            </x-admin.table.cell>
                            <x-admin.table.cell>
                                <p>
                                    @if ($order->order_status === 'complete')
                                        <span class="text-green-600">{{ ucfirst($order->order_status) }}</span>
                                    @elseif ($order->order_status === 'disputed' || $order->order_status === 'cancel')
                                        <span class="text-red-600">{{ ucfirst($order->order_status) }}</span>
                                    @elseif($order->order_status === 'delivered')
                                        Already Shipped
                                    @else
                                        <button type="button"
                                            wire:click="confirmChangeStatus('{{ $order->id }}', '{{ $order->order_status }}')"
                                            class="text-white bg-gradient-to-r {{ $order->order_status === 'pending' ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-orange-400 via-orange-500 to-orange-600 focus:ring-orange-300' }} hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Mark as Shipped
                                        </button>
                                    @endif
                                </p>
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
            {{ $orders->links() }}
        </div>
    @else
        <p class="text-center p-3">No Result Found</p>

    @endif

    @if ($showPayoutModal)
        <x-modals.modal wire:model.live="showPayoutModal" maxWidth="3xl">
            @slot('headerTitle')
                View Payout
            @endslot

            @slot('content')
                <div class="p-4">
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Payout Description:</h3>
                        <h2>{!! $this->order->payout_description ?? 'N/A' !!}</h2>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Payout Attachment:</h3>
                        @if ($this->order->payout_image)
                            <p>
                                <a href="{{ asset('storage/' . $this->order->payout_image) }}" data-fancybox="group"
                                    data-caption="Image ">
                                    <img src="{{ asset('storage/' . $this->order->payout_image) }}"
                                        style=" margin-right: 10px; margin-bottom: 10px;"
                                        class="object-cover w-full h-100 rounded-[6px]" alt="">
                                </a>
                            </p>
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                </div>
            @endslot
        </x-modals.modal>
    @endif


    @if ($statusPaymentChangeInfo['orderId'] != 0)
        <x-modals.change-status-payment-modal
            message="You are going to {{ $statusPaymentChangeInfo['payment_status'] === 'complete' ? 'Complete' : 'Pending' }} Payment status" />
    @endif

    @if ($statusChangeInfo['orderId'] != 0)
        <x-modals.change-status-modal
            message="You are going to {{ $statusChangeInfo['order_status'] === 'delivered' ? 'Delivered' : 'Pending' }} Order status" />
    @endif
</div>
