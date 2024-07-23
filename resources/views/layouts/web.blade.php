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


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css">
    <title>{!! $pageTitle ?? config('app.name') !!}</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/logo.webp') }}" />
    <link rel="icon" type="image/png" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/logo.webp') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/logo.webp') }}"
        type="image/x-icon" />


    <!-- /* Font Awsome Cdn */ -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- UIkit CSS -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>


    {{-- telinput --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet"
        media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>




    @vite(['resources/css/app.css', 'resources/css/front/style.css', 'resources/js/app.js', 'resources/js/front/script.js'])

    <!-- Styles -->
    @livewireStyles

    @stack('styles')
</head>

<body class="overflow-x-clip">

    <x-front.navbar />

    {{ $slot }}


    <x-front.footer />

</body>


@stack('modals')
{{-- jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>



<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

{{-- script front --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>

<!-- jQuery -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


<script>
    $(document).ready(function() {
        $('.zoomImg').each(function(index) {
            $(this).zoom();
        });
    });
</script>
<script>
    window.addEventListener('refresh', event => {
        setTimeout(() => {
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordionItems = document.querySelectorAll('.cursor-pointer');

        accordionItems.forEach(item => {
            const content = item.nextElementSibling;
            const icon = item.querySelector('svg');

            item.addEventListener('click', () => {

                accordionItems.forEach(otherItem => {
                    const otherContent = otherItem.nextElementSibling;
                    const otherIcon = otherItem.querySelector('svg');

                    if (otherContent !== content) {
                        otherContent.classList.add('hidden');
                        otherIcon.classList.remove('rotate-180');
                    }
                });

                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        let prevScrollPos = window.pageYOffset;

        window.onscroll = function() {
            const currentScrollPos = window.pageYOffset;

            if (prevScrollPos > currentScrollPos) {
                navbar.style.top = '0';
                navbar.classList.add('bg-theme-blue');

            } else {

                navbar.style.top = `-${navbar.offsetHeight}px`;
                navbar.classList.remove('bg-theme-blue');
            }

            prevScrollPos = currentScrollPos;
        };


    });
</script>

</html>
