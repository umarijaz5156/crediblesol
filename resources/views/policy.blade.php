<x-web-layout>
    <!-- Hero Section  -->
    <div class="flex items-center bg-hero">
        <div class="container mx-auto px-4 pt-[60px] lg:pt-[150px] pb-5">
            <div class="grid md:grid-cols-2 gap-6 place-items-center lg:place-items-start">
                <div class="flex justify-start items-center w-full h-full order-1 md:order-0">
                    <div>
                        <h1 class="text-[#141414] text-[35px] md:text-[56px] md:leading-[56px] lg:text-[40px] leading-[50px] 2xl:text-[56px] 2xl:leading-[56px] font-bold mt-3">
                            {{ ___('Privacy Policy') }}</h1>
                        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal mt-[22px]">
                            {{ ___('Fishy Ventures Inc., the proud owner and operator of Fishy Reviews (the “Platform”) respects your privacy and is committed to protecting it. This Privacy Policy (“Policy”) explains our practices regarding the collection, use, and disclosure of your information when you use our Platform.') }}
                        </p>
                        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal mt-[22px]">
                            {{ ___('By accessing or using the Platform, you agree to be bound by this Policy. If you do not agree with the terms of this Policy, please refrain from using our Platform. We reserve the right to modify this Policy at any time, so please review it frequently.') }}
                        </p>
                        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal mt-[22px]">
                            {{ ___('Your privacy is important to us. This Policy explains how we collect, use, and safeguard your personal information. We encourage you to read this Policy carefully to understand our practices regarding your information.') }}
                        </p>
                    </div>
                </div>
                <div class="relative flex items-center w-full h-full order-0 md:order-1">
                    <img class="mx-auto my-auto" src="{{ asset('images/protection-key-lock-icon 1.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-16">
        <div class="container mx-auto px-4">
            <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal">
                {{ ___('At Fishy Ventures, we prioritize your privacy. We do not sell, rent, or otherwise disclose your personal information to third parties without your consent, except as disclosed in this Policy or as required to provide you with our services.') }}
            </p>
            <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal">
                {{ ___('We collect both personal and technical information to provide you with a seamless and personalized experience on our Platform. This information includes but is not limited to your name, email address, IP address, browser information, and cookies.') }}
            </p>
            <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal">
                {{ ___('Your personal information is securely stored and processed in accordance with applicable laws and regulations. We use your information to improve our services, communicate with you, and enhance your user experience.') }}
            </p>
            <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal">
                {{ ___('By using our Platform, you consent to the collection, use, and disclosure of your information as described in this Policy. If you have any questions or concerns about our privacy practices, please contact us.') }}
            </p>
        </div>
    </div>
    


</x-web-layout>
