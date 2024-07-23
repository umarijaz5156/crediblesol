<div>

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
    {{-- start --}}



    <div class="p-20">
        @if ($currentStep == 1)
            <div class="container  mx-auto  px-20 py-5 bg-white shadow-lg rounded-md mt-0">
                <h1 class="text-3xl font-semibold text-center mb-6 " style="color: #F1691E">
                    {{ ___('Step 1: Personal Information') }}
                </h1>
                <form wire:submit.prevent="firstStepSubmit">
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="firstName"
                                class="block text-sm font-medium text-gray-600">{{ ___('First Name') }}</label>
                            <input wire:model.live="first_name" type="text" id="firstName"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="50">
                            <x-input-error for="first_name" />
                        </div>
                        <div class="ml-2 w-1/2">
                            <label for="lastName"
                                class="block text-sm font-medium text-gray-600">{{ ___('Last Name') }}</label>
                            <input wire:model.live="last_name" type="text" id="lastName"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="50">
                            <x-input-error for="last_name" />
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="username"
                                class="block text-sm font-medium text-gray-600">{{ ___('Username') }}</label>
                            <input type="text" wire:model.live="username" id="username"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="100">
                            <x-input-error for="username" />
                        </div>
                        <div class="ml-2 w-1/2">
                            <div wire:ignore>
                                <label for="phoneNumber"
                                    class="block text-sm font-medium text-gray-600">{{ ___('Phone Number') }}</label>
                                <input style="width: 200%" type="tel" wire:model="phone_number" id="phoneNumber"
                                    class="mt-1 p-3 w-full border rounded-md">
                            </div>
                            <x-input-error for="fullNumber" />

                            <p id="valid-msg" class="hidden text-sm text-green-600">Valid</p>
                            <p id="error-msg" class="hidden text-sm text-red-600">Invalid number</p>
                            <input type="hidden" id="countryCode" wire:model="countryCode">
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="country"
                                class="block text-sm font-medium text-gray-600">{{ ___('Country') }}</label>
                            <select wire:model.live="country_id" id="country"
                                class="mt-1 p-3 w-full border rounded-md">
                                <option value="">Select country</option>
                                @foreach (App\Models\Country::select('id', 'name')->get() as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="country_id" />

                        </div>
                        <div class="ml-2 w-1/2">
                            <label for="city"
                                class="block text-sm font-medium text-gray-600">{{ ___('City') }}</label>
                            <input type="text" wire:model.live="city" maxlength="100" id="city"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="city" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="address"
                            class="block text-sm font-medium text-gray-600">{{ ___('Address') }}</label>
                        <input type="text" wire:model.live="address" maxlength="255" id="address"
                            class="mt-1 p-3 w-full border rounded-md">
                        <x-input-error for="address" />
                    </div>


                    <div class="flex justify-end">
                        <button id="firstStepButton" type="button" wire:click="nextStep"
                            class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-12 py-3">
                            {{ ___('Next') }}
                        </button>
                    </div>
            </div>
        @endif

        @if ($currentStep == 2)
            <div class="container  mx-auto  px-20 py-5 bg-white shadow-lg rounded-md mt-0">
                <h1 class="text-3xl font-semibold text-center mb-6" style="color: #F1691E">
                    {{ ___('Step 2: Business Details') }}</h1>
                <form wire:submit.prevent="register">
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="country"
                                class="block text-sm font-medium text-gray-600">{{ ___('Are you an individual or a business') }}</label>
                            <select id="country" class="mt-1 p-3 w-full border rounded-md"
                                wire:model.live="individual_or_business">
                                <option value="individual">{{ ___('Individual') }}</option>
                                <option value="business">{{ ___('Business') }}</option>
                            </select>
                            <x-input-error for="individual_or_business" />
                        </div>
                        <!-- Name Input -->
                        <div class="mr-2 w-1/2">
                            @if ($individual_or_business === 'individual')
                                <label for="businessName"
                                    class="block text-sm font-medium text-gray-600">{{ ___('Individual Name') }}</label>
                            @else
                                <label for="businessName"
                                    class="block text-sm font-medium text-gray-600">{{ ___('Company Name') }}</label>
                            @endif
                            <input type="text" wire:model.live="businessName" maxlength="100" id="businessName"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="businessName" />
                        </div>
                    </div>


                    <div class="mb-4">
                        <label for="businessImage"
                            class="block text-sm font-medium text-gray-600">{{ ___('Add Business logo') }}</label>

                        <x-form.upload-files wire:model.live="businessImage" perview
                            allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                        <x-input-error for="businessImage" />
                    </div>

                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-600">{{ ___('Description') }}</label>
                        <textarea wire:model.lazy="description" id="description" rows="6" class="mt-1 p-3 w-full border rounded-md"
                            wire:keydown.enter.prevent wire:keydown.shift.enter="$set('description', $event.target.value + '\n')"
                            maxlength="2000" minlength="5">
                            </textarea>
                        <small class="text-xs text-gray-500">{{ ___('Min: 5, Max: 2000 characters') }}.</small>
                        <x-input-error for="description" />
                    </div>
                   
                    <div class="flex justify-between">
                        <button type="button" wire:click="prevStep" style="background:rgb(165, 167, 166) "
                            class="bg-gray-500 text-white rounded-full py-3 px-6 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                            {{ ___('Previous') }}
                        </button>
                        <button wire:click="register" type="submit"
                            class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-12 py-3 "
                            wire:loading.attr="disabled">
                            <span wire:loading wire:target="register">
                                <!-- Replace this with your spinner icon or HTML -->
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                            <span wire:loading.remove>
                                {{ ___('Submit') }}
                            </span>
                        </button>
                    </div>
            </div>
        @endif
    </div>



    @push('scripts')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet"
            media="screen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>


        <script>
            var telInput = $("#phoneNumber"),
                errorMsg = $("#error-msg"),
                validMsg = $("#valid-msg");

            function initializeIntlTelInput() {

                telInput.intlTelInput({

                    allowExtensions: true,
                    formatOnDisplay: true,
                    autoFormat: true,
                    autoHideDialCode: true,
                    autoPlaceholder: true,
                    defaultCountry: "auto",
                    ipinfoToken: "yolo",

                    nationalMode: false,
                    numberType: "MOBILE",
                    preferredCountries: ['sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
                    preventInvalidNumbers: true,
                    separateDialCode: true,
                    initialCountry: "auto",
                    geoIpLookup: function(callback) {
                        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                            var countryCode = (resp && resp.country) ? resp.country : "";
                            callback(countryCode);
                        });
                    },
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
                });

                var reset = function() {
                    telInput.removeClass("error");
                    errorMsg.addClass("hidden");
                    validMsg.addClass("hidden");
                };

                // on blur: validate
                telInput.blur(function() {
                    reset();
                    if ($.trim(telInput.val())) {
                        if (telInput.intlTelInput("isValidNumber")) {
                            var countryCode = telInput.intlTelInput("getSelectedCountryData").dialCode;
                            var phoneNumber = telInput.intlTelInput("getNumber");
                            $('#firstStepButton').prop('disabled', false);
                            Livewire.dispatch('phoneNumberUpdated', {
                                countryCode: countryCode,
                                phoneNumber: phoneNumber
                            });
                            validMsg.removeClass("hidden");
                        } else {
                            telInput.addClass("error");
                            errorMsg.removeClass("hidden");
                            $('#firstStepButton').prop('disabled', true);
                        }
                    }
                });

                telInput.on("keyup change", function() {
                    reset();
                });
            }

            // Initialize intlTelInput plugin when the page loads
            $(document).ready(function() {
                initializeIntlTelInput();
            });

            // Listen for Livewire's initialization event
            document.addEventListener('livewire:init', () => {
                Livewire.on('prevStepCalled', function(values) {
                    console.log('prevStepCalled event triggered');
                    // Destroy the existing intlTelInput instance
                    $("#phoneNumber").intlTelInput('destroy');
                    // Reinitialize the intlTelInput plugin
                    initializeIntlTelInput();
                });
            });
        </script>
    @endpush


</div>
