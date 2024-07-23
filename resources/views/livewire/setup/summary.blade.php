<div class="max-w-full mx-auto bg-white p-8 border rounded-md shadow-md mt-8">
    <h2 class="text-center text-lg text-gray-500 mb-4 mt-10">Confirm, If you want these settings</h2>

    <ul class="grid grid-cols gap-4">

        @foreach ($summary as $key => $value)
            <li class="flex justify-between items-center border p-2 px-4 rounded-md">
                <span class="text-blue-500">{{ $key }}</span>
                <span class="text-green-500">{{ $value }}</span>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('setup.last-step') }}" method="POST">
        @csrf
        <input type="hidden" name="summary" value="{{ json_encode($summary) }}">
        <div class="pt-4 flex justify-end space-x-4">
            <button type="button" wire:click="$dispatch('change-step', {step: 3})"
                class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-600">
                Prev Step
            </button>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Confirm
            </button>
        </div>
    </form>
</div>
