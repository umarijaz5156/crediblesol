<textarea cols="" rows="2" {!! $attributes->merge([
    'class' =>
        'focus:outline-none placeholder:text-[#AFAFAF] focus:ring-0 py-3 w-full border bg-transparent rounded-xl font-light border-[#e74694] text-xs focus:border-[#e74694]',
]) !!}>{{ $slot }}</textarea>
