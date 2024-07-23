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

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="application-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name your
                application</label>
            <input wire:model="app_name" type="text" id="application-name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="example" required="">
        </div>
        <div>
            <label for="environment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                Environment</label>
            <select wire:model="app_env" id="environment"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
                <option value="local">Local</option>
                <option value="production">Production</option>
                <option value="testing">Testing</option>
            </select>
        </div>
        <div>
            <label for="dubg-mode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">App Debug
                Mode</label>
            <select wire:model="app_debug" id="dubg-mode"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
                <option value="false">False</option>
                <option value="true">True</option>
            </select>
        </div>
        <div>
            <label for="app-key" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">App Key</label>
            <input type="text" readonly wire:model.live="app_key" id="app-key"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <div class="pt-4">
                <button type="button" wire:click="getNewAppKey()"
                    class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">
                    Generate Key
                </button>
            </div>
        </div>
    </div>

    <div class="pt-4 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('change-step', {step: 1})"
            class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-600">
            Prev Step
        </button>

        <button type="button" wire:click="submitData()"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Next Step
        </button>
    </div>

</form>
