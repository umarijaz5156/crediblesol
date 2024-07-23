<label {!! $attributes->merge([
    'class' =>
        "before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-xs text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:block before:h-1.5 before:w-2.5 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75]  peer-focus:leading-tight peer-focus:text-[#AFE7CA] peer-disabled:text-transparent",
]) !!}>{{ $slot }}</label>
