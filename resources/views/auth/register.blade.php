<x-web-layout>
    <x-authentication-card>



        <section>
            <div class="flex max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-6 mx-auto ">

                <div class="w-full ">
                    <div class="lg:p-6 ">

                        <div class="md:w-4/5 xl:w-3/5 mx-auto">
                            <div class="text-center">
                                <h1
                                    class="mb-4 text-lg font-bold md:text-3xl xl:text-4xl text-blue relative !leading-tight">
                                    Create a New Account

                                </h1>

                                <p class="text-body-text   mb-6 font-semibold">
                                    It is a long established fact that a reader will be distracted by
                                    the readable content of a page when looking at its layout.
                                </p>
                            </div>
                            <div class="flex gap-2 md:gap-3 justify-between">

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
                            </div>

                            <div class="px-3 text-center mt-6">
                                <p class="bg-slate-300 h-[1px] w-full -mb-5"></p>
                                <h1 class="text-dark font-bold text-2xl inline-block bg-white px-2">OR</h1>
                            </div>

                            <x-validation-errors class="mb-4" />
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                            <div class="mt-6">
                                <div class="pb-6">
                                    <input
                                        class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="name" name="name" :value="old('name')" placeholder="User Name" required autofocus autocomplete="name">

                                </div>
                                <div class="pb-6">
                                    <input
                                        class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" type="email" name="email" :value="old('email')" placeholder="User Email" required autocomplete="email">
                                </div>

                                <div class="pb-6">

                                    <input
                                        class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="password" type="password" name="password" placeholder="Password" required autocomplete="new-password">
                                </div>
                                <div class="pb-6">

                                    <input
                                        class="appearance-none border rounded-full w-full py-4 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                               


                                <div class="pb-6">
                                    <button type="submit"
                                        class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-4 w-full">
                                        Register Now!
                                    </button>
                                </div>


                            </div>
                            </form>

                            <div class="w-full mt-4 text-center"><a href="{{ route('login') }}"
                                    class="underline text-sm font-semibold text-[#222222]">I’m already registered</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>


    </x-authentication-card>
</x-web-layout>
