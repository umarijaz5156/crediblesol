<div>
    <h2 id="accordion-collapse-heading-system-settings">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-700 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-system-settings" aria-expanded="false"
            aria-controls="accordion-collapse-system-settings">
            <span>System Settings</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-collapse-system-settings" class="hidden"
        aria-labelledby="accordion-collapse-heading-system-settings">
        <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <form wire:submit.prevent="saveSettings">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-admin.form.label>Upload Logo</x-admin.form.label>
                        @if ($logoPrev)
                            <x-form.upload-files wire:model.live="app_logo" fileName="logo"
                                previous="{{ $logoPrev != null ? $logoPrev : null }}" perview />
                        @else
                            <x-form.upload-files wire:model.live="app_logo" fileName="logo" perview
                                allowFileTypes="['image/png', 'image/jpg', 'image/jpeg','image/webp']" />
                        @endif

                        @error('app_logo')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-admin.form.label>Upload Fav Icon</x-admin.form.label>

                        @if ($favIconPrev)
                            <x-form.upload-files wire:model.live="app_favicon" fileName="favIcon"
                                previous="{{ $favIconPrev ?? null }}" perview />
                        @else
                            <x-form.upload-files wire:model.live="app_favicon" fileName="favIcon" perview
                                allowFileTypes="['image/png', 'image/jpg', 'image/jpeg','image/webp']" />
                        @endif
                        @error('app_favicon')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                     
                    </div>
                </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <x-admin.form.label>Site Name</x-admin.form.label>
                            <x-admin.form.input wire:model="site_name" placeholder="Enter Site Title" name="title" />
                            @error('site_name')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-admin.form.label>Site Title</x-admin.form.label>
                            <x-admin.form.input wire:model="site_title" placeholder="Enter Dynamic Notice"
                                name="dynamic-notice" />
                            @error('site_title')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <x-admin.form.label>Meta Title</x-admin.form.label>
                            <x-admin.form.input wire:model="meta_title" placeholder="Enter meta title" />
                            @error('meta_title')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <x-admin.form.label>Meta Description</x-admin.form.label>
                            <x-admin.form.textarea wire:model="meta_description"
                                placeholder="Enter meta description"></x-admin.form.textarea>
                            @error('meta_description')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <x-admin.form.label>Currency</x-admin.form.label>
                            <x-admin.form.select wire:model="currency">
                                <option value="" selected>Select currency</option>
                                @foreach (App\Models\Currency::get() as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                @endforeach
                            </x-admin.form.select>
                            @error('currency')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <x-admin.form.label>Language</x-admin.form.label>
                            <x-admin.form.select wire:model="language">
                                <option value="">Select Default Language</option>
                                <option value="en">English</option>
                                <option value="fr">French</option>
                                <option value="ar">Arabic</option>
                                <option value="tur">Turkish</option>
                                <option value="sm_ch">Simplified Chinese</option>
                                <option value="thai">Thaï</option>
                                <option value="hn">Hindi</option>
                                <option value="de">German</option>
                                <option value="es">Spanish</option>
                                <option value="it">Italien</option>
                                <option value="Ind">Indonesian</option>
                                <option value="tr_ch">Traditional Chinese</option>
                                <option value="ru">Russian</option>
                                <option value="vn">Vietnamese</option>
                                <option value="kr">Korean</option>
                                <option value="ba">Bangla</option>
                                <option value="br">Portuguese</option>
                            </x-admin.form.select>
                            @error('language')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <x-admin.form.label>Time Zone</x-admin.form.label>

                            <x-admin.form.select wire:model="timezone">
                                <option value="">Select timezone</option>
                                @foreach ($zones_array as $timeZone)
                                    <option value="{{ $timeZone['zone'] }}">{{ $timeZone['label'] }}</option>
                                @endforeach
                            </x-admin.form.select>
                            @error('timezone')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                <x-admin.button type="submit">Save</x-admin.button>
            </form>
        </div>
    </div>
</div>
