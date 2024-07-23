@props(['products'])

<section>
    <div class="max-w-screen-xl mx-auto px-4">
        @if (count($products) > 0)

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 mb-14">
                @foreach ($products as $product)
                    <div class="border rounded-lg bg-[#f6f6f6]">
                        <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}">
                            @if ($product->attachments->count() > 0)
                                <img src="{{ asset('storage/' . $product->attachments->first()->file_path) }}"
                                    alt="" class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]" style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                            @else
                                <img src="{{ asset('images/img/slide1.webp') }}" alt=""
                                    class="aspect-w-4 aspect-h-3 object-cover rounded-t-lg min-h-[250px] max-h-[250px]" style="min-width: 100%;border-bottom: 1px solid #E5E7EB;">
                            @endif
                        </a>
                        <div class="px-5 py-6">
                            <div class="text-center">
                                <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                    class="text-md font-bold text-theme-red">{{ ___(Str::limit($product->title, 25, '...'))}}</a>
                                <p>{{ getCurrency() }}{{ $product->price . '/' . $product->priceMetric->abbreviation }}</p>
                            </div>
                            <div class="my-5 text-center">
                                <a href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                    class="text-white text-center bg-theme-red border border-theme-red focus:outline-none font-medium rounded-3xl text-sm px-4 sm:px-10 py-2">
                                    {{ ___('Add to Cart') }}
                                </a>
                            </div>
                            <div class="flex items-center justify-center">
                                {!! $product->generateStarRating() !!}

                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        @else
                <div class="p-5  text-center">
                    <div class="">
                        <p>{{ ___('Record not Found') }}</p>
                    </div>
                </div>
            @endif
        @if ($products instanceof \Illuminate\Pagination\AbstractPaginator && $products->hasPages())
                <div class="mt-6 mb-6 grid lg:grid-cols-12">
                <div class="lg:col-span-12 xl:col-span-12">
                {{ $products->links('vendor.livewire.front-custom-pagination') }}
            </div>
        </div>
        @endif
    </div>
</section>
