{{-- <div class="x-open lg:hidden cursor-pointer bg-white fixed left-0 top-[150px] pl-[20px] py-[10px] pr-[10px] rounded-tr-xl rounded-br-xl z-10" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
     <img src="{{asset('images/Menu.png')}}" alt="">
</div> --}}


<aside x-cloak x-transition:enter="transition transform duration-300"
    x-transition:enter-start="-translate-x-full opacity-30  ease-in"
    x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300"
    x-transition:leave-start="translate-x-0 opacity-100 ease-out"
    x-transition:leave-end="-translate-x-full opacity-0 ease-in"
    class="fixed lg:sticky  z-[1025] flex flex-col flex-shrink-0 w-[192px] h-screen lg:h-screen transition-all transform bg-white border-r shadow-lg lg:z-auto  top-0 lg:shadow-none dark:bg-[#111827] dark:border-gray-800 rounded-tr-2xl rounded-br-2xl overflow-auto scrollbar-hidden pb-3"
    :class="{ '-translate-x-full lg:translate-x-0 lg:w-24': !isSidebarOpen }">
    <!-- sidebar header -->
    <div class="flex items-center z-[999] justify-between flex-shrink-0 p-2"
        :class="{ 'lg:justify-center': !isSidebarOpen }">
        @php
            $logo = $settings->where('key', 'app_logo')->whereNotNull('value')->first();
        @endphp
        <span
            class="p-2 text-xl w-full flex justify-center font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
            <a href="{{ route('home') }}">
                <img src="{{ asset($logo ? 'storage/' . $logo->value : 'images/img/logo.webp') }}" alt="logo">
            </a>
        </span>
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- Sidebar links -->
    <nav class="flex-1 flex flex-col justify-center  ">
        <ul class="px-3 h-fit space-y-10  mt-[40px]">
            <li data-tg-order="0" data-tg-tour="" data-tg-title="This is your dashboard." data-tg-group="side-bar-tour"
                class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.dashboard') }}"
                    class="relative flex justify-start gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8D5FFA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.dashboard']) ? 'active-sidelink' : '' }}">
                    <i class="fa fa-home text-[#8D5FFA] text-[20px]"></i> <span :class="{ 'hidden': !isSidebarOpen }"
                        class="text-sm">Dashbaord</span>
                </a>
            </li>
            <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="My Business"
                data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.products') }}"
                    class="relative flex justify-start  gap-4 ggroup-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.products']) ? 'active-sidelink' : '' }}">
                    <i class="fa-solid fa-box text-[#8D5FFA] text-[20px]"></i>
                    <span :class="{ 'hidden': !isSidebarOpen }" class="text-sm">My Products</span>
                </a>
            </li>

            <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="My Business"
                data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.information') }}"
                    class="relative flex justify-start  gap-4 ggroup-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.information']) ? 'active-sidelink' : '' }}">
                    <i class="fa-solid fa-business-time text-[#8D5FFA] text-[20px]"></i> <span
                        :class="{ 'hidden': !isSidebarOpen }" class="text-sm">My Account</span>
                </a>
            </li>

            <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="Chats"
                data-tg-group="side-bar-tour" class="group">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.chats') }}"
                    class="relative flex justify-start gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B] dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.chats']) ? 'active-sidelink' : '' }}">
                    <i class="fas fa-comments text-[#8D5FFA] text-[20px]"></i> <!-- Chat icon -->
                    <span :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Chats</span>
                </a>
            </li>


            <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="Chats" data-tg-group="side-bar-tour" class="group">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.orders') }}" class="relative flex justify-start gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B] dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.orders']) ? 'active-sidelink' : '' }}">
                    <i class="fas fa-shopping-cart text-[#8D5FFA] text-[20px]"></i> <!-- Orders icon -->
                    <span :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Orders</span>
                </a>
            </li>
            

            <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="Chats" data-tg-group="side-bar-tour" class="group">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.payout') }}" class="relative flex justify-start gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B] dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.payout']) ? 'active-sidelink' : '' }}">
                    <i class="fas fa-hand-holding-usd text-[#8D5FFA] text-[20px]"></i> <!-- Payout icon -->
                    <span :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Payout</span>
                </a>
            </li>

            <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="Chats" data-tg-group="side-bar-tour" class="group">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('seller.earning') }}" class="relative flex justify-start gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B] dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['seller.earning']) ? 'active-sidelink' : '' }}">
                    <i class="fas fa-dollar-sign text-[#8D5FFA] text-[20px]"></i> <!-- Dollar sign icon -->
                    <span :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Earnings</span>
                </a>
            </li>
            
            


            {{-- <li data-tg-order="3" data-tg-tour="Here, you can view your business details" data-tg-title="My Business"
                data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('business-owner.details') }}"
                    class="relative flex justify-start  gap-4 ggroup-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['business-owner.details']) ? 'active-sidelink' : '' }}">
                    <i class="fa-solid fa-business-time text-[#8D5FFA] text-[20px]"></i> <span
                        :class="{ 'hidden': !isSidebarOpen }" class="text-sm">My Business</span>
                </a>
            </li>

            <li data-tg-order="3" data-tg-tour="" data-tg-title="Add Recipient" data-tg-group="side-bar-tour"
                class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('business-owner.tickets') }}"
                    class="relative flex justify-start  gap-4 ggroup-hover:before:content-[''] group-hover:before:bg-[#8655FA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['business-owner.tickets']) ? 'active-sidelink' : '' }}">
                    <i class="fa-solid fa-ticket text-[#8D5FFA] text-[20px]"></i> <span
                        :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Tickets</span>
                </a>
            </li>


            <li data-tg-order="4" data-tg-tour="Track the dates not to forget from here" data-tg-title="Track dates"
                data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('business-owner.disputes') }}"
                    class="relative flex justify-start  gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8D5FFA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['business-owner.disputes']) ? 'active-sidelink' : '' }}">
                    <i class="fa-solid fa-messages text-[#8D5FFA] text-205px]"></i> <span
                        :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Dispute Chats</span>
                </a>
            </li>
            <li data-tg-order="4" data-tg-tour="Track the dates not to forget from here" data-tg-title=""
                data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('business-owner.dynamicWidget') }}"
                    class="relative flex justify-start  gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8D5FFA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700 {{ Request::routeIs(['business-owner.dynamicWidget']) ? 'active-sidelink' : '' }}">
                    <i class="fa-solid fa-gear text-[#8D5FFA] text-[20px]"></i> <span
                        :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Widget </span>
                </a>
            </li> --}}
            {{--   <li data-tg-order="5"
                data-tg-tour="Feel free to change your password, add a classy Display Picture and what not click to explore."
                data-tg-title="This is your Profile" data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('user.orders') }}"
                    class="relative flex justify-start  gap-5 group-hover:before:content-[''] group-hover:before:bg-[#8D5FFA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700">
                   dynamicWidget<span :class="{ 'hidden': !isSidebarOpen }"
                        class="text-sm">Orders</span>
                </a>
            </li>
            <li data-tg-order="6" data-tg-tour="Update profile from here" data-tg-title="Update Profile"
                data-tg-group="side-bar-tour" class="group ">
                <a :class="{ 'justify-center': !isSidebarOpen }" href="{{ route('profile.show') }}"
                    class="relative flex justify-start  gap-4 group-hover:before:content-[''] group-hover:before:bg-[#8D5FFA] before:absolute before:w-[4px] before:h-[40px] before:rounded-[8px] before:left-[-12px] items-center p-2 text-base font-normal text-[#181E4B]  dark:text-white group dark:hover:bg-gray-700">
                    <i class="fa-solid fa-gear text-[#8D5FFA] text-[20px]"></i> <span
                        :class="{ 'hidden': !isSidebarOpen }" class="text-sm">Settings</span>
                </a>
            </li> --}}
            <!-- Sidebar Links... -->
        </ul>
    </nav>
</aside>
