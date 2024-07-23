<div>
    <section class="bg-theme-blue text-white lg:py-14 py-6">

        <div class="grid max-w-screen-xl px-4 pt-32 pb-10 mx-auto md:gap-24 gap-14 lg:pt-28 lg:pb-10 lg:grid-cols-12">

            <div class="lg:mt-0 lg:col-span-5 lg:flex order-2 md:order-1">
                <div class="py-2">
                    <img src="{{ asset('images/img/hero.webp') }}" alt="mockup">
                </div>

            </div>

            <div class="place-self-center lg:col-span-7 order-1 md:order-2">
                <h3 class="text-theme-red text-lg font-bold mb-2 capitalize">{{ ___('the final word in freshness') }}
                </h3>
                <h1 class="text-4xl lg:text-5xl font-bold text-white relative !leading-tight">
                    {{ ___('DEALS OF THE DAY') }}
                </h1>
                <p class="md:max-w-md mb-6 py-4">
                    {{ ___('Discover fresh and delicious seafood every day at amazing prices.') }}
                </p>
                <a href="{{ route('category.products') }}"
                    class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-3 me-4">
                    {{ ___('Shop Now') }}
                </a>
            </div>


        </div>
    </section>


    <section class="py-12 md:py-20">
        <div class="max-w-screen-xl mx-auto px-4">

            <div class=" mb-6 text-center">
                <h1 class="mb-2 text-2xl font-bold  xl:text-4xl text-blue relative !leading-tight">
                    {{ ___('Categories') }}
                </h1>
                <span class="w-20 h-1 bg-theme-yellow inline-block"></span>

            </div>
            @if (count($categories) > 0)

                <div class="categories-slider relative overflow-hidden mx-auto pb-10 md:pb-0">

                    <div class="swiper-wrapper">

                        @foreach ($categories as $index => $category)
                            <div class="swiper-slide">
                                <div class="text-center flex justify-center items-center flex-col">
                                    <a href="{{ route('category.products', Str::slug($category->title)) }}"
                                        class="block">
                                        <div class="h-full w-full relative">
                                            <img src="{{ asset('storage/' . $category->icon_path) }}" alt=""
                                                class=" object-cover rounded-full aspect-square aspect-w-3 aspect-h-2  min-h-[120px] max-h-[120px]"
                                                style="min-width: 100%;border: 1px solid #E5E7EB;">
                                        </div>
                                    </a>
                                    <div class="pt-2">
                                        <a href="{{ route('category.products', Str::slug($category->title)) }}"
                                            class="text-sm md:text-lg font-medium capitalize">{{ ___(Str::limit($category->title, 14, '...')) }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (count($categories) > 12)
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] hover:bg-[#f8f8f8] right-0"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                        </div>
                        <div class="swiper-button-prev shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] rotate-180 hover:bg-[#f8f8f8]"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                        </div>
                    @endif


                </div>
            @else
                <div class="p-3 text-center">
                    <p> {{ ___('No Found') }}</p>
                </div>
            @endif

        </div>


    </section>


    <section class="bg-[#f6f6f6] lg:py-8 py-6 bg-[length:48%_auto] bg-no-repeat bg-blend-screen bg-right-bottom	"
        style="background-image: url('img/about-bg.webp');">

        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-24 lg:pt-16 lg:pb-16 lg:grid-cols-12">

            <div class=" lg:mt-0 mt-5 lg:col-span-6 lg:flex order-2 md-order-1">
                <div class="py-2">
                    <img src="{{ asset('images/img/about.webp') }}" alt="">
                </div>

            </div>

            <div class="place-self-center lg:col-span-6 order-1 md-order-2">
                <h2 class="mb-1 md:mb-4 text-lg lg:text-xl font-medium text-theme-red">
                    {{ ___('The Final Word In Freshness') }}</h2>
                <h1 class="mb-1 md:mb-4 text-3xl lg:text-5xl font-bold text-blue">{{ ___('About FishApp') }}</h1>
                <p class="mb-6 py-4 text-body-text">
                    {{ ___('Discover the freshest seafood and explore the world of FishApp. We bring you the finest selection of fish and seafood, sourced from trusted suppliers and delivered to your doorstep.') }}
                </p>
                <a href="{{ route('about') }}"
                    class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-3 me-4">
                    {{ ___('Read More') }}
                </a>
            </div>


        </div>
    </section>


    <section class="pt-10 pb-12 md:pt-16 md:pb-20">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center">

                <div class="max-w-4xl  mx-auto mb-4 md:mb-8">
                    <h1 class="md:mb-2 text-2xl font-bold  xl:text-4xl text-blue capitalize">
                        {{ ___('Highest rated products') }}
                    </h1>
                    <span class="w-20 h-1 bg-theme-yellow inline-block"></span>

                </div>
            </div>
            @if (count($products) > 0)

                <div class="px-4 md-overflow-hidden overflow-hidden relative">
                    <div class="high-rated-prod ">
                        <div class="swiper-wrapper">
                            @foreach ($products as $product)
                                <div class="swiper-slide bg-[#f6f6f6] rounded-b-lg">
                                    <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}">
                                        @if ($product->attachments->count() > 0)
                                            <img src="{{ asset('storage/' . $product->attachments->first()->file_path) }}"
                                                alt=""
                                                class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]"
                                                style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                        @else
                                            <img src="{{ asset('images/img/slide1.webp') }}" alt=""
                                                class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]"
                                                style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                        @endif
                                    </a>

                                    <div class="px-2 md:px-4 py-6">
                                        <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                            class="text-md font-medium">
                                            {{ ___(Str::limit($product->title, 23, '...')) }}</a>
                                        <div class="flex gap-3 justify-between mt-1 mb-4">
                                            <h2 class="text-body-text">
                                                {{ getCurrency() }}{{ $product->price . '/' . $product->priceMetric->abbreviation }}
                                            </h2>

                                            <div class="flex items-center">
                                                {!! $product->generateStarRating() !!}

                                            </div>
                                        </div>
                                        <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                            class="text-white text-center bg-theme-red border border-theme-red focus:outline-none font-medium rounded-3xl text-sm px-2 py-2 block">
                                            {{ ___('Add to Cart') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="right-1 swiper-button-next shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] hover:bg-[#f8f8f8]"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                        </div>
                        <div class="left-1 swiper-button-prev shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] rotate-180 hover:bg-[#f8f8f8]"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                        </div>
                    </div>
                </div>
            @else
                <div class="p-3 text-center">
                    <p>{{ ___('No Found') }}</p>
                </div>
            @endif
        </div>
    </section>

    <section class="pt-10 pb-12 md:pt-16 md:pb-20">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center">

                <div class="max-w-4xl  mx-auto mb-4 md:mb-8">
                    <h1 class="md:mb-2 text-2xl font-bold  xl:text-4xl text-blue capitalize">
                        {{ ___('Latest products') }}

                    </h1>
                    <span class="w-20 h-1 bg-theme-yellow inline-block"></span>

                </div>
            </div>
            @if (count($latestProducts) > 0)

                <div class="px-4 md-overflow-hidden overflow-hidden relative">
                    <div class="high-rated-prod ">
                        <div class="swiper-wrapper">
                            @foreach ($latestProducts as $product)
                                <div class="swiper-slide bg-[#f6f6f6] rounded-b-lg">
                                    <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}">
                                        @if ($product->attachments->count() > 0)
                                            <img src="{{ asset('storage/' . $product->attachments->first()->file_path) }}"
                                                alt=""
                                                class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]"
                                                style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                        @else
                                            <img src="{{ asset('images/img/slide1.webp') }}" alt=""
                                                class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]"
                                                style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                        @endif
                                    </a>

                                    <div class="px-2 md:px-4 py-6">
                                        <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                            class="text-md font-medium">
                                            {{ ___(Str::limit($product->title, 23, '...')) }}</a>
                                        <div class="flex gap-3 justify-between mt-1 mb-4">
                                            <h2 class="text-body-text">
                                                {{ getCurrency() }}{{ $product->price . '/' . $product->priceMetric->abbreviation }}
                                            </h2>

                                            <div class="flex items-center">
                                                {!! $product->generateStarRating() !!}

                                            </div>
                                        </div>
                                        <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                            class="text-white text-center bg-theme-red border border-theme-red focus:outline-none font-medium rounded-3xl text-sm px-2 py-2 block">
                                            {{ ___('Add to Cart') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="right-1 swiper-button-next shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] hover:bg-[#f8f8f8]"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                        </div>
                        <div class="left-1 swiper-button-prev shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] rotate-180 hover:bg-[#f8f8f8]"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                        </div>
                    </div>
                </div>
            @else
                <div class="p-3 text-center">
                    <p>
                        {{ ___('No Found') }}

                    </p>
                </div>
            @endif
        </div>
    </section>

    <section class="bg-[#f6f6f6]">

        <div class=" my-4 bg-white pt-10 pb-12 md:pt-16 md:pb-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="text-center">

                    <div class="max-w-4xl  mx-auto mb-4 md:mb-8">
                        <h1 class="mb-1 md:mb-2 text-2xl font-bold  xl:text-4xl text-blue capitalize">

                            {{ ___('Featured Sellers') }}

                        </h1>
                        <span class="w-20 h-1 bg-theme-yellow inline-block"></span>
                    </div>
                </div>
                @if (count($featureSellers) > 0)

                    <div class="px-4 md:overflow-hidden relative">
                        <div class="high-rated-seller">
                            <div class="swiper-wrapper">

                                @foreach ($featureSellers as $seller)
                                    <div class="swiper-slide border rounded-lg">

                                        <a href="{{ route('front.seller.products', Str::slug($seller->username)) }}">
                                            <img src="{{ asset('storage/' . $seller->business_image) }}"
                                                alt=""
                                                class="aspect-w-3 aspect-h-2 object-cover rounded-t-lg min-h-[250px] max-h-[250px]"
                                                style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                        </a>


                                        <div class="px-3 md:px-5 py-6">
                                            <div class="flex gap-4 items-center">
                                                @if ($seller->user->profile_photo_url)
                                                    <img src="{{ $seller->user->profile_photo_url }}"
                                                        alt="Profile Photo" class="h-12 w-12 rounded-full">
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
                                                {!! ___(Str::limit($seller->description, 30, '...')) !!}
                                            </a>

                                            <div class="flex gap-3 justify-between mt-4">
                                                <div class="flex items-center" style="width: 100%">
                                                    <div>
                                                        @auth
                                                            @if (Auth::user()->seller && Auth::user()->seller->id !== $seller->id)
                                                                <button type="button"
                                                                    wire:click="ChatModel({{ $seller->user->id }})"
                                                                    class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</button>
                                                            @endif
                                                            @if (!Auth::user()->seller)
                                                                <button type="button"
                                                                    wire:click="ChatModel({{ $seller->user->id }})"
                                                                    class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</button>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('login') }}"
                                                                class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</a>
                                                        @endauth
                                                    </div>
                                                </div>
                                                <h2 class="text-body-text text-end">{{ ___('Starting at') }}: <span
                                                        class="text-theme-red font-bold">{{ getCurrency() }}{{ $seller->getMinimumProductPrice() }}
                                                    </span></h2>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="right-1 swiper-button-next shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] hover:bg-[#f8f8f8]"
                                style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                            </div>
                            <div class="left-1 swiper-button-prev shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] rotate-180 hover:bg-[#f8f8f8]"
                                style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-3 text-center">
                        <p>
                            {{ ___('No Found') }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <section class="bg-[#f6f6f6]">

        <div class=" my-4 bg-white pt-10 pb-12 md:pt-16 md:pb-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="text-center">

                    <div class="max-w-4xl  mx-auto mb-4 md:mb-8">
                        <h1 class="mb-1 md:mb-2 text-2xl font-bold  xl:text-4xl text-blue capitalize">

                            {{ ___('Top Sellers') }}

                        </h1>
                        <span class="w-20 h-1 bg-theme-yellow inline-block"></span>
                    </div>
                </div>
                @if (count($sellers) > 0)

                    <div class="px-4 md:overflow-hidden relative">
                        <div class="high-rated-seller">
                            <div class="swiper-wrapper">

                                @foreach ($sellers as $seller)
                                    <div class="swiper-slide border rounded-lg">

                                        <a href="{{ route('front.seller.products', Str::slug($seller->username)) }}">
                                            <img src="{{ asset('storage/' . $seller->business_image) }}"
                                                alt=""
                                                class="aspect-w-3 aspect-h-2 object-cover rounded-t-lg min-h-[250px] max-h-[250px]"
                                                style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                                        </a>
                                        <div class="px-3 md:px-5 py-6">
                                            <div class="flex gap-4 items-center">
                                                @if ($seller->user->profile_photo_url)
                                                    <img src="{{ $seller->user->profile_photo_url }}"
                                                        alt="Profile Photo" class="h-12 w-12 rounded-full">
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
                                                {!! ___(Str::limit($seller->description, 30, '...')) !!}
                                            </a>

                                            <div class="flex gap-3 justify-between mt-4">
                                                <div class="flex items-center" style="width: 100%">
                                                    <div>
                                                        @auth
                                                            @if (Auth::user()->seller && Auth::user()->seller->id !== $seller->id)
                                                                <button type="button"
                                                                    wire:click="ChatModel({{ $seller->user->id }})"
                                                                    class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</button>
                                                            @endif
                                                            @if (!Auth::user()->seller)
                                                                <button type="button"
                                                                    wire:click="ChatModel({{ $seller->user->id }})"
                                                                    class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</button>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('login') }}"
                                                                class="text-theme-red border border-theme-red font-medium rounded-full text-sm px-2 py-1 text-center">{{ ___('Contact') }}</a>
                                                        @endauth
                                                    </div>
                                                </div>
                                                <h2 class="text-body-text text-end">{{ ___('Starting at') }}: <span
                                                        class="text-theme-red font-bold">{{ getCurrency() }}{{ $seller->getMinimumProductPrice() }}
                                                    </span></h2>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="right-1 swiper-button-next shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] hover:bg-[#f8f8f8]"
                                style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                            </div>
                            <div class="left-1 swiper-button-prev shadow-md bg-white rounded-full md-h-[50px] md-w-[50px] h-[35px] w-[35px] bg-[length:28px_18px] rotate-180 hover:bg-[#f8f8f8]"
                                style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2027%2044%27%3E%3Cpath%20d%3D%27M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z%27%20fill%3D%27%23000000%27%2F%3E%3C%2Fsvg%3E')">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-3 text-center">
                        <p>
                            {{ ___('No Found') }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <section class="bg-[#f6f6f6] lg:py-8 py-6 bg-[length:52%_auto] bg-no-repeat bg-blend-screen bg-left-bottom	"
        style="background-image: url('img/about-bg.webp');">

        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-24 lg:pt-16 lg:pb-16 lg:grid-cols-12">

            <div class="place-self-center lg:col-span-7">
                <h2 class="mb-1 md:mb-4 text-lg lg:text-xl font-medium text-theme-red">
                    {{ ___('The Final Word In Freshness') }}</h2>
                <h1 class="mb-1 md:mb-4 text-2xl lg:text-5xl font-bold text-blue">{{ ___('About App') }}</h1>
                <p class="mb-6 py-4 text-body-text">
                    {{ ___('FishApp is your ultimate destination for high-quality seafood sourced from the freshest catch. We strive to bring you the best selection of fish and seafood, ensuring every bite is a delightful experience.') }}
                    <br>
                    <br>
                    {{ ___('Explore our wide range of products, carefully curated to meet your culinary needs. Whether you’re a seafood enthusiast or just starting to discover the wonders of the ocean, FishApp has something for everyone.') }}
                </p>
                <a href="{{ route('about') }}"
                    class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-3 me-4">
                    {{ ___('Read More') }}
                </a>
            </div>


            <div class="mt-6 lg:mt-0 lg:col-span-5 lg:flex ">
                <div class="py-2">
                    <img src="{{ asset('images/img/hero.webp') }}" alt="">
                </div>

            </div>

        </div>
    </section>

    <section class="my-16 md:my-20">
        <div class="max-w-screen-xl mx-auto px-4">

            <div class="flex justify-center">
                <div class="md:w-4/5 mx-auto">
                    <div class="bg-white shadow-2xl rounded-3xl py-12 lg:px-16 px-6 text-center">
                        <div class="md:w-4/5 mx-auto">

                            <img src="{{ asset('images/img/trusted-icon.svg') }}" alt=""
                                class="mx-auto h-20">
                            <h2 class="text-2xl font-bold md:text-4xl xl:text-5xl text-blue !leading-tight">
                                {{ ___('Become a seller') }}
                            </h2>
                            <p class="text-body-text mb-10 md:mt-8 mt-3">
                                {{ ___('Join our marketplace and start selling your fresh seafood to customers worldwide. Share your passion for quality seafood with our community.') }}
                            </p>

                            @auth

                                @if (Auth::user()->seller)
                                    <a href="{{ route('seller.dashboard') }}"
                                        class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-12 py-3 ">
                                        {{ ___('Dashboard') }}
                                    </a>
                                @else
                                    <a href="{{ route('create.seller') }}"
                                        class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-12 py-3 ">
                                        {{ ___('Register Now') }}
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('register') }}"
                                    class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-12 py-3 ">
                                    {{ ___('Sign Up Now') }}
                                </a>

                            @endauth


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
