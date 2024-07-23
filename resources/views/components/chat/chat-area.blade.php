@props(['chat'])

<div class="flex items-start p-4 h-[65vh] overflow-y-auto overflow-x-hidden justify-between flex-wrap" id="ChatArea">
    <div class="flex-grow w-full">
        @if ($chat)
            @foreach ($chat->messages as $message)
                @if ($message->sender_id != auth()->user()->id)
                    <div class="chat-msg mt-4 flex p-[0_20px_30px]">
                        <div class="relative flex-shrink-0 ">
                            @if (isset($message->sender->profile_photo_path))
                                <img class="w-10 h-10 rounded-full object-cover ml-2"
                                    src="{{ asset('/storage/' . $message->sender->profile_photo_path) }}"
                                    alt="{{ $message->sender->name }}">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-300 text-gray-600 font-semibold ml-2">
                                    {{ substr($message->sender->name, 0, 1) }}
                                </div>
                            @endif

                        </div>
                        @if ($chat->buyer_id == $message->sender_id)
                            <div class="ml-3 max-w-[70%] flex flex-col items-start">
                                <div
                                    class="{{ $chat->buyer_id == $message->sender_id ? 'bg-green-300' : 'bg-white' }} p-3 rounded-[0px_25px_25px_25px] leading-[1.5] text-[14px] text-[#273346] mb-2 font-normal break-all">
                                    <p>{{ $message->message }}</p>
                                </div>
                                <div class="flex justify-end pb-2">
                                    @if ($message->attachments->isNotEmpty())
                                    @foreach ($message->attachments as $attachment)
                                        @php
                                            $extension = pathinfo($attachment->file_path, PATHINFO_EXTENSION);
                                            $imageExtensions = [
                                                'jpg',
                                                'jpeg',
                                                'png',
                                                'gif',
                                                'bmp',
                                                'webp',
                                                'svg',
                                                'tiff',
                                            ];
                                        @endphp

                                        @if (in_array(strtolower($extension), $imageExtensions))
                                            <div class="mt-2 px-2">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    data-fancybox="group" data-caption="{{ $attachment->name }}">
                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        style="max-width: 50px; max-height: 50px; margin-right: 10px; margin-bottom: 10px;"
                                                        class="object-cover rounded-[6px]"
                                                        alt="{{ $attachment->name }}">
                                                </a>
                                            </div>
                                        @else
                                            <div class="mt-2 px-2">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    class="text-blue-500 underline flex items-center gap-4" download>
                                                    <p>{{ $attachment->name }}</p>
                                                    <button type="button">
                                                        <i class="fa-solid fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                </div>
                                <div class="pl-2 left-auto w-full text-[12px] font-normal textblack whitespace-nowrap">
                                    {{ $message->created_at->format('h:i a') }} by {{ $message->sender->name }}
                                </div>
                            </div>
                        @elseif ($chat->seller_id == $message->sender_id)
                            <div class="ml-3 max-w-[70%] flex flex-col items-start">
                                <div
                                    class="{{ $chat->seller_id == $message->sender_id ? 'bg-green-300' : 'bg-white' }} p-3 rounded-[0px_25px_25px_25px] leading-[1.5] text-[14px] text-[#273346] mb-2 font-normal break-all">
                                    <p>{{ $message->message }}</p>
                                </div>

                                <div class="flex justify-end pb-2">
                                    @if ($message->attachments->isNotEmpty())
                                    @foreach ($message->attachments as $attachment)
                                        @php
                                            $extension = pathinfo($attachment->file_path, PATHINFO_EXTENSION);
                                            $imageExtensions = [
                                                'jpg',
                                                'jpeg',
                                                'png',
                                                'gif',
                                                'bmp',
                                                'webp',
                                                'svg',
                                                'tiff',
                                            ];
                                        @endphp

                                        @if (in_array(strtolower($extension), $imageExtensions))
                                            <div class="mt-2 px-2">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    data-fancybox="group" data-caption="{{ $attachment->name }}">
                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        style="max-width: 50px; max-height: 50px; margin-right: 10px; margin-bottom: 10px;"
                                                        class="object-cover rounded-[6px]"
                                                        alt="{{ $attachment->name }}">
                                                </a>
                                            </div>
                                        @else
                                            <div class="mt-2 px-2">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    class="text-blue-500 underline flex items-center gap-4" download>
                                                    <p>{{ $attachment->name }}</p>
                                                    <button type="button">
                                                        <i class="fa-solid fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                </div>

                                <div class="pl-2 left-auto w-full text-[12px] font-normal textblack whitespace-nowrap">
                                    {{ $message->created_at->format('h:i a') }} by {{ $message->sender->name }}
                                </div>
                            </div>
                        @endif

                    </div>
                @else
                    <div class="flex justify-end pt-4 p-[0_20px_30px]">
                        <div class="ml-3 max-w-[70%] flex flex-col items-start">
                            <div class="mb-2 break-all">
                                <div
                                    class="flex bg-white p-3 rounded-lg leading-[1.5] font-normal text-[14px] text-black shadow-md">
                                    <p>{{ $message->message }}</p>
                                </div>
                            </div>
                            <div class="flex justify-end pb-2">

                                @if ($message->attachments->isNotEmpty())
                                    @foreach ($message->attachments as $attachment)
                                        @php
                                            $extension = pathinfo($attachment->file_path, PATHINFO_EXTENSION);
                                            $imageExtensions = [
                                                'jpg',
                                                'jpeg',
                                                'png',
                                                'gif',
                                                'bmp',
                                                'webp',
                                                'svg',
                                                'tiff',
                                            ];
                                        @endphp

                                        @if (in_array(strtolower($extension), $imageExtensions))
                                            <div class="mt-2 px-2">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    data-fancybox="group" data-caption="{{ $attachment->name }}">
                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        style="max-width: 50px; max-height: 50px; margin-right: 10px; margin-bottom: 10px;"
                                                        class="object-cover rounded-[6px]"
                                                        alt="{{ $attachment->name }}">
                                                </a>
                                            </div>
                                        @else
                                            <div class="mt-2 px-2">
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    class="text-blue-500 underline flex items-center gap-4" download>
                                                    <p>{{ $attachment->name }}</p>
                                                    <button type="button">
                                                        <i class="fa-solid fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>

                            <div class=" pl-2 left-auto  w-full text-[12px] font-normal textblack whitespace-nowrap">
                                {{ $message->created_at->format('h:i a') }} by {{ $message->sender->name }}
                            </div>

                        </div>
                        <div class="flex-shrink-0  mb-[-20px] relative">
                            @if (isset($message->sender->profile_photo_path))
                                <img class="w-10 h-10 rounded-full object-cover ml-2"
                                    src="{{ asset('/storage/' . $message->sender->profile_photo_path) }}"
                                    alt="{{ $message->sender->name }}">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-300 text-gray-600 font-semibold ml-2">
                                    {{ substr($message->sender->name, 0, 1) }}
                                </div>
                            @endif


                        </div>

                    </div>
                @endif
            @endforeach
        @endif
    </div>

</div>
