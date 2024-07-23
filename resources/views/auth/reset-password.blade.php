<x-web-layout>
    <x-authentication-card>

        <section>
            <div class="flex  max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-6 mx-auto ">

                <div class="w-full">
                    <div class="lg:p-6 ">

                        <div class="md:w-4/5 xl:w-3/5 mx-auto">



        <x-validation-errors class="mb-4" />

        <form method="POST" class="mt-32" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" readonly :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>

    </div>
</div>
</div>
</div>
</section>
    </x-authentication-card>
</x-web-layout>
