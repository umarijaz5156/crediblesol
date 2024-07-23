@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));
    
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-[900px]',
        '5xl' => 'sm:max-w-5xl',
        'full' => 'sm:max-w-[95%]',
    ][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    id="{{ $id }}"
    class="jetstream-modal flex justify-center items-center fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    <div x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-on:click="show = false" >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="w-full h-full flex items-center justify-center">
        <div class="bg-white rounded-lg  max-h-screen min-h-[0px] {{ $maxWidth }} w-full sm:mx-auto shadow-xl transform transition-all ">
            {{ $slot }}
        </div>
    </div>
</div>
