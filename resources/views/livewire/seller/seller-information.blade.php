<div>



    <div class="container mx-auto py-5">
        <div class="">
        <h1 class="text-3xl font-semibold text-center mb-6">Seller Details</h1>
        <hr class="border-gray-300  mt-1">
        </div>
        <div class="grid grid-cols-1  lg:grid-cols-2 gap-6">
            <!-- Left Side -->
            <div class="bg-white rounded-md shadow-md p-6">
                <div class="mb-4">
                    <span class="font-bold text-gray-700">First Name:</span>
                    <span class="text-gray-600">{{ $this->seller->first_name }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Last Name:</span>
                    <span class="text-gray-600">{{ $this->seller->last_name }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Username:</span>
                    <span class="text-gray-600">{{ $this->seller->username }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Phone Number:</span>
                    <span class="text-gray-600">{{ $this->seller->phone_number }}</span>
                </div>
            </div>

            <!-- Right Side -->
            <div class="bg-white rounded-md shadow-md p-6">
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Individual or Business:</span>
                    <span class="text-gray-600">{{ $this->seller->individual_or_business }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Business Name:</span>
                    <span class="text-gray-600">{{ $this->seller->businessName }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Country:</span>
                    <span class="text-gray-600">{{ $this->seller->country->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">City:</span>
                    <span class="text-gray-600">{{ $this->seller->city }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Address:</span>
                    <span class="text-gray-600">{{ $this->seller->address }}</span>
                </div>

            </div>
        </div>
    </div>

    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>
    <form wire:submit.prevent="register">
        <div class="container  mx-auto  px-20 py-5 bg-white shadow-lg rounded-md mt-0">
            <h1 class="text-2xl font-semibold text-center mb-6">Edit Account detials</h1>

            <div class="mb-4 mt-4">
                <label for="businessImage" class="block text-sm font-medium text-gray-600">Business
                    logo</label>
                <x-form.upload-files wire:model.live="businessImage"
                    previous="{{ $businessImage != null ? $businessImage : null }}" perview
                    allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                <x-input-error for="businessImage" />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                <textarea wire:model.lazy="description" id="description" rows="6" class="mt-1 p-3 w-full border rounded-md"
                    wire:keydown.enter.prevent wire:keydown.shift.enter="$set('description', $event.target.value + '\n')"
                    maxlength="2000" minlength="5">
                                </textarea>
                <small class="text-xs text-gray-500">Min: 5, Max: 2000 characters.</small>
                <x-input-error for="description" />
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                    Submit
                </button>
            </div>
        </div>
    </form>

</div>
