<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
    $settings = App\Models\Setting::get();
    $siteTitle = $settings->where('key', 'site_title')->whereNotNull('value')->first()?->value;
    $favicon = $settings->where('key', 'app_favicon')->whereNotNull('value')->first()?->value;

    $currentUrlSegments = request()->segments();
    $currentUrl = implode('/', $currentUrlSegments);
    $currentUrl = end($currentUrlSegments);
    $currentUrl = ucfirst($currentUrl);

    $pageTitle = $siteTitle ?? config('app.name');
    if ($currentUrl) {
        $pageTitle .= ' - ' . $currentUrl;
    }
@endphp
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/logo.webp') }}" />
    <link rel="icon" type="image/png" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/logo.webp') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/logo.webp') }}"
        type="image/x-icon" />
        <title>{!! $pageTitle ?? config('app.name') !!}</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css" rel="stylesheet" type="text/css" />
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="{!! asset('/soft-ui/assets/css/nucleo-icons.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/soft-ui/assets/css/nucleo-svg.css') !!}" rel="stylesheet" />

    <!-- /* Font Awsome Cdn */ -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />

    {{-- video js css --}}
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />


    {{-- paytech --}}
    <link rel="stylesheet" href="https://paytech.sn/cdn/paytech.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://paytech.sn/cdn/paytech.min.js"></script>


    <!-- Popper -->
    {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- CKEditor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- Main Styling -->
    <link href="{!! asset('/soft-ui/assets/css/soft-ui-dashboard-tailwind.css?v=1.0.4') !!}" rel="stylesheet" />
    <link href="{!! asset('/soft-ui/assets/css/tooltips.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/soft-ui/assets/css/perfect-scrollbar.css') !!}" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @stack('styles')
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">

    <!-- sidenav  -->
    <x-admin.sidebar />
    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <x-admin.navbar />
        {{ $slot }}
    </main>
</body>

@stack('modals')
{{-- jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

{{-- select2 jquery plugin --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>

{{-- video js  --}}
<script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>


{{-- custom js --}}
{{-- <script src="{!! asset('js/main.js') !!}" async></script> --}}

<!-- plugin for charts  -->
<script src="{!! asset('/soft-ui/assets/js/plugins/chartjs.min.js') !!}"></script>
<!-- plugin for scrollbar  -->
<script src="{!! asset('/soft-ui/assets/js/plugins/perfect-scrollbar.min.js') !!}"></script>
<!-- github button -->
<script defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<!-- main script file  -->
<script src="{!! asset('/soft-ui/assets/js/perfect-scrollbar.js') !!}"></script>
<script src="{!! asset('/soft-ui/assets/js/nav-pills.js') !!}"></script>
<script src="{!! asset('/soft-ui/assets/js/navbar-collapse.js') !!}"></script>
<script src="{!! asset('/soft-ui/assets/js/navbar-sticky.js') !!}"></script>
<script src="{!! asset('/soft-ui/assets/js/dropdown.js') !!}"></script>
<script src="{!! asset('/soft-ui/assets/js/fixed-plugin.js') !!}"></script>
<script src="{!! asset('/soft-ui/assets/js/sidenav-burger.js') !!}"></script>

<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



{{-- <script src="{!! asset('/soft-ui/assets/js/soft-ui-dashboard-tailwind.js?v=1.0.4') !!}" async></script> --}}
<script>
    window.addEventListener('refresh', event => {
        setTimeout(() => {
            // $("#closeSubmitFormModal").click();
            location.reload();
        }, 300);
    })
</script>

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

</html>
