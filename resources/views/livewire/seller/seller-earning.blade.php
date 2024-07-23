<div class="p-5">
    <div class="p-6 pb-5 mb-0 bg-white rounded-t-2xl">
        <h2 class="text-3xl font-bold mb-2 text-center">Earnings Details</h2>
        <hr class="border-gray-300 mb-4">
    </div>
    <div class="flex justify-between gap-6">
        <!-- Earnings Box -->
        <div class="p-6 bg-white shadow-md rounded-lg flex-1">
            <h3 class="text-lg font-semibold text-gray-800">Total Earnings</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $earning }} <small>{{ getCurrency() }}</small></p>
        </div>

        <!-- Pending Payouts Box -->
        <div class="p-6 bg-white shadow-md rounded-lg flex-1">
            <h3 class="text-lg font-semibold text-gray-800">Pending Payouts</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $pendingPayout }} <small>{{ getCurrency() }}</small></p>
        </div>
    </div>
</div>
