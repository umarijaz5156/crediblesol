<form class="mx-auto bg-white p-8 border rounded-md shadow-md mt-8">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-4">
            <strong>Error!</strong>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <x-alerts.success :success="session('success')" />
    @endif

    @if (session()->has('error'))
        <x-alerts.error :error="session('error')" />
    @endif

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="database-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                Database Type</label>
            <select wire:model="db_type" id="database-type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
                <option value="">Select database type</option>
                <option value="mysql">MySql</option>
                {{-- @foreach ($connections as $connectionName => $connectionConfig)
                    <option value="{{ $connectionName }}">{{ $connectionName }}</option>
                @endforeach --}}
            </select>
        </div>
        <div>
            <label for="database-host" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DB
                Host</label>
            <input wire:model="db_host" type="text" id="database-host"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>

        <div>
            <label for="database-port" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DB
                Port</label>
            <input wire:model="db_port" type="text" id="database-port"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>

        <div>
            <label for="database-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DB
                Database</label>
            <input wire:model="db_name" type="text" id="database-name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>

        <div>
            <label for="database-username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DB
                Username</label>
            <input wire:model="db_username" type="text" id="database-username"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>

        <div>
            <label for="database-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DB
                Password</label>
            <input wire:model="db_password" type="text" id="database-password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>

        <div>
            <label for="app-key" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Test
                connection</label>

            <div class="">
                <button wire:click="testDB()" type="button"
                    class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">
                    Test Connection
                </button>
            </div>
        </div>
    </div>

    <div class="pt-4 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('change-step', {step: 2})"
            class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-600">
            Prev Step
        </button>

        @if ($connectionTested === true)
            <button type="button" wire:click="submitData()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Next Step
            </button>
        @endif
    </div>

</form>
