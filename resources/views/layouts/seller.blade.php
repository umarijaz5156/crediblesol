<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $settings = App\Models\Setting::get();
        $siteTitle = $settings->where('key', 'site_title')->whereNotNull('value')->first()?->value;
        $favicon = $settings->where('key', 'app_favicon')->whereNotNull('value')->first()?->value;
    @endphp

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Seller-Dashboard</title> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! $siteTitle ?? config('app.name') !!}</title>
    <link rel="shortcut icon" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/LOGO.png') }}"
        type="image/x-icon" />
    <!-- CSS -->

    <!-- font Style -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" --}}
    {{-- type="text/css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script> --}}
    <!-- Slick Slider -->
    @vite(['resources/css/app.css', 'resources/css/owner-custom.css', 'resources/js/app.js', 'resources/css/slick.css'])

    @livewireStyles
</head>

<body class="font-Poppins xl:min-h-screen" x-data="{ 'showSignupModal': false, 'showLoginModal': false }">

    @include('user.includes.edit-profile')
    <div class="flex  dark:bg-[#111827]" x-data="setup()">
        <div class="h-full w-full flex flex-row ">
            @include('user.includes.sidebar')
            <div
                class=" w-full overflow-x-hidden content-swipe  animated faster transition-all duration-500 ease-out xl:max-h-screen">

                @include('user.includes.navbar')


                <div class="my-5 px-5 sm:px-0">
                    @if (session('success'))
                        <x-alerts.success :success="session('success')" />
                    @endif

                    @if (session('error'))
                        <x-alerts.error :error="session('error')" />
                    @endif

                    {{ $slot }}

                </div>
            </div>
        </div>
        @stack('modals')

        <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        {{-- <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script> --}}
        <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/chartjs.min.js') }}"></script>

        <!-- Fancybox CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

        <!-- Fancybox JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



        <!-- Styles -->
        @livewireScriptConfig
        @stack('scripts')

        <script>
            $(document).ready(function() {
                $('[data-fancybox]').fancybox({
                    // Options will go here
                    buttons: [
                        'close'
                    ],
                    wheel: false,
                    transitionEffect: "slide",
                    loop: true,
                    toolbar: false,
                    clickContent: false
                });
            });
        </script>
</body>

</html>
