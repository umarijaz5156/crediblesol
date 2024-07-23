<div class="h-auto flex flex-col bg-[#F4F6FC] p-5 lg:p-10">
    @if ($chat)
        <div class="flex flex-col flex-grow bg-[#F4F6FC]">
            <div class="sticky top-0 left-0 z-[2] p-6 lg:p-12 bg-[#F4F6FC]">
                <div class="flex w-full items-center justify-between mb-5">
                    <div class="flex items-center cursor-pointer transition-all duration-200 relativ">
                        <div class="w-full overflow-hidden">
                            <div>
                                <p class="font-medium text-[17px] text-gray-500">Seller Name:
                                    @php
                                    $first = $details->seller->seller->first_name ?? '';
                                    $second = $details->seller->seller->last_name ?? '';
                                    $fullName = $first . $second;
                                @endphp
                                    {{ $fullName }}</p>
                            </div>
                           
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-[16px] text-gray-600 group-hover:text-[#f0f0f0a1]">
                            {{ $chat->created_at->format('M, d Y') }}</p>
                    </div>
                </div>
                <div class="w-full bg-[#DBE0ED] h-[2px]"></div>
            </div>
            <div class="flex-grow">
                <x-chat.chat-area :chat="$chat" />

                <form wire:submit.prevent="sendMessage" class="sticky bottom-0">
                    <label for="chat" class="sr-only">Your message</label>
                    <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg drk:bg-gray-700">
                        @if($uploading)
                        <progress  class="w-full h-2 absolute top-0 left-0" max="100" value="{{ $uploadProgress }}" ></progress>
                    @endif
                    <div class="flex items-center justify-between text-xl relative">
    
                        <label for="attachments"
                            class="flex items-center space-x-2 cursor-pointer bg-transparent text-[#0096D8] py-1 rounded-md">
                            <i class="fa fa-paperclip"></i>
                            @if (count($attachments) > 0)
                                <div class="flex justify-center align-items-center relative">
                                    <div
                                        class="bg-white text-black-500 text-sm inline-flex absolute bottom-[3px] right-[-8px] w-6 h-6 pl-1.5 rounded-full border-2 border-white">
                                        {{ count($attachments) }}</div>
                                </div>
                            @endif
                        </label>
                        <input wire:model="attachments" id="attachments" type="file" multiple class="hidden" accept="{{ $allowedFileTypes }}" />
                    </div>
                        <input wire:model.live="message" id="chat" maxlength="255"
                            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 drk:bg-gray-800 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                            placeholder="Your message...">

                        <button type="submit"
                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 drk:text-blue-500 drk:hover:bg-gray-600">
                            <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                </path>
                            </svg>
                            <span class="sr-only">Send message</span>
                        </button>
                    </div>
                    <div class="px-5">
                        <x-input-error for="message" />
                        @error('attachments.*')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        @if($errors->has('attachments.*') || $errors->has('attachments') || $errors->has('attachments.*.size'))
                        {{-- @error('error') --}}
                        <div x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => { Livewire.emit('timeoutReached'); document.getElementById('alert-border-2').remove(); }, 4000)" id="alert-border-2" class=" items-center w-[95%] mx-auto text-red-500">{{ $errors->first() }}</p>
                        @endif
                        @if($errors->has('message'))
                        <div x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => { Livewire.emit('timeoutReached'); document.getElementById('alert-border-2').remove(); }, 4000)" id="alert-border-2" class=" items-center w-[95%] mx-auto text-red-500">{{ $errors->first('body') }}</p>
                        @endif
                        @error('error')
                        <div x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => { Livewire.emit('timeoutReached'); document.getElementById('alert-border-2').remove(); }, 4000)" id="alert-border-2" class=" items-center w-[95%] mx-auto text-red-500">{{ $message}}</p>
                        @enderror
                    </div>
                </form>

            </div>
        </div>
    @endif

    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>
</div>


<script>
    const scrollToBottom = (id) => {
        const element = document.getElementById(id);
        element.scrollTop = element.scrollHeight;
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('ticketSelected', (event) => {
            setTimeout(() => {
                scrollToBottom('ChatArea');
            }, 500);
        })
    })
</script>
