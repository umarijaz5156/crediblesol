@props(['disabled' => false])

<input {{ $disabled ? 'disables' : '' }} {!! $attributes->merge(['class' => 'block pl-3 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-[#AFE7CA] peer']) !!}>