<div class="flex  flex-col h-full bg-white shadow-md">
    <button class="absolute top-3 right-3 lg:hidden" id="close-sidebar"><i class="fas fa-times"></i></button>
    @if($conversations->isNotEmpty())
        @foreach($conversations as $conversation)
            <div 
            wire:click="$dispatch('ticketSelected', { conversation: {{ $conversation }} })" 
                class="{{ $selectedConversation == $conversation->id ? 'bg-[#f1691e] text-white' : '' }} flex items-center p-5 cursor-pointer transition-all duration-200 my-1 rounded-[20px] relative group hover:bg-gradient-to-t hover:from-[#f1691e] hover:to-[#f1691e] hover:text-black text-black"
            >
            @php
                            $first = $conversation->seller->seller->first_name ?? '';
                            $second = $conversation->seller->seller->last_name ?? '';
                            $fullName = $first . ' ' . $second;
                        @endphp
                @if (isset($conversation->seller->profile_photo_path))
                    <img 
                        class="w-10 h-10 rounded-full object-cover ml-2"
                        src="{{ asset('/storage/' . $conversation->seller->profile_photo_path) }}"
                        alt="{{ $conversation->seller->seller->first_name }}"
                    >
                @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-300 text-gray-600 font-semibold ml-2">
                        
                        {{ substr($fullName, 0, 1) }}
                    </div>
                @endif
                <div class="ml-4">{{ $fullName }}</div>
            </div>
            <hr>
        @endforeach
        @if($totalChats > $perpage)
        <div class="px-2 py-2 sticky bottom-0  bg-gray-200">
            <div class="flex {{ $pageNumber > 1 ?  'justify-between' : 'justify-end'}}">
                @if($pageNumber > 1)
                    <button wire:click='previousPage'
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        « 
                    </button>
                @endif
                
                @if($perpage == count($conversations))
                    <button wire:click='nextPage'
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                         »
                    </button>
                @endif
            </div>
        </div>
        @endif
    @else
        <div class="flex items-center justify-center h-full">
            <p class="text-gray-600">No conversations available.</p>
        </div>
    @endif
</div>
