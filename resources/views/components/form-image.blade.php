@props(['fileName' => 'image', 'multiple' => false, 'previousImage' => ''])

@php
$id = $id ?? md5($attributes->wire('model'));
$allowFileTypes = $allowFileTypes ?? '[]';

$previousImage =  json_decode($previousImage);
    @endphp

<div
    wire:ignore
    x-data="{ pond: null }"
    x-init="
        FilePond.setOptions({
            credits: false,
        });
        
        pond = FilePond.create($refs.input, {
            allowMultiple: {{ $multiple ? 'true' : 'false' }},
            acceptedFileTypes: ['image/*'],
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                }
            },
        @if(isset($attributes['previous']))
            files: [{
                source: '{{ asset('/storage/' . $attributes['previous']) }}',
            }]
        @endif

            @if(is_array($previousImage) && count($previousImage) > 0)

            files: [
                @foreach($previousImage as $file)
                {
                    source: '{{ asset('/storage/' . $file->file_path) }}',
                },
                @endforeach
            ],
            @endif
        });
    "
>
    <input type="file" x-ref="input" name="{{ $fileName }}{{ $multiple ? '[]' : '' }}">
    
</div>
