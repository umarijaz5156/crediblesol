<div>

    <div class="pb-5 px-5  w-full lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1600px] mx-auto">
       
        <div class="p-6 pb-5 mb-0 bg-white rounded-t-2xl">
            <h1 class="text-3xl text-center font-semibold">Chats</h1>
            <hr class="border-gray-300  mt-2">
            <button class="btn text-[17px] lg:hidden" id="collapse-sidebar"><i class="fa-solid fa-bars"></i></button>

        </div>
        @if ($count > 0)
            <div class="w-full bg-[#F4F6FC] flex overflow-hidden rounded-3xl h-[calc(100vh - 4rem)]">
                <!-- Sidebar -->
                <div class="">
                    <div class="p-5">
                        <livewire:seller.chat.conversation-list :conversationId="$conversationId" />
                    </div>
                </div>
                <!-- Chat Messages -->
                <div class="flex-grow flex flex-col w-full"> <!-- Add w-full class here -->
                    <div class="flex-grow overflow-y-auto w-full"> <!-- Add w-full class here -->
                        <livewire:seller.chat.conversation-chat :conversationId="$conversationId" />
                    </div>
                </div>
            </div>
        @else
            <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No Chats found yet</p>
        @endif
    </div>
    
        

    
</div>
