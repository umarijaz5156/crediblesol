<div class="max-w-full mx-auto bg-white p-8 border rounded-md shadow-md mt-8">
    {{-- <h2 class="text-2xl font-semibold mb-4">PHP Extension Status</h2> --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-4">
            <strong>Error!</strong> There are some issues with the server requirements.
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <ul class="grid grid-cols gap-4">
        <li class="flex justify-between items-center border p-2 px-4 rounded-md ">
            <span class="text-blue-500">Bootstrap/cache directory writable? (Permission: 777)</span>
            <span class="text-blue-500">
                <span class="{{ $isBootstrapWritable ? 'text-green-500' : 'text-red-500' }}">
                    @if ($isBootstrapWritable)
                        <i class="fa-duotone fa-check"></i>
                    @else
                        <i class="fa-duotone fa-x"></i>
                    @endif
                </span>
            </span>
        </li>

        <li class="flex justify-between items-center border p-2 px-4 rounded-md ">
            <span class="text-blue-500">Storage directory writable (Permission: 777)</span>
            <span class="text-blue-500">
                <span class="{{ $isStorageWritable ? 'text-green-500' : 'text-red-500' }}">
                    @if ($isStorageWritable)
                        <i class="fa-duotone fa-check"></i>
                    @else
                        <i class="fa-duotone fa-x"></i>
                    @endif
                </span>
            </span>
        </li>

        <li class="flex justify-between items-center border p-2 px-4 rounded-md ">
            <span class="text-blue-500">PHP {{ str_replace('^', ' >= ', $requiredPhpVersion) }} </span>
            <span class="text-blue-500">
                <span class="{{ $this->comparePHPVersion() ? 'text-green-500' : 'text-red-500' }}">
                    @if ($this->comparePHPVersion())
                        <i class="fa-duotone fa-check"></i>
                    @else
                        <i class="fa-duotone fa-x"></i>
                    @endif
                </span>
                ({{ phpversion() }})
            </span>
        </li>
        @foreach ($extensionStatus as $extension => $status)
            <li class="flex justify-between items-center border p-2 px-4 rounded-md">
                <span class="text-blue-500">{{ $extension }}</span>
                <span class="{{ $status == 'Installed' ? 'text-green-500' : 'text-red-500' }}">
                    @if ($status == 'Installed')
                        <i class="fa-duotone fa-check"></i>
                    @else
                        <i class="fa-duotone fa-x"></i>
                    @endif
                </span>
            </li>
        @endforeach
    </ul>

    <div class="pt-4 flex justify-end space-x-4">
        <button type="button" wire:click="checkServerRequirements"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Next Step
        </button Step: Settingstton>
    </div>
</div>
