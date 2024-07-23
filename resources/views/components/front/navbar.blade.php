<!-- Navbar -->
<header>
    <nav class="fixed text-white w-full z-50 bg-theme-blue" id="navbar">
        <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                @php
                    $settings = App\Models\Setting::get();
                    $logo = $settings->where('key', 'app_logo')->whereNotNull('value')->first();
                @endphp
                <img src="{{ asset($logo ? 'storage/' . $logo->value : 'images/img/logo.webp') }}" class="max-w-52"
                    alt="" />

            </a>

            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse items-center">
                <div class="sm:block hidden">
                    @auth
                        @if (auth()->user()->is_seller)
                            <a href="{{ url('seller/dashboard') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ ___('Seller Dashboard') }}
                            </a>
                        @elseif (auth()->user()->is_admin)
                            <a href="{{ url('admin/dashboard') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ ___('Admin Dashboard') }}

                            </a>
                        @else
                            <a href="{{ route('create.seller') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ ___('Become a seller') }}

                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class=" me-5 text-white">{{ ___('Login') }}</a>
                        <a href="{{ route('register') }}"
                            class="text-white bg-theme-red focus:outline-none font-medium rounded-full text-sm px-5 py-2 text-cente">
                            {{ ___('Sign Up Now') }}
                        </a>

                    @endauth
                </div>
                <div class="sm:block hidden px-2">

                    @auth

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ ___('Manage Account') }}
                                </div>

                                @if (auth()->user()->is_seller)
                                    <x-dropdown-link href="{{ route('seller.profile.edit') }}">
                                        {{ ___('Profile') }}
                                    </x-dropdown-link>
                                @elseif (auth()->user()->is_admin)
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ ___('Profile') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link href="{{ route('user.profile.edit') }}">
                                        {{ ___('Profile') }}
                                    </x-dropdown-link>
                                @endif
                                <x-dropdown-link href="{{ route('buyer.chats') }}">
                                    {{ ___('Chats') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('buyer.orders') }}">
                                    {{ ___('Orders') }}
                                </x-dropdown-link>


                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ ___('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endauth
                </div>

                
                <div class="relative flex justify-center items-center space-x-2 md:flex " style="width: 100px">
                    <form id="languageForm">
                        <select id="languageDropdown"
                            class="block w-full py-2 px-4 rounded-lg bg-gray-100 border border-gray-300 focus:outline-none focus:bg-white focus:border-gray-500 text-gray-700">
                            @foreach (getAllLangs() as $abbr => $lang)
                                <option class="text-black" value="{{ $abbr }}"
                                    {{ getLang() == $abbr ? 'selected' : '' }}>
                                    {{ $lang }}</option>
                            @endforeach
                        </select>

                    </form>
                </div>


                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">{{ ___('Open main menu') }}</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full p-6 md:p-2 md:flex md:w-auto md:order-1 bg-theme-blue md:bg-transparent relative z-50"
                id="navbar-default">

                <ul
                    class="font-medium flex flex-col md:p-0 mt-4  md:flex-row md:space-x-7 rtl:space-x-reverse md:mt-0  relative z-50">
                    <li>
                        <a href="/" class="block py-2 px-3 text-white"
                            aria-current="page">{{ ___('Home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('category.products') }}" class="block py-2 px-3 text-white"
                            aria-current="page">{{ ___('Products') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('buyer.orders') }}" class="block py-2 px-3 text-white"
                            aria-current="page">{{ ___('My Orders') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('sellers') }}" class="block py-2 px-3 text-white"
                            aria-current="page">{{ ___('Sellers') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('contactUs') }}" class="block py-2 px-3 text-white"
                            aria-current="page">{{ ___('Contact Us') }}</a>
                    </li>
                </ul>
                <div class="sm:hidden ps-2">
                    @auth
                        @if (auth()->user()->is_seller)
                            <a href="{{ route('seller.dashboard') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">

                                {{ ___('Seller Dashboard') }}
                            </a>
                        @elseif (auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ ___('Admin Dashboard') }}

                            </a>
                        @else
                            <a href="{{ route('create.seller') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ ___('Become a seller') }}

                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class=" me-5 text-white">{{ ___('Login') }}</a>
                        <a href="{{ route('register') }}"
                            class="text-white bg-theme-red focus:outline-none font-medium rounded-full text-sm px-5 py-2 text-cente">

                            {{ ___('Sign Up Now') }}
                        </a>

                    @endauth

                </div>
                <div class="sm:hidden ps-2 mt-2">

                    @auth

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ ___('Manage Account') }}
                                </div>

                                @if (auth()->user()->is_seller)
                                    <x-dropdown-link href="{{ route('seller.profile.edit') }}">
                                        {{ ___('Profile') }}
                                    </x-dropdown-link>
                                @elseif (auth()->user()->is_admin)
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ ___('Profile') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link href="{{ route('user.profile.edit') }}">
                                        {{ ___('Profile') }}
                                    </x-dropdown-link>
                                @endif
                                <x-dropdown-link href="{{ route('buyer.chats') }}">
                                    {{ __('Chats') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('buyer.orders') }}">
                                    {{ __('Orders') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ ___('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endauth

                </div>

            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            // Language form submission
            $('#languageDropdown').on('change', function() {
                var selectedLocale = $(this).val();
                $('#languageForm').attr('action', '{{ url('set-default-lang') }}/' + selectedLocale)
                    .submit();
            });
            // Currency form submission
            $('#currencyDropdown').on('change', function() {
                var selectedCurrency = $(this).val();
                $('#currencyForm').attr('action', '{{ url('set-user-currency') }}/' + selectedCurrency)
                    .submit();
            });
        });
    </script>
</header>
