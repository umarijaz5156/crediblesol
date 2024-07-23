<div>
    @push('styles')
        <style>
            #full-stars-example {

                /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
                .rating-group {
                    display: inline-flex;
                }

                /* make hover effect work properly in IE */
                .rating__icon {
                    pointer-events: none;
                }

                /* hide radio inputs */
                .rating__input {
                    position: absolute !important;
                    left: -9999px !important;
                }

                /* set icon padding and size */
                .rating__label {
                    cursor: pointer;
                    padding: 0 0.1em;
                    font-size: 2rem;
                }

                /* set default star color */
                .rating__icon--star {
                    color: orange;
                }

                /* set color of none icon when unchecked */
                .rating__icon--none {
                    color: #eee;
                }

                /* if none icon is checked, make it red */
                .rating__input--none:checked+.rating__label .rating__icon--none {
                    color: red;
                }

                /* if any input is checked, make its following siblings grey */
                .rating__input:checked~.rating__label .rating__icon--star {
                    color: #ddd;
                }

                /* make all stars orange on rating group hover */
                .rating-group:hover .rating__label .rating__icon--star {
                    color: orange;
                }

                /* make hovered input's following siblings grey on hover */
                .rating__input:hover~.rating__label .rating__icon--star {
                    color: #ddd;
                }

                /* make none icon grey on rating group hover */
                .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
                    color: #eee;
                }

                /* make none icon red on hover */
                .rating__input--none:hover+.rating__label .rating__icon--none {
                    color: red;
                }
            }

            #half-stars-example {

                /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
                .rating-group {
                    display: inline-flex;
                }

                /* make hover effect work properly in IE */
                .rating__icon {
                    pointer-events: none;
                }

                /* hide radio inputs */
                .rating__input {
                    position: absolute !important;
                    left: -9999px !important;
                }

                /* set icon padding and size */
                .rating__label {
                    cursor: pointer;
                    /* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
                    padding: 0 0.1em;
                    font-size: 2rem;
                }

                /* add padding and positioning to half star labels */
                .rating__label--half {
                    padding-right: 0;
                    margin-right: -1.2em;
                    z-index: 2;
                }

                /* set default star color */
                .rating__icon--star {
                    color: orange;
                }

                /* set color of none icon when unchecked */
                .rating__icon--none {
                    color: #eee;
                }

                /* if none icon is checked, make it red */
                .rating__input--none:checked+.rating__label .rating__icon--none {
                    color: red;
                }

                /* if any input is checked, make its following siblings grey */
                .rating__input:checked~.rating__label .rating__icon--star {
                    color: #ddd;
                }

                /* make all stars orange on rating group hover */
                .rating-group:hover .rating__label .rating__icon--star,
                .rating-group:hover .rating__label--half .rating__icon--star {
                    color: orange;
                }

                /* make hovered input's following siblings grey on hover */
                .rating__input:hover~.rating__label .rating__icon--star,
                .rating__input:hover~.rating__label--half .rating__icon--star {
                    color: #ddd;
                }

                /* make none icon grey on rating group hover */
                .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
                    color: #eee;
                }

                /* make none icon red on hover */
                .rating__input--none:hover+.rating__label .rating__icon--none {
                    color: red;
                }
            }

            #full-stars-example-two {

                /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
                .rating-group {
                    display: inline-flex;
                }

                /* make hover effect work properly in IE */
                .rating__icon {
                    pointer-events: none;
                }

                /* hide radio inputs */
                .rating__input {
                    position: absolute !important;
                    left: -9999px !important;
                }

                /* hide 'none' input from screenreaders */
                .rating__input--none {
                    display: none
                }

                /* set icon padding and size */
                .rating__label {
                    cursor: pointer;
                    padding: 0 0.1em;
                    font-size: 2rem;
                }

                /* set default star color */
                .rating__icon--star {
                    color: orange;
                }

                /* if any input is checked, make its following siblings grey */
                .rating__input:checked~.rating__label .rating__icon--star {
                    color: #ddd;
                }

                /* make all stars orange on rating group hover */
                .rating-group:hover .rating__label .rating__icon--star {
                    color: orange;
                }

                /* make hovered input's following siblings grey on hover */
                .rating__input:hover~.rating__label .rating__icon--star {
                    color: #ddd;
                }
            }
        </style>
        <style>
            .swiper-button-prev {
                background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 viewBox%3D%270 0 27 44%27%3E%3Cpath d%3D%27M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z%27 fill%3D%27%23F1691E%27%2F%3E%3C%2Fsvg%3E');
                left: 10px;
                right: auto;
            }

            .swiper-button-next,
            .swiper-container-rtl .swiper-button-prev {
                background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 viewBox%3D%270 0 27 44%27%3E%3Cpath d%3D%27M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z%27 fill%3D%27%23F1691E%27%2F%3E%3C%2Fsvg%3E');
                right: 10px;
                left: auto;
            }
        </style>
    @endpush


    <section>
        <div class="container mx-auto ">
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class=" mt-32 bg-[#f6f6f6] rounded-b-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 mt-28 md:mt-16 mb-8">
                <div class="img-display" style="max-height: 500px;">
                    <div class="px-4 md:overflow-hidden relative">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($product->attachments as $index => $attachment)
                                    <div class="swiper-slide border rounded-lg inline-block">
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" data-fancybox="group"
                                            data-caption="{{ $attachment->name }}">
                                            <div id="productimg_{{ $index }}" class="zoomImg">
                                                <img class="w-full m-auto object-cover" style="height: 500px;"
                                                    src="{{ asset('storage/' . $attachment->file_path) }}"
                                                    alt="{{ $product->name }}">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <div class="swiper-pagination"></div>
                            <div class="swiper-button-next h-4" style="color: #F1691E;"></div>
                            <div class="swiper-button-prev h-4 "></div> --}}
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-3xl font-bold text-blue">{{ ___($product->title) }}</p>
                    <div class="flex gap-4 my-5">
                        <div class="flex items-center">
                            {!! $product->generateStarRating() !!}

                        </div>
                        <span>({{ count($product->reviews) }} {{ ___('customer review') }})</span>
                    </div>
                    <div class="flex gap-3 my-3 ">
                        <b>{{ ___('Price per Unit') }}:</b> <strong
                            class="text-body-text">{{ getCurrency() }}{{ $product->price . '/' . $product->priceMetric->abbreviation }}</strong>
                    </div>
                    <div class="flex gap-3 my-3">
                        <b>{{ ___('Available Stock') }}:</b> <strong
                            class="text-body-text">{{ $product->stock . ' ' . $product->stockMetric->abbreviation }}</strong>
                    </div>

                    <p class="mt-2 mb-4 text-body-text">
                        {!! Str::limit($product->description, 600, '...') !!}
                    </p>
                    
                    <div class="mt-2">
                        @if (session('success'))
                            <x-alerts.success :success="session('success')" />
                        @endif

                        @if (session('error'))
                            <x-alerts.error :error="session('error')" />
                        @endif
                    </div>

                    <div class="mt-10 flex items-center">
                        <div class="flex items-center">
                            <div class="flex items-center mr-2">
                                <input wire:model.lazy="quantity" type="number" name="quantity" id="quantity"
                                    min="1" required max="{{ $product->stock }}"
                                    class="border focus:outline-none w-32 rounded py-2 px-3"
                                    wire:change="updateQuantity">
                                <span class="text-sm ml-1"> ({{ $product->priceMetric->abbreviation }})</span>
                            </div>

                            @error('quantity')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            @auth
                                @if (Auth::user()->seller)
                                    @if (Auth::user()->seller->id !== $product->seller_account_id)
                                        <div>
                                            <button wire:click="buy" wire:loading.attr="disabled" type="submit"
                                                class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-8 py-2">
                                                <span>{{ ___('Buy') }}</span>
                                            </button>
                                            <span wire:loading wire:target="buy">
                                                <i class="fa fa-spinner fa-spin"></i> {{ ___('Loading...') }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">{{ ___("Can't purchase own product") }}</span>
                                    @endif
                                @else
                                    <div>
                                        <button wire:click="buy" wire:loading.attr="disabled" type="submit"
                                            class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-8 py-2">
                                            <span>{{ ___('Buy') }}</span>
                                        </button>
                                        <span wire:loading wire:target="buy">
                                            <i class="fa fa-spinner fa-spin"></i> {{ ___('Loading...') }}
                                        </span>
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-white bg-gradient-to-r from-orange-400 to-orange-600 border border-orange-500 font-medium rounded-full text-sm px-5 py-2 focus:outline-none focus:shadow-outline ml-2">{{ ___('Login for purchase') }}</a>
                            @endauth

                        </div>
                    </div>

                    <div class="mb-5 text-sm text-gray-500">{{ ___('Total Price') }}: {{ getCurrency() }}
                        {{ $totalPrice }}</div>

                    <div class="border-b-2 my-3"></div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-body-text">
                                <span>{{ ___('Category') }}:</span><span>{{ $product->category->title }}</span>
                            </p>
                        </div>
                        <div class="flex gap-4">
                            
                            <div>
                                @auth
                                    @if (Auth::user()->seller && Auth::user()->seller->id !== $product->seller_account_id)
                                        <button type="button" wire:click="ChatModel()"
                                            class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-center">{{ ___('Chat') }}</button>
                                    @endif
                                    @if (!Auth::user()->seller)
                                        <button type="button" wire:click="ChatModel()"
                                            class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-center">{{ ___('Chat') }}</button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-cente">{{ ___('Login for Chat') }}</a>
                                @endauth
                            </div>
                            <div>
                                @php
                                  $userId = Auth::id();
                                  $checkalReadyReport = \App\Models\Report::where('user_id',$userId)->where('report_type','product')->where('reported_item_id',$product->id)->first();
                             @endphp
                                @auth
                                        @if (Auth::user()->seller)
                                            @if (Auth::user()->seller->id !== $product->seller_account_id)

                                                    @if (!$checkalReadyReport)
                                                    <button type="button" wire:click="reportModel({{ $product->id }}, 'product')" class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-center">{{ __('Report') }}</button>
                                                    @elseif ($checkalReadyReport)
                                                        <div class="mt-1"><span class="text-gray-500">{{ __('Already reported') }}</span></div>
                                                    @endif
                                            @else
                                                <span class="text-sm text-gray-500">{{ ___("Can't report own product") }}</span>
                                            @endif
                                        @else

                                            @if (!$checkalReadyReport)
                                            <button type="button" wire:click="reportModel({{ $product->id }}, 'product')" class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-center">{{ __('Report') }}</button>
                                            @elseif ($checkalReadyReport)
                                                <div class="mt-1"><span class="text-gray-500">{{ __('Already reported') }}</span></div>
                                            @endif

                                        @endif
                                 @endauth
                            </div>
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="max-w-screen-xl mx-auto px-4 mb-6 ">

            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block text-gray-500 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
                            id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">{{ ___('Description') }}</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block text-gray-500 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 active"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="true">{{ __('Reviews') }}
                            <span>({{ count($product->reviews) }})</span> </button>
                    </li>
                </ul>
            </div>
            <div id="myTabContent">
                <div class="p-4 hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        {!! $product->description !!}
                    </p>
                </div>
                <div class=" p-4" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="grid md:grid-cols-2">
                        <div>
                            <p class="text-lg text-body-text">{{ count($product->reviews) }} {{ ___('Review For ') }}
                                {{ $product->title }}</p>

                        </div>

                        <div>
                            <p class="text-body-text">
                                {{ ___('Only logged in customers who have purchased this product may leave a review') }}.
                            </p>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 dark:border-gray-700 mb-5">
                        @if (count($latestReviews) > 0)

                            @foreach ($latestReviews as $review)
                                <div class="flex gap-4 my-5">
                                    @if ($review->user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}"
                                            class="h-14 w-14 rounded-full" alt="{{ $review->user->name }}">
                                    @else
                                        <div
                                            class="h-14 w-14 px-7 overflow-hidden bg-gray-200 flex items-center justify-center rounded-full">
                                            <span class="text-gray-500">{{ substr($review->user->name, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <div>
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <p class="text-body-text"><strong>{{ $review->user->name }}</strong> – {{ $review->created_at->format('F j, Y') }}</p>
                                                <div class="my-2 rounded-full px-1 py-1 flex justify-start items-center gap-1">
                                                    {!! $review->generateStarRating() !!}
                                                </div>
                                            </div>
                                        
                                            <div class="text-end">
                                                @auth
                                                @php
                                                       $userId = Auth::id();
                                                       $checkalReadyReportReview = \App\Models\Report::where('user_id',$userId)->where('report_type','review')->where('reported_item_id',$review->id)->first();
                                                @endphp
                                                @if (Auth::user()->seller)
                                                    @if (Auth::user()->seller->id === $product->seller_account_id)
        
                                                    @if (!$checkalReadyReportReview)
                                                    <button type="button" wire:click="reportModel({{ $review->id }}, 'review')" class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2">{{ __('Report') }}</button>
                                                    @elseif ($checkalReadyReportReview)
                                                        <div class="mt-1"><span class="text-gray-500">{{ __('Already reported') }}</span></div>
                                                    @endif
                                                   
                                                    @endif
                                                @endif
                                         @endauth

                                                
                                        
                                            </div>
                                        </div>
                                        
                                       

                                        <i class="text-body-text">{{ $review->review }}</i>
                                        @if ($review->attachments)
                                            <div class="mt-4" style="display: flex; flex-wrap: wrap;">
                                                @foreach ($review->attachments as $attachment)
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                        data-fancybox="group"
                                                        data-caption="Image {{ $loop->index + 1 }}">
                                                        <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                            style="max-width: 100px; max-height: 100px; margin-right: 10px; margin-bottom: 10px;"
                                                            class="object-cover rounded-[6px]" alt="">
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-5  text-center">
                                <div class="text-gray-500">
                                    <p>{{ ___('Reviews not Found') }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($latestReviews instanceof \Illuminate\Pagination\AbstractPaginator && $latestReviews->hasPages())
                            <div class="mt-6 grid lg:grid-cols-12">
                                <div class="lg:col-span-12 xl:col-span-12">
                                    {{ $latestReviews->links('vendor.livewire.front-custom-pagination') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>


    <div class="text-center ">

        <div class="max-w-4xl  mx-auto mb-4 md:mb-8 ">
            <h1 class="md:mb-2 text-2xl font-bold  xl:text-4xl text-blue capitalize">
                {{ ___('Related Products') }}

            </h1>
            <span class="w-20 h-1 bg-theme-yellow inline-block"></span>

        </div>


    </div>
    <x-front.product-section :products="$products" />

    @if($addReportModel)
    <x-modals.modal wire:model.live="addReportModel" maxWidth="5xl">
        @slot('headerTitle')
            Report this {{ $this->reportInfo['report_type'] }}
        @endslot

        @slot('content')
            <form wire:submit.prevent="sendReportMessage">

                <div class="py-4">

                    <div class="mb-4">
                        <label for="report" class="block text-sm font-medium text-gray-600">Message</label>
                        <textarea wire:model.live="report" id="report" class="mt-1 p-3 w-full border rounded-md resize-none" maxlength="255"></textarea>
                        <x-input-error for="report" />
                    </div>
                    
                 
                    <div class="text-end justify-end">
                        <button type="submit"
                            class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-cente">Send</button>

                    </div>

                </div>

            </form>
        @endslot
    </x-modals.modal>
    @endif

    @if ($chatModel)

        <x-modals.modal wire:model.live="chatModel" maxWidth="5xl">
            @slot('headerTitle')
                Send Message to the Seller
            @endslot

            @slot('content')
                @if ($conversationId)
                    <a href="{{ route('buyer.chats', $conversationId) }}"
                        class="float-right my-3 text-white text-sm bg-orange-500 hover:bg-orange-600 py-1 px-2 rounded-md">Chatbox</a>
                @endif
                <form wire:submit.prevent="sendMessage">

                    <div class="py-4">

                        <div class=" mb-4">
                            <label for="firstName" class="block text-sm font-medium text-gray-600">Message</label>
                            <input wire:model.live="message" type="text" id="firstName"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="255">
                            <x-input-error for="message" />
                        </div>
                        <div class="mb-4">
                            <label for="businessImage" class="block text-sm font-medium text-gray-600">Attachments (Max:
                                5)</label>
                            <x-form.upload-files multiple wire:model.live="attachments" :allowedFileTypes="[
                                'image/png',
                                'image/jpg',
                                'image/jpeg',
                                'image/webp',
                                'application/pdf',
                                'application/msword',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            ]" />
                            @error('attachments.*')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        @error('attachments_error')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        <input type="hidden" wire:model="currentUrl" id="currentUrlInput">

                        <div class="text-end justify-end">
                            <button type="submit"
                                class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-5 py-2 text-cente">Send</button>

                        </div>

                    </div>

                </form>
            @endslot
        </x-modals.modal>
    @endif

    @if ($addReviewModel)
        <x-modals.modal wire:model.live="addReviewModel" maxWidth="5xl">
            @slot('headerTitle')
                Add Review
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdate">
                    <div class="flex justify-center">
                        <div id="half-stars-example">
                            <div class="rating-group">
                                <input class="rating__input rating__input--none" checked wire:model="rating"
                                    id="rating-0" value="0" type="radio">
                                <label aria-label="0 stars" class="rating__label" for="rating-0">&nbsp;</label>
                                <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                    for="rating-05"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-05" value="0.5"
                                    type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating-10"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-10" value="1"
                                    type="radio">
                                <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                    for="rating-15"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-15" value="1.5"
                                    type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating-20"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-20" value="2"
                                    type="radio">
                                <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                    for="rating-25"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-25" value="2.5"
                                    type="radio">
                                <label aria-label="3 stars" class="rating__label" for="rating-30"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-30" value="3"
                                    type="radio">
                                <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                    for="rating-35"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-35" value="3.5"
                                    type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating-40"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-40" value="4"
                                    type="radio">
                                <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                    for="rating-45"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-45" value="4.5"
                                    type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating-50"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-50" value="5"
                                    type="radio">
                            </div>
                        </div>

                    </div>
                    <div class="text-center"> <x-input-error for="rating" /></div>

                    <!-- Review Text -->
                    <div class="mb-4" wire:ignore>
                        <label for="review" class="block text-sm font-semibold text-black">Review</label>
                        <textarea wire:model.live="review" id="review" rows="5" maxlength="1000"
                            class="mt-1 p-3 w-full border rounded-md"></textarea>
                        <small>The minimum length is 50 characters, and the maximum length is 1000 characters.</small>

                    </div>
                    <x-input-error for="review" />

                    <div class="mb-4">
                        <label for="reviewImages" class="block text-sm font-medium text-gray-600">Attach
                            Images (Max: 5)</label>

                        <x-form.upload-files multiple wire:model.live="reviewImages" :fileData="$oldReviewImages ?? null" perview
                            allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                        <x-input-error for="reviewImages" />
                    </div>
                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit"
                            class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-8 py-2 ">
                            Submit
                        </button>
                    </div>
                </form>
            @endslot
        </x-modals.modal>
    @endif




</div>


@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            document.getElementById('currentUrlInput').value = window.location.href;
        });
    </script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
@endpush
