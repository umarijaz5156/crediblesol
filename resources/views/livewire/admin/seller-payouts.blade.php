<div>
    <div>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Payouts</h6>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Seller Name
                                </th>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Payment Method
                                </th>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Account Details
                                </th>
                                <th
                                    class="px-2 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            @forelse ($payouts as $payout)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    <a href="{{ route('admin.seller.view', $payout->seller->id) }}"
                                                        class="text-blue-500">

                                                        {{ $payout->seller->username }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ $payout->payment_method }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {!! Str::limit($payout->account_details, 130, '...') !!}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>

                                        <button type="button" wire:click="viewPayout({{ $payout->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            View</button>


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
                    <div class="p-4 ">
                        {{ $payouts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($viewModel)
        <x-modals.modal wire:model.live="viewModel" maxWidth="3xl">
            @slot('headerTitle')
                View Payout
            @endslot

            @slot('content')
                <div class="p-4">
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Payment Method:</h3>

                        <h2 class="">{{ $seePayout->payment_method }}</h2>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Account Details:</h3>
                        <p>{!! $seePayout->account_details !!}</p>
                    </div>

                </div>
            @endslot

        </x-modals.modal>
    @endif
</div>
