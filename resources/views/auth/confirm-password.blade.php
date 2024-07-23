<x-web-layout>
    <x-authentication-card>

        <section>
            <div class="flex  max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-6 mx-auto ">

                <div class="w-full">
                    <div class="lg:p-6 ">

                        <div class="md:w-4/5 xl:w-3/5 mx-auto">


                            <div class="mb-4 mt-32 text-sm text-gray-600">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>

                            <x-validation-errors class="mb-4" />

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div>
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        required autocomplete="current-password" autofocus />
                                </div>

                                <div class="flex justify-end mt-4">
                                    <x-button class="ms-4">
                                        {{ __('Confirm') }}
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
