@php
    $dateFormat = 'MM/DD/YYYY';
@endphp

<div x-data="{
    value: @entangle($attributes->wire('model')).defer,
    dateFormat: 'MM/DD/YYYY',
    checkValue(str, max) {
        if (str.charAt(0) !== '0' || str == '00') {
            var num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) num = 1;
            str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num
                .toString();
        };
        return str;
    },
    formatInputDate(inputDate) {

        if (/\D\/$/.test(inputDate)) inputDate = inputDate.substr(0, inputDate.length - 3);

        var values = inputDate.split('/').map(function(v) {
            return v.replace(/\D/g, '')
        });

        {{-- if (['DD-MM-YYYY', 'MM-DD-YYYY', 'YYYY-MM-DD'].includes(this.dateFormat)) {
            var values = inputDate.split('-').map(function(v) {
                return v.replace(/\D/g, '')
            });
        } --}}

        {{-- if (['DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY/MM/DD'].includes(this.dateFormat)) {
            var values = inputDate.split('/').map(function(v) {
                return v.replace(/\D/g, '')
            });
        } --}}

        {{-- console.log(values) --}}

        {{-- for slashed --}}
        {{-- 'MM/DD/YYYY' --}}
        if (['DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY/MM/DD'].includes(this.dateFormat) && this.dateFormat == 'MM/DD/YYYY') {
            if (values[0]) values[0] = this.checkValue(values[0], 12);
            if (values[1]) values[1] = this.checkValue(values[1], 31);
            var output = values.map(function(v, i) {
                return v.length == 2 && i < 2 ? v + ' / ' : v;
            });

            output = output.join('').substr(0, 14);
            this.value = output;
        }

        {{-- 'DD/MM/YYYY' --}}
        if (['DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY/MM/DD'].includes(this.dateFormat) && this.dateFormat == 'DD/MM/YYYY') {
            if (values[0]) values[0] = this.checkValue(values[0], 31);
            if (values[1]) values[1] = this.checkValue(values[1], 12);
            var output = values.map(function(v, i) {
                return v.length == 2 && i < 2 ? v + ' / ' : v;
            });

            output = output.join('').substr(0, 14);
            this.value = output;
        }

        {{-- 'YYYY/MM/DD' --}}
        if (['DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY/MM/DD'].includes(this.dateFormat) && this.dateFormat == 'YYYY/MM/DD') {
            if (values[1]) values[1] = this.checkValue(values[1], 12);
            if (values[2]) values[2] = this.checkValue(values[2], 31);
            var output = values.map(function(v, i) {
                if (v.length == 4 && i == 0) {
                    return v + ' / ';
                } else if (v.length == 2 && i == 1) {
                    return v + ' / ';
                } else if (v.length == 2 && i == 2) {
                    return v;
                } else {
                    return v;
                }
                {{-- return v.length == 2 && i < 2 ? v + ' / ' : v; --}}
            });

            output = output.join('').substr(0, 14);
            {{-- console.log(output) --}}
            this.value = output;
        }
    },

    initPikaday() {
        new Pikaday({
            field: this.$refs.input,
            format: this.dateFormat,
        });
    }
}" x-on:change="value = $event.target.value" x-init="initPikaday()">
    <div class="relative"> {{-- mt-2 --}}
        <input {{ $attributes->whereDoesntStartWith('wire:model') }} x-ref="input"
            x-on:input="formatInputDate($event.target.value)" x-model="value" maxlength="14" type="text"
            class='focus:outline-none placeholder:text-[#AFAFAF] focus:ring-0 py-3 w-full border bg-transparent rounded-xl font-light border-[#e74694] text-xs focus:border-[#e74694] px-2'
            :placeholder="dateFormat" />
    </div>

</div>
