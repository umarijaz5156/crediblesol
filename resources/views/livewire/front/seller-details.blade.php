<div>
    @push('styles')
        <style>
            /* Show navigation elements on small screens */
            .flex-1.sm\:hidden {
                display: block !important;
            }

            .hidden.sm\:flex-1 {
                display: block !important;
            }

            .priceRange_product::-webkit-inner-spin-button,
            .priceRange_product::-webkit-outer-spin-button {
                -webkit-appearance: none;
            }

            .range-slider {
                position: relative;
                width: 300px;
                height: 10px;
                border-radius: 15px;
                background: transparent linear-gradient(90deg, #f1691e 0%, #ee9c71 100%) 0% 0% no-repeat padding-box;
            }

            .range-slider .progress {
                position: absolute;
                left: 25%;
                right: 0%;
                height: 100%;
                border-radius: 15px;
                background: transparent linear-gradient(90deg, #ee9c71 0%, #f1691e 100%) 0% 0% no-repeat padding-box;
            }

            .range-slider input[type="range"] {
                position: absolute;
                width: 100%;
                height: 10px;
                -webkit-appearance: none;
                pointer-events: none;
                background: none;
                outline: none;
            }

            .range-slider .range-min::-webkit-slider-thumb {
                pointer-events: auto;
                -webkit-appearance: none;
                width: 20px;
                height: 20px;
                background: #fcfcfc 0% 0% no-repeat padding-box;
                border: 2px solid #f1691e;
                border-radius: 20px;
                opacity: 1;
            }

            .range-slider .range-max::-webkit-slider-thumb {
                pointer-events: auto;
                -webkit-appearance: none;
                width: 20px;
                height: 20px;
                background: #fcfcfc 0% 0% no-repeat padding-box;
                border: 2px solid #f1691e;
                border-radius: 20px;
                opacity: 1;
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
        <div class="max-w-screen-xl mx-auto px-4 mt-16 md:mt-12 mb-10">
            <p class=" text-3xl mb-2 md:mb-6 font-bold text-blue">{{ $seller->first_name . ' ' . $seller->last_name }}
            </p>
            <p class="text-body-text">{{ ___($seller->description) }}</p>
            <div class="flex justify-between items-center mt-8">
                <div class="flex items-center">
                    <p class="my-auto">{{ ___('Showing all') }} {{ count($products) }} {{ ___('results') }}</p>
                </div>
                <div class="flex items-center">
                    <div class="mr-4">
                        <select wire:change="categoryChanged($event.target.value)"
                            class="border border-gray-300 text-body-text rounded-sm block py-2.5 px-4">
                            <option value="all" {{ empty($this->category) ? 'selected' : '' }}>{{ ___('All') }}</option>
                            @foreach ($categories as $categoryOption)
                                <option value="{{ $categoryOption->id }}"
                                    {{ optional($this->category)->id == $categoryOption->id ? 'selected' : '' }}>
                                    {{ ___($categoryOption->title) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative mr-4">
                        <input type="text" wire:model.live="productNameFilter" id="Product"
                            class="peer bg-white rounded-[10px] border border-gray-300 bg-transparent px-3 py-2.5 font-normal text-black outline-none transition-all placeholder-gray-400 focus:border-primary h-[48px]"
                            placeholder="{{ ___('Search product...') }}" required="" />
                    </div>


                    <div class="relative mr-4">
                        <input type="text" name="dates"
                            class="peer bg-white rounded-[10px] border border-gray-300 bg-transparent px-3 py-2.5 font-normal text-black outline-none transition-all placeholder-gray-400 focus:border-primary h-[48px]">
                    </div>

                    <div class="">
                        <div class="flex relative justify-center items-center  w-full mt-5 rounded">
                            <div class="range-slider">
                                <div class="progress"></div>
                                <span class="range-min-wrapper">
                                    <input class="range-min" type="range" min="{{ $setMinPrice }}"
                                        max="{{ $setMaxPrice }}" wire:model="minPrice" wire:change="updatePrices">
                                </span>
                                <span class="range-max-wrapper">
                                    <input class="range-max" type="range" min="{{ $setMinPrice }}"
                                        max="{{ $setMaxPrice }}" wire:model="maxPrice" wire:change="updatePrices">
                                </span>
                            </div>
                            &nbsp;

                        </div>
                        <div class="flex relative justify-between items-center">

                            <div class="min-value numberVal">
                                {{ ___('Min Price') }}: {{ getCurrency() }} <input type="number"
                                    class="priceRange_product border-none p-0 m-0 w-10" min="0" max="5000"
                                    wire:model="minPrice" disabled>
                            </div>

                            <div class="max-value numberVal">
                                {{ ___('Max Price') }}: {{ getCurrency() }}<input type="number"
                                    class="priceRange_product border-none p-0 m-0 w-10" min="0" max="5000"
                                    wire:model="maxPrice" disabled>
                            </div>
                        </div>

                    </div>


                    </form>
                </div>
            </div>
        </div>
    </section>


    <x-front.product-section :products="$products" />



    @push('scripts')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            const dateRangeInput = $('input[name="dates"]');

            dateRangeInput.daterangepicker({
                showDropdowns: false,
                opens: "center",
                drops: "down",
                autoApply: true,
                minDate: moment(), // Set minDate to today's date
                locale: {
                    format: "DD/MM/YYYY",
                    separator: " - ",
                    applyLabel: "Apply",
                    cancelLabel: "Cancel",
                    fromLabel: "From",
                    toLabel: "To",
                    customRangeLabel: "Custom Range",
                    weekLabel: "W",
                    daysOfWeek: [
                        "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
                    ],
                    monthNames: [
                        "January", "February", "March", "April", "May", "June", "July", "August", "September",
                        "October", "November", "December"
                    ],
                    firstDay: 1
                },
                ranges: {
                    'Clear': [moment(), moment()],
                    // 'Today': [moment(), moment()],
                    // 'Tomorrow': [moment().add(1, 'day'), moment().add(1, 'day')], // Add tomorrow as a rangex`
                    'Next 7 Days': [moment(), moment().add(6, 'days')], // Set range to next 7 days
                    'Next 30 Days': [moment(), moment().add(29, 'days')], // Set range to next 30 days
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf(
                        'month')] // Set next month as a range
                }
            });

            // Listen for changes in the date range picker
            dateRangeInput.on('apply.daterangepicker', function(ev, picker) {
                @this.set('startDateFilter', picker.startDate.format('YYYY-MM-DD'));
                @this.set('endDateFilter', picker.endDate.format('YYYY-MM-DD'));
            });
        </script>
    @endpush


</div>
