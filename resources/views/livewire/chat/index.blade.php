<div>
    {{-- <section class=>
        <div class="container mx-auto ">
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class=" mt-32 bg-[#f6f6f6] rounded-b-lg">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <div class="md:p-[80px] py-5  w-full lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1600px] mx-auto">
        <div class="py-5 mt-5 flex justify-start items-center gap-x-3 px-3 lg:px-0">
            <h1 class="text-3xl font-semibold">Chats</h1>
            <button class="btn text-[17px] lg:hidden" id="collapse-sidebar"><i class="fa-solid fa-bars"></i></button>
        </div>
        @if ($count > 0)
            <div class="w-full bg-[#F4F6FC] flex overflow-hidden rounded-3xl h-[calc(100vh - 4rem)]">
                <!-- Sidebar -->
                <div class="" style="    border-right: 1px solid #dddddd;">
                    <div class="p-5">
                        <livewire:chat.conversation-list :conversationId="$conversationId" />
                    </div>
                </div>
                <!-- Chat Messages -->
                <div class="flex-grow flex flex-col w-full"> <!-- Add w-full class here -->
                    <div class="flex-grow overflow-y-auto w-full"> <!-- Add w-full class here -->
                        <livewire:chat.conversation-chat :conversationId="$conversationId" />
                    </div>
                </div>
            </div>
        @else
            <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No Chats found yet</p>
        @endif
    </div>
    
        

    
</div>
