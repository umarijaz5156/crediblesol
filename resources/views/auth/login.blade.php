<x-web-layout>
    <x-authentication-card>
      

        <section>
            <div class="flex  max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-6 mx-auto ">
    
                <div class="w-full">
                    <div class="lg:p-6 ">
    
                            <div class="md:w-4/5 xl:w-3/5 mx-auto">
                                <div class="text-center">
                                    <h1
                                        class="mb-4 text-lg font-bold md:text-3xl xl:text-4xl text-blue relative !leading-tight">
                                        
                                        {{ ___('Sign in to your account') }}
                                    </h1>
    
                                    {{-- <p class="text-body-text   mb-6 font-semibold">
                                        It is a long established fact that a reader will be distracted.
                                    </p> --}}
                                </div>
                                {{-- <div class="flex gap-2 md:gap-3 justify-between">
    
                                    <div class="w-1/3">
                                        <a href="#"
                                            class="flex mb-4 items-center lg:gap-3 gap-1 px-3 w-100 justify-center py-4 border rounded-full ">
                                            <img src="{{ asset('images/img/google-icon.png') }}" alt="">
                                            <span class="text-sm text-black font-semibold">Google</span>
                                        </a>
                                    </div>
                                    <div class="w-1/3">
                                        <a href="#"
                                            class="flex mb-4 items-center lg:gap-3 gap-1 px-3 w-100 justify-center py-4 border rounded-full ">
                                            <img src="{{ asset('images/img/facebook-icon.png') }}" alt="">
                                            <span class="text-sm text-black font-semibold">Facebook</span>
                                        </a>
                                    </div>
                                    <div class="w-1/3">
                                        <a href="#"
                                            class="flex mb-4 items-center lg:gap-3 gap-1 px-3 w-100 justify-center py-4 border rounded-full ">
                                            <img src="{{ asset('images/img/apple-icon.png') }}" alt="">
                                            <span class="text-sm text-black font-semibold">Apple</span>
                                        </a>
                                    </div>
                                </div> --}}
    
                                <div class="px-3 text-center mt-6">
                                    <p class="bg-slate-300 h-[1px] w-full -mb-5"></p>
                                    <h1 class="text-dark font-bold text-2xl inline-block bg-white px-2"></h1>
                                </div>
    
                                <div class="mt-6">
                                    <x-validation-errors class="mb-4" />
    
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
    
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="pb-6">
                                            <input
                                                class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="email" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="{{ ___('Email') }}">
                                        </div>
                                        <div class="pb-6 relative">
                                            <input class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="password" type="password" name="password" placeholder="{{ ___('Password') }}" required autocomplete="new-password">
                                                <span class="absolute right-0 top-0 mr-4 mt-4">
                                                    <button type="button" onclick="togglePassword('password', 'password-icon')">
                                                        <i id="password-icon" class="far fa-eye-slash text-gray-400 cursor-pointer"></i>
                                                    </button>
                                                </span>
                                        </div>
                                       
                                        <div class="block pb-3">
                                            <label for="remember_me" class="flex items-center">
                                                <x-checkbox id="remember_me" name="remember" />
                                                <span class="ms-2 text-sm text-gray-600">{{ ___('Remember me') }}</span>
                                            </label>
                                        </div>
    
                                        <div class="pb-6">
                                            <button type="submit"
                                                class="text-white bg-theme-red border capitalize border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-4 w-full">
                                                
                                                {{ ___('Login to your account!') }}
                                            </button>
                                        </div>
                                    </form>
    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-start">
    
                                        </div>
    
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-theme-red font-semibold text-sm block text-right underline">
                                                {{ ___('Forgot Password?') }}

                                            </a>
                                        @endif
    
                                    </div>
    
    
                                </div>
    
                                <div class="w-full mt-2 text-center"><a href="{{ route('register') }}"
                                        class="underline text-sm font-semibold text-[#222222]">
                                        {{ ___('Create a new Account') }}</a>
                                </div>
                            </div>
    
    
    
                    </div>
                </div>
            </div>
        </section>
        
        <script>
            function togglePassword(fieldId, iconId) {
                const field = document.getElementById(fieldId);
                const icon = document.getElementById(iconId);
                
                if (field.type === "password") {
                    field.type = "text";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                } else {
                    field.type = "password";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                }
            }
        </script>
    </x-authentication-card>
</x-web-layout>
