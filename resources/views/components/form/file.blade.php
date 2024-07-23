@props(['disabled' => false])

<input {{ $disabled ? 'disables' : '' }} {!! $attributes->merge([
    'class' =>
        'focus:outline-none placeholder:text-[#AFAFAF] focus:ring-0 w-full lg:w-8/12 border rounded-xl font-light border-[#e74694]  text-xs focus:border-[#e74694]',
]) !!}>
