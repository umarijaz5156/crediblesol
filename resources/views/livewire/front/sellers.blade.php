<div>
    <section>
        <div class="container mx-auto ">
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class=" mt-32 bg-[#ebcbcb] rounded-b-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#f6f6f6]">

        <div class=" bg-white pt-10 pb-12 md:pt-16 md:pb-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="text-center">

                    <div class="max-w-4xl  mx-auto mb-4 md:mb-8">
                        <h1 class="mb-1 md:mb-2 text-2xl font-bold  xl:text-4xl text-blue capitalize">
                            {{ ___('Sellers') }}

                        </h1>
                        <span class="w-20 h-1 bg-theme-yellow inline-block"></span>

                    </div>


                </div>
                @if (count($sellers) > 0)

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 mb-14">

                        @foreach ($sellers as $seller)
                            <div class="swiper-slide border rounded-lg">
                                <a href="{{ route('front.seller.products', Str::slug($seller->username)) }}">
                                    <img src="{{ asset('storage/' . $seller->business_image) }}" alt=""
                                        class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]" style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                </a>
                                <div class="px-3 md:px-5 py-6">
                                    <div class="flex gap-4 items-center">
                                        @if ($seller->user->profile_photo_url)
                                            <img src="{{ $seller->user->profile_photo_url }}" alt="Profile Photo"
                                                class="h-12 w-12 rounded-full">
                                        @else
                                            <div
                                                class="h-12 w-12 flex items-center justify-center bg-gray-300 rounded-full">
                                                <span
                                                    class="text-lg font-bold text-gray-600">{{ strtoupper(substr($seller->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <a href="{{ route('front.seller.products', Str::slug($seller->username)) }}"
                                            class="text-md font-bold text-theme-red">
                                            @php
                                                $fullname = $seller->first_name . ' ' . $seller->last_name;
                                            @endphp
                                            {{ Str::limit($fullname, 20, '...') }}
                                        </a>
                                    </div>

                                    <a href="{{ route('front.seller.products', Str::slug($seller->username)) }}"
                                        class="text-lg font-extrabold pt-4 pb-3 inline-block text-blue leading-tight">
                                        {!! ___(Str::limit($seller->description, 40, '...')) !!}
    
                                    </a>

                                    <div class="flex gap-3 justify-between mt-4">
                                        <div class="flex items-center">
                                           
                                            <div>
                                                @auth
                                                    @if (Auth::user()->seller && Auth::user()->seller->id !== $seller->id)
                                                        <button type="button" wire:click="ChatModel({{ $seller->user->id }})"
                                                            class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</button>
                                                    @endif
                                                    @if (!Auth::user()->seller)
                                                        <button type="button" wire:click="ChatModel({{ $seller->user->id }})"
                                                            class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</button>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}"
                                                        class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</a>
                                                @endauth
                                            </div>
                                            
                                        </div>
                                        <h2 class="text-body-text">{{ ___('Starting at:') }} <span
                                                class="text-theme-red font-bold">{{ getCurrency() }}{{ $seller->getMinimumProductPrice() }}
                                            </span></h2>


                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="p-5  text-center">
                        <div class="">
                            <p>Record not Found</p>
                        </div>
                    </div>
                @endif
                @if ($sellers instanceof \Illuminate\Pagination\AbstractPaginator && $sellers->hasPages())
                    <div class="mt-6 mb-6 grid lg:grid-cols-12">
                        <div class="lg:col-span-12 xl:col-span-12">
                            {{ $sellers->links('vendor.livewire.front-custom-pagination') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

</div>
