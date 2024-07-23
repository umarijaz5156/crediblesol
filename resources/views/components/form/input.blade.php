@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:outline-none placeholder:text-[#AFAFAF] focus:ring-0 py-3 w-full border bg-transparent rounded-xl font-light border-[#37C99D] text-xs focus:border-[#37C99D] px-2']) !!}>
