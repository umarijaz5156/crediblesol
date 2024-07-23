@props(['disabled' => false])

<input x-data="{
    code: @entangle($attributes->wire('model')).defer,
    formatSortCode(value) {
        // Remove non-digit characters
        const cleanedValue = value.replace(/\D/g, '');

        if (/^\d+$/.test(cleanedValue)) {
            // Split the cleaned value into groups of 2 and join with hyphen
            const formattedValue = cleanedValue.match(/.{1,2}/g)?.join('-') || '';

            this.code = formattedValue;
        } else {
            this.code = ''
        }

    }
}" x-model="code" x-on:input="formatSortCode($event.target.value)"
    {{ $disabled ? 'disabled' : '' }} {!! $attributes->whereDoesntStartWith('wire:model')->merge([
        'class' =>
            'focus:outline-none placeholder:text-[#AFAFAF] focus:ring-0 py-3 w-full border bg-transparent rounded-xl font-light border-[#e74694] text-xs focus:border-[#e74694] px-2',
    ]) !!}>
