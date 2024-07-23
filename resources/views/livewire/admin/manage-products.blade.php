<div>
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div>
        <button wire:click="showModal"
            class="px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
            type="button">
            Create
        </button>
        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Products</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">

                <div class="p-3 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    title</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Seller Name</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Stock</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  text-slate-400 opacity-70">
                                    Price</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  text-slate-400 opacity-70">
                                    Date of Availability</th>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Approved</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($products as $product)
                                <tr>
                                    <x-admin.table.cell>
                                        <p>
                                            {{ Str::limit($product->title, 30, '...') }}

                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>

                                        <p>
                                            {{ $product->seller->first_name . ' ' . $product->seller->last_name }}
                                        </p>

                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p>
                                            {{ $product->category->title }}
                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        <p>
                                            {{ $product->stock . ' ' . $product->stockMetric->abbreviation }}
                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        <p>
                                            {{ getCurrency() }}{{ $product->price . ' /per ' . $product->priceMetric->abbreviation }}
                                        </p>
                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        <p>
                                            {{ $product->available_date }}
                                        </p>
                                    </x-admin.table.cell>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <button type="button"
                                            wire:click="confirmChangeStatus('{{ $product->id }}', '{{ $product->approved }}')"
                                            class="text-white bg-gradient-to-r {{ $product->approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $product->approved ? 'Approved' : 'Not approved' }}</button>

                                    </td>

                                    <x-admin.table.cell>

                                        <a target="_blank"
                                            href="{{ route('products.show', [Str::slug($product->title), $product->id]) }}"
                                            type="button"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View</a>

                                        {{-- <button wire:click="viewProduct({{ $product->id }})" type="button"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View</button> --}}

                                        <button type="button" wire:click="editProduct({{ $product->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Edit</button>
                                        <button type="button" wire:click="deleteProduct({{ $product->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Delete
                                        </button>
                                    </x-admin.table.cell>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-4 px-6 text-center" colspan="9">
                                        No Record Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-admin.table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>


    @if ($viewModel)
        <x-modals.modal wire:model.live="viewModel" maxWidth="5xl">
            @slot('headerTitle')
                View Product Detials
            @endslot

            @slot('content')
                <div class="p-4">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Description:</h3>
                        <p>{!! $product->description !!}</p>
                    </div>

                    <!-- Product Category -->
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Category:</h3>
                        <p>{{ $product->category->title }}</p>
                    </div>


                    <!-- Product Stock -->
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Stock:</h3>
                        <p>{{ $product->stock }} {{ $product->stockMetric->abbreviation }}</p>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Price:</h3>
                        <p>{{ getCurrency() }}{{ $product->price }} {{ $product->priceMetric->abbreviation }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Date of Availability:</h3>
                        <p>{{ $product->available_date }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-md font-semibold">Approved:</h3>
                        @if ($product->approved)
                            <span class="text-green-500">✅</span>
                        @else
                            <span class="text-red-500">❌</span>
                        @endif
                    </div>

                    <div class="mb-4 mt-3">
                        <h3 class="text-md font-semibold">Images:</h3>
                        <div class="grid grid-cols-6 gap-4">
                            @foreach ($product->attachments as $attachment)
                                <a href="{{ asset('storage/' . $attachment->file_path) }}" data-fancybox="group"
                                    data-caption="Image {{ $loop->index + 1 }}">
                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                        style=" margin-right: 10px; margin-bottom: 10px;"
                                        class="object-cover w-full h-32 rounded-[6px]" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endslot

        </x-modals.modal>
    @endif
    {{-- deletre --}}
    <x-modals.delete-alert message="You are going to delete Product" />


    {{-- create and update --}}
    @if ($createUpdateModel)

        <x-modals.modal wire:model.live="createUpdateModel" maxWidth="5xl">
            @slot('headerTitle')
                @if ($productEditId)
                    {{ 'Edit Product' }}
                @else
                    {{ 'Add New Product' }}
                @endif
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="createUpdateProduct">
                    @if (!$productEditId)
                        <div class="w-full">
                            <x-admin.form.label for="seller_id">Select Seller</x-admin.form.label>
                            <x-admin.form.select wire:model.live="seller_id" id="seller_id" class="w-full">
                                <option value="">Select Seller</option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}">
                                        {{ $seller->first_name . ' ' . $seller->last_name }}</option>
                                @endforeach
                            </x-admin.form.select>
                            <x-input-error for="seller_id" />
                        </div>
                    @endif
                    <div class="flex flex-wrap justify-between">
                        <div class="mb-3 w-1/2 pr-2">
                            <x-admin.form.label for="productName">Title</x-admin.form.label>
                            <x-admin.form.input wire:model.live="title" maxlength="80" minlength="3" type="text"
                                id="productName" placeholder="Enter Name" />
                            <x-input-error for="title" />
                        </div>
                        <div class="mb-3 w-1/2 pl-2">
                            <x-admin.form.label for="available_date">Date of Availability</x-admin.form.label>
                            <x-admin.form.input wire:model.live="available_date" type="date" id="available_date"
                                placeholder="Enter Name" />
                            <x-input-error for="available_date" />
                        </div>
                    </div>

                    <div class="  pr-2">
                        <x-admin.form.label for="category">Select Category</x-admin.form.label>
                        <x-admin.form.select wire:model.live="category_id" id="category_id" class="w-full">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </x-admin.form.select>
                        <x-input-error for="category_id" />
                    </div>

                    <div class="flex flex-wrap justify-between">
                        <div class="w-full md:w-1/2 pr-2 mb-4 md:mb-0">
                            <x-admin.form.label for="price">Price</x-admin.form.label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    {{ getCurrency() }}
                                </span>
                                <x-admin.form.input wire:model.live="price" type="number" id="price"
                                    placeholder="Enter price"
                                    class="pl-12 pr-3 py-2 border focus:outline-none w-full rounded"></x-admin.form.input>
                            </div>
                            <x-input-error for="price" />
                        </div>

                        <div class="w-full md:w-1/2 pl-2">
                            <x-admin.form.label for="price_metric">Price Unit</x-admin.form.label>
                            <x-admin.form.select wire:model="price_metric" id="price_metric" class="w-full">
                                <option value="">Select Option</option>
                                @foreach ($weightMetrics as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </x-admin.form.select>
                            <x-input-error for="price_metric" />
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-between">
                        <div class="w-full md:w-1/2 pr-2 mb-4 md:mb-0">
                            <x-admin.form.label for="stock">Stock</x-admin.form.label>
                            <x-admin.form.input wire:model.live="stock" type="number" id="stock"
                                placeholder="Enter Stock" class="w-full" />
                            <x-input-error for="stock" />
                        </div>

                        <div class="w-full md:w-1/2 pl-2">
                            <x-admin.form.label for="stock_metric">Stock Unit</x-admin.form.label>
                            <x-admin.form.select id="stock_metric" class="w-full" disabled>
                                <option value="">Select Option</option>
                                @foreach ($weightMetrics as $id => $name)
                                    <option value="{{ $id }}" @if ($price_metric == $id) selected @endif>
                                        {{ $name }}</option>
                                @endforeach
                            </x-admin.form.select>
                            <x-input-error for="stock_metric" />
                        </div>
                    </div>

                    <p class="text-sm text-gray-500 " style="margin-top:0px">
                        Convert your stock into the selected unit: {{ $stock }}
                        {{ $weightMetrics[$price_metric] ?? '' }}
                    </p>


                    <div class="mb-4">
                        <div wire:ignore>
                            <label class='relative w-full'>
                                <textarea maxlength="1000" wire:model.live="description" id="description"
                                    class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200'></textarea>
                                <span
                                    class='text-sm text-gray-400 bg-white absolute left-[10px] -top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Description</span>
                            </label>
                        </div>
                        <x-input-error for="description" />

                    </div>

                    <div class="mb-4">
                        <label for="reviewImages" class="block text-sm font-medium text-gray-600">Attach
                            Images (Max: 5)</label>

                        <x-form.upload-files multiple wire:model.live="attachments" :fileData="$previousImage ?? null" perview
                            allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                        <x-input-error for="attachments" />
                    </div>


                    <!-- Register Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>

                </form>
            @endslot
        </x-modals.modal>
    @endif

    <x-modals.change-status-modal
        message="You are going to {{ $statusChangeInfo['approved'] ? 'approve' : 'disapprove' }} Product status" />



</div>


</div>


@push('scripts')
    <script>
        let editorOptions = {
            height: '250px',
            tabSpaces: 4,
            removePlugins: 'forms,smiley,iframe,link,div,save'
        };


        window.addEventListener('initReviewEditor', event => {
            function findDescriptionId() {
                const descriptionId = document.getElementById('description');
                if (descriptionId) {
                    clearInterval(reviewIdInterval);
                    const editorC = CKEDITOR.replace('description', editorOptions);
                    editorC.on('change', function(event) {
                        @this.set('description', event.editor.getData());
                    });

                    window.addEventListener('updateCkEditorBody', event => {
                        let changedVal = @this.get('description');

                        editorC.setData(changedVal);
                    });


                    const updateEvent = new Event('updateCkEditorBody');
                    window.dispatchEvent(updateEvent);
                }

            }

            const reviewIdInterval = setInterval(findDescriptionId, 200);
        });
    </script>
@endpush
