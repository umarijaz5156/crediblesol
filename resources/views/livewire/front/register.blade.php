<div>
    <section>
        <div class="flex max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-6 mx-auto ">

            <div class="w-full ">
                <div class="lg:p-6 mt-32">

                    <div class="md:w-4/5 xl:w-3/5 mx-auto">
                        <div class="text-center">
                            <h1
                                class="mb-4 text-lg font-bold md:text-3xl xl:text-4xl text-blue relative !leading-tight">
                                {{ ___('Create a new Account') }}
                            </h1>

                            {{-- <p class="text-body-text   mb-6 font-semibold">
                                It is a long established fact that a reader will be distracted by
                                the readable content of a page when looking at its layout.
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

                        <form wire:submit.prevent="register">
                            <div class="mt-6">
                                <div class="pb-6">
                                    <input class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name" wire:model.lazy="name" placeholder="{{ ___('User Name') }}" required autofocus autocomplete="name">
                                    <x-input-error for="name" />
                                </div>
                                <div class="pb-6">
                                    <input class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" type="email" wire:model.lazy="email" placeholder="{{ ___('User Email') }}" required autocomplete="email">
                                    <x-input-error for="email" />
                                </div>
                                <div class="pb-6 relative">
                                    <input class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="password" type="password" wire:model.lazy="password" placeholder="{{ ___('Password') }}" required autocomplete="new-password">
                                        <span class="absolute right-0 top-0 mr-4 mt-4">
                                            <button type="button" onclick="togglePassword('password', 'password-icon')">
                                                <i id="password-icon" class="far fa-eye-slash text-gray-400 cursor-pointer"></i>
                                            </button>
                                        </span>
                                        
                                        
                                    <x-input-error for="password" />
                                    <small class="text-xs text-gray-500 px-2">{{ ___('Password: 8+ chars, 1 uppercase, 1 lowercase, 1 number, 1 special char.') }}</small>
                                </div>
                                <div class="pb-6 relative">
                                    <input class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="password_confirmation" type="password" wire:model.lazy="password_confirmation" placeholder="{{ ___('Confirm Password') }}" required autocomplete="new-password">
                                        <span class="absolute right-0 top-0 mr-4 mt-4">
                                            <button type="button" onclick="togglePassword('password_confirmation', 'confirm-password-icon')">
                                                <i id="confirm-password-icon" class="far fa-eye-slash text-gray-400 cursor-pointer"></i>
                                            </button>
                                        </span>
                                        
                                    <x-input-error for="password_confirmation" />
                                </div>
                                <div class="pb-6">
                                    <button type="submit"
                                        class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-4 w-full">
                                        
                                        {{ ___('Register Now!') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        
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
                        
                        
                        

                        <div class="w-full mt-4 text-center"><a href="{{ route('login') }}"
                                class="underline text-sm font-semibold text-[#222222]">{{ ___('I’m already registered') }}</a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
</div>
