<div>
    <div class="container mx-auto py-5">
        <h1 class="text-2xl font-semibold text-center mb-6">Seller Details</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
                    <span class="font-bold text-gray-700">Email:</span>
                    <span class="text-gray-600">{{ $this->seller->user->email }}</span>
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


                <!-- Add other right side details here -->
            </div>
        </div>
    </div>
</div>
