<div class="mx-8">
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
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Reports</h6>
            </div>
            <div class="flex items-center md:ml-auto md:pr-4">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Report Type
                                </th>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Reporter Name
                                </th>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Message
                                </th>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Reported Item
                                </th>
                                <th
                                    class="px-2 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($reports as $report)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ $report->report_type }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[50px] font-semibold leading-tight text-xs">
                                            {{ $report->user->name }}

                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[250px] font-semibold leading-tight text-xs">
                                            <span class="text-sm  items-center" data-toggle="tooltip"
                                                title="{{ $report->message }}" style="cursor: pointer;">

                                                {{ \Illuminate\Support\Str::limit($report->message, 30, '...') }}
                                            </span>
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0  font-semibold leading-tight text-xs">
                                            @if ($report->report_type == 'product')
                                                Product: <a class="text-blue-500"
                                                    href="{{ route('products.show', [Str::slug($report->product->title), $report->product->id]) }}">
                                                    {{ \Illuminate\Support\Str::limit($report->product->title, 30, '...') }}
                                                </a>
                                            @elseif ($report->report_type == 'review')
                                                <span class="text-sm  items-center" data-toggle="tooltip"
                                                    title="{{ $report->review->review }}" style="cursor: pointer;">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $report->review->rating)
                                                            <i class="fas fa-star text-yellow-500"></i>
                                                        @else
                                                            <i class="far fa-star text-gray-500"></i>
                                                        @endif
                                                    @endfor
                                                    <br>
                                                    <span
                                                        class="truncate">{{ \Illuminate\Support\Str::limit($report->review->review, 30, '...') }}</span>
                                                </span>
                                            @endif
                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>

                                        @if ($report->report_type == 'product')
                                        <button type="button"
                                        wire:click="confirmChangeStatus('{{ $report->product->id }}', '{{ $report->product->approved }}')"
                                        class="text-white bg-gradient-to-r {{ $report->product->approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $report->product->approved ? 'Approved' : 'Not approved' }}</button>

                                    @elseif ($report->report_type == 'review')
                                    <button type="button"
                                    wire:click="confirmChangeReviewStatus('{{ $report->review->id }}', '{{ $report->review->is_approved }}')"
                                    class="text-white bg-gradient-to-r {{ $report->review->is_approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $report->review->is_approved ? 'Approved' : 'Not approved' }}</button>

                                    @endif
                                      

                                        <button type="button" wire:click="viewReports({{ $report->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            View
                                        </button>

                                        <button type="button" wire:click="deleteReport({{ $report->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Delete
                                        </button>
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
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-modals.delete-alert message="You are going to delete Report." />

    @if ($changeStatusModal)

    <x-modals.change-status-modal
    message="You are going to {{ $statusChangeInfo['approved'] ? 'approve' : 'disapprove' }} Product status" />
    @endif
    
    @if ($changeStatusReviewModal)

    <x-modals.change-status-review-modal
    message="You are going to {{ $statusChangeInfoReview['approved'] ? 'approve' : 'disapprove' }} Review status" />
    @endif

    @if ($viewReport)
    <x-modals.modal wire:model.live="viewReport" maxWidth="2xl">
        @slot('headerTitle')
            View Report Details
        @endslot

        @slot('content')
            <div class="p-4">
                <div class="mb-4">
                    <p class="mb-2"><strong>User:</strong>                            
                        <a class="text-blue-500" href="{{ route('admin.user.view',$reportDetails->user->id) }}">
                        {{ $reportDetails->user->name }}</a></p>
                    <p class="mb-2"><strong>Report Type:</strong> {{ $reportDetails->report_type }}</p>
                    <p class="mb-2"><strong>Message:</strong> {{ $reportDetails->message }}</p>
                    @if ($reportDetails->report_type == 'product')
                        <p class="mb-2"><strong>Product:</strong>
                            <a class="text-blue-500"
                                href="{{ route('products.show', [Str::slug($reportDetails->product->title), $reportDetails->product->id]) }}">{{ $reportDetails->product->title }}</a>
                        </p>
                    @elseif ($reportDetails->report_type == 'review')
                        <h3 class="text-xl mb-2 bold">Review Details</h3>
                        <p class="mb-2"><strong>Review:</strong> {{ $reportDetails->review->review }}</p>
                        <div class="flex items-center mb-2">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $report->review->rating)
                                    <i class="fas fa-star text-yellow-500"></i>
                                @else
                                    <i class="far fa-star text-gray-500"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="mb-2"><strong>Review Product:</strong>
                            <a class="text-blue-500"
                                href="{{ route('products.show', [Str::slug($reportDetails->review->product->title), $reportDetails->review->product->id]) }}">{{ $reportDetails->review->product->title }}</a>
                        </p>
                        <p class="mb-2"><strong>Reviewer User:</strong>
                            <a class="text-blue-500" href="{{ route('admin.user.view',$reportDetails->review->user->id) }}">
                            {{ $reportDetails->review->user->name  }}</a>  </p>

                    @endif
                </div>
            </div>
        @endslot
    </x-modals.modal>
@endif




</div>
