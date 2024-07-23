<div class="px-6">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div wire:ignore.self id="accordion-collapse-body-feature-business p-3" class=""
        aria-labelledby="accordion-collapse-heading-feature-business">
        <div class="px-5 py-1 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <form wire:submit.prevent="saveSelectedSellers">
                <div class="grid gap-6 mb-12 md:grid-cols-1">

                    <div wire:ignore>
                        <x-admin.form.label>Select Multiple Sellers for Feature</x-admin.form.label>
                        <select wire:model="selectedSellers" multiple
                            class="multiSelectInput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option value="">Choose...</option>
                            @foreach ($featureSellers as $company)
                                @if (in_array($company->id, $selectedSellers))
                                    <option value="{{ $company->id }}" selected>{{ $company->username }}</option>
                                @else
                                    <option value="{{ $company->id }}">{{ $company->username }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    @error('selectedSellers')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

        </div>
        <div class="px-5">
            <x-admin.button type="submit">Save</x-admin.button>
        </div>
        </form>
    </div>
</div>


@push('scripts')
    <script>
        // Initialize TomSelect
        var multiSelect = new TomSelect('.multiSelectInput', {
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                },
            },
        });
    </script>
@endpush
