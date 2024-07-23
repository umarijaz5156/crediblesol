@props(['id' => null, 'maxWidth' => null, 'modalName', 'headerTitle' => ''])

<x-modals.custom-alpine-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="relative w-full h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4">
                @isset($headerTitle)
                    <h3 class="text-xl font-semibold text-[#374C98] dark:text-white">
                        {{ $headerTitle }}
                    </h3>
                @endisset
                <button wire:click="$toggle('{{ $attributes['wire:model.live'] }}')" wire:loading.attr="disabled" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-6 max-h-[75vh] overflow-y-auto">
                @isset($title)
                    <h1 class="text-[#374C98] font-semibold text-2xl px-5 py-4">
                        {{ $title }}
                    </h1>
                @endisset

                {{ $content }}
            </div>
            <!-- Modal footer -->
            @isset($footer)
                <div class="flex justify-end items-center p-6 space-x-2 rounded-b dark:border-gray-600">
                    {{ $footer }}
                </div>
            </div>
        @endisset
    </div>
</x-modals.custom-alpine-modal>
