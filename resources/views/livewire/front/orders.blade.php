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
    <div class="container mx-auto mt-8 mb-8 ">
        <div>
            @if (session('success'))
                <x-alerts.success :success="session('success')" />
            @endif

            @if (session('error'))
                <x-alerts.error :error="session('error')" />
            @endif
        </div>
        @if (count($orders) > 0)
            <div class="overflow-x-auto">
                <h2 class="text-2xl  py-5 text-center">{{ ___('Order History') }}</h2>
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('ORDER ID') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Seller Name') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Product') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Quantity') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Total Price') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Order Status') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Add Review') }}</th>
                            <th class="px-4 py-2 bg-gray-100 border border-gray-200">{{ ___('Action') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @php
                                $seller = App\Models\SellerAccount::findOrFail($order->product->seller_account_id);
                                $user = auth()->user();
                                $conversation = App\Models\Conversation::where('seller_id', $seller->user_id)
                                    ->where('buyer_id', $user->id)
                                    ->first();

                            @endphp
                            <tr class="text-center">
                                <td class="px-4 py-2 border border-gray-200">{{ $order->id }}</td>
                                <td class="px-4 py-2 border border-gray-200">
                                    @if ($conversation)
                                        <a class="text-blue-500" href="{{ route('buyer.chats', $conversation->id) }}">
                                            {{ $seller->username }}
                                        </a>
                                    @else
                                        <button wire:click="createConversation({{ $seller->user_id }})"
                                            class="text-blue-500">
                                            {{ $seller->username }}
                                        </button>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-200">
                                    <a target="_blank" class="text-blue-500"
                                        href="{{ route('products.show', [Str::slug($order->product->title), $order->product->id]) }}">
                                        {{ $order->product->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border border-gray-200">
                                    {{ $order->quantity . '/' . $order->metric->abbreviation }}</td>
                                <td class="px-4 py-2 border border-gray-200">{{ $order->total_price . getCurrency() }}
                                </td>
                                <td class="px-4 py-2 border border-gray-200">
                                 
                                    @if ($order->order_status === 'complete')
                                    <span class="text-green-600">Order is completed.</span>
                                    @elseif ($order->order_status === 'disputed') 
                                    <span class="text-red-600">Admin is resolving your dispute request.</span>
                                    @elseif($order->order_status === 'cancel')
                                    <span class="text-red-600">Your order is cancel by the admin</span>
                                    @elseif($order->order_status === 'delivered')
                                        Seller has shipped your items,<br>if you have received the items,<br>mark it as completed or start a dispute.	
                                    @else
                                        We will notify you when the seller <br>has shipped your item
                                    @endif

                                </td>
                                <td class="px-4 py-2 border border-gray-200">
                                    
                                    @if ($order->order_status === 'complete')
                                       
                                    @if ($order->review)
                                    <span class="text-sm  items-center" data-toggle="tooltip" title="{{ $order->review->review }}" style="cursor: pointer;">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $order->review->rating)
                                                <i class="fas fa-star text-yellow-500"></i>
                                            @else
                                                <i class="far fa-star text-gray-500"></i>
                                            @endif
                                        @endfor<br>
                                        <span class="truncate">{{ \Illuminate\Support\Str::limit($order->review->review, 30, '...') }}</span>
                                    </span>
                                    
                                
                                    @else
                                        <button type="button" wire:click="ReviewModel({{ $order->id }})"
                                            class="text-white  text-center bg-theme-red border border-theme-red focus:outline-none font-medium rounded text-sm px-4 py-2">
                                            {{  ___('Review') }}
                                        </button>
                                    @endif
                                    @else

                                     <span class="text-red-600  text-sm px-5 py-2 text-center">
                                            {{ ___('Please wait for order completion') }}
                                        </span>  
                                    @endif


                                </td>

                                <td class="px-4 flex gap-3 py-2 border border-gray-200">
                                    <button type="button" wire:click="viewOrderModel('{{ $order->id }}')"
                                        class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded text-sm px-2 py-2 flex items-center justify-center">
                                        {{ __('View') }}
                                    </button>
                                    @if ($order->order_status === 'delivered' || $order->order_status === 'disputed')
                                    <button type="button"
                                        wire:click="confirmChangeStatus('{{ $order->id }}', '{{ $order->order_status }}')"
                                        class="text-white  text-center bg-theme-red border border-theme-red focus:outline-none font-medium rounded text-sm px-2 py-2 ">
                                       Complete or Dispute
                                    </button>
                                     @endif
                                    
                                </td>
                                

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                @if ($orders instanceof \Illuminate\Pagination\AbstractPaginator && $orders->hasPages())
                    <div class="mt-6 mb-6 grid lg:grid-cols-12">
                        <div class="lg:col-span-12 xl:col-span-12">
                            {{ $orders->links('vendor.livewire.front-custom-pagination') }}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <p class="text-center p-3">{{ ___('No Result Found') }}</p>
        @endif
    </div>


    @if ($viewOrderModal)
        <x-modals.modal wire:model.live="viewOrderModal" maxWidth="5xl">
            @slot('headerTitle')
                Order Details
            @endslot

            @slot('content')
                <div class="bg-white shadow-md rounded-lg p-6 m-5">
                    <div class="flex justify-between mb-4">
                        <div class="w-full">
                            <p class="font-semibold pt-3">Order Id</p>
                            <p>{{ $selectedOrder->id }}</p>
                            <p class="font-semibold pt-3">Quantity:</p>
                            <p>{{ $selectedOrder->quantity }}</p>
                            <p class="font-semibold pt-3">Total Price:</p>
                            <p>{{ $selectedOrder->total_price . getCurrency() }}</p>
                            <p class="font-semibold pt-3">Product Name:</p>
                            <a target="_blank" class="text-blue-500"
                                href="{{ route('products.show', [Str::slug($selectedOrder->product->title), $selectedOrder->product->id]) }}">
                                {{ $selectedOrder->product->title }}
                            </a>
                            <p class="font-semibold pt-3"> Seller:</p>
                            <p>{{ $selectedOrder->product->seller->first_name }}
                                {{ $selectedOrder->product->seller->last_name }}</p>

                            <p class="font-semibold pt-3"> Payment Status:</p>
                            <p class=" {{ $order->payment_status === 'complete' ? 'text-green-500' : 'text-red-600' }}">
                                {{ucfirst($order->payment_status) }}
                            </p>
                            <p class="font-semibold pt-3">Order Status:</p>
                            <p>
                                @if ($selectedOrder->order_status === 'delivered')
                                    <p class="text-green-500"> Shipped </p>
                                @else
                                    <p class="text-orange-500"> {{ $selectedOrder->order_status }} </p>
                                @endif
                            </p>

                            @if ($selectedOrder->order_status === 'delivered' || $selectedOrder->order_status === 'disputed')
                                <div class="mt-1">
                                    <p>Your order has been shipped.</p>
                                    <p>
                                        If you have received your order, you can mark it as completed or initiate a dispute
                                        from the blow button.</p>
                                </div>
                                <button type="button"
                                    wire:click="confirmChangeStatus('{{ $selectedOrder->id }}', '{{ $selectedOrder->order_status }}')"
                                    class="text-white  mt-3 text-center bg-theme-red border border-theme-red focus:outline-none font-medium rounded text-sm px-2 py-2 ">
                                    Complete or Dispute
                                </button>
                            @else
                                <div class="mt-1">

                                    <p> Please wait while we prepare your order for shipping.
                                        </p>
                                    <p>"We'll notify you once it's ready to be shipped.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>

                    </div>
                </div>
            @endslot
        </x-modals.modal>
    @endif


    @if ($addReviewModel)
        <x-modals.modal wire:model.live="addReviewModel" maxWidth="5xl">
            @slot('headerTitle')
                Add Review for ({{ $selectedProduct->title }})
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdate">
                    <div class="flex justify-center">
                        <div id="half-stars-example">
                            <div class="rating-group">
                                <input class="rating__input rating__input--none" checked wire:model="rating" id="rating-0"
                                    value="0" type="radio">
                                <label aria-label="0 stars" class="rating__label" for="rating-0">&nbsp;</label>
                                <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating-05"><i
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
                        <small>'The minimum length is 50 characters, and the maximum length is 1000 characters.</small>

                    </div>
                    <x-input-error for="review" />

                    <div class="mb-4">
                        <label for="reviewImages" class="block text-sm font-medium text-gray-600">
                            Attach Images (Max: 5)
                        </label>

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


    <x-modals.change-status-complete message="You are going to to Change Order status" />


</div>
