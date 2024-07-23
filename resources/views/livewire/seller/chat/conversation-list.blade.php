<div class="flex  flex-col h-full bg-white shadow-md">
    <button class="absolute top-3 right-3 lg:hidden" id="close-sidebar"><i class="fas fa-times"></i></button>
    @if($conversations->isNotEmpty())
        @foreach($conversations as $conversation)
            <div 
            wire:click="$dispatch('ticketSelected', { conversation: {{ $conversation }} })" 
                class="{{ $selectedConversation == $conversation->id ? 'bg-[#f1691e] text-white' : '' }} flex items-center p-5 cursor-pointer transition-all duration-200 my-1 rounded-[20px] relative group hover:bg-gradient-to-t hover:from-[#f1691e] hover:to-[#f1691e] hover:text-black text-black"
            >
                @if (isset($conversation->buyer->profile_photo_path))
                    <img 
                        class="w-10 h-10 rounded-full object-cover ml-2"
                        src="{{ asset('/storage/' . $conversation->buyer->profile_photo_path) }}"
                        alt="{{ $conversation->buyer->name }}"
                    >
                @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-300 text-gray-600 font-semibold ml-2">
                        {{ substr($conversation->buyer->name, 0, 1) }}
                    </div>
                @endif
                <div class="ml-4">{{ $conversation->buyer->name }}</div>
            </div>
            <hr>
        @endforeach
    @else
        <div class="flex items-center justify-center h-full">
            <p class="text-gray-600">No conversations available.</p>
        </div>
    @endif
</div>
