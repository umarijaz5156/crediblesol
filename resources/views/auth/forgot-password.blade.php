<x-web-layout>
    <x-authentication-card>

        <section>
            <div class="flex  max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-6 mx-auto ">

                <div class="w-full">
                    <div class="lg:p-6 ">

                        <div class="md:w-4/5 xl:w-3/5 mx-auto">

                            <div class="mb-4 mt-32 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <x-validation-errors class="mb-4" />

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="block">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button>
                                        {{ __('Email Password Reset Link') }}
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
