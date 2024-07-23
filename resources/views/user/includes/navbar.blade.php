<!-- start navbar -->
<div class="w-full sticky   md:top-0 z-20 flex flex-row flex-wrap justify-between items-center py-6 px-6 bg-white"
    style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">

    <div class="flex items-center gap-3">
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring">
             <svg class="w-4 h-4 text-gray-600 dark:text-[#9ca3af]"
                  :class="{'transform transition-transform -rotate-180': isSidebarOpen}"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                       d="M13 5l7 7-7 7M5 5l7 7-7 7" />
             </svg>
        </button>
        <!-- logo -->
        <div class="flex-none w-max flex flex-row  items-center">
             <h1 class="text-[#5C5C5C] text-[16px] font-semibold">Dashboard</h1>
        </div>
        <!-- end logo -->
   </div>


    <div class="flex justify-start items-center">
        {{-- <livewire:notifications /> --}}
        <button
            class="flex justify-start items-center mx-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 w-max"
            type="button">
            <span class="sr-only">Open user menu</span>
            @if(!isset(auth()->user()->profile_photo_path))
            <img src="{{ auth()->user()->profile_photo_url}}" alt="{{ auth()->user()->name }}"
                class="rounded-full max-h-12 max-w-12 object-cover">
            @else
            <img src="{{ '/storage/'.auth()->user()->profile_photo_path}}" alt="{{ auth()->user()->name }}"
                class="rounded-full h-12 w-12 object-cover">
            @endif
            {{-- <img class="w-12 h-12 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="user photo"> --}}
            <div data-tg-order="2"  data-tg-tour="Feel free to change your password, add a classy Display Picture and what not, click to explore." data-tg-title="This is your profile"
            data-tg-group="dashboard-tour"  id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="hidden md:block">
                <div class="flex justify-start items-center ml-3">
                    <p>{{auth()->user()->name}}</p> <i class="fa fa-chevron-down ml-2"></i>
                </div>
                <div class="text-left ml-3">
                    <p class="text-[#8655FA] uppercase text-[12px]">User</p>
                </div>
            </div>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownAvatar"
            class="hidden z-10 w-44 bg-white rounded-lg divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600"
            style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
                {{-- data-modal-toggle="defaultModal" --}}
                <li class="edit-acc">
                    <a href="{{route('seller.profile.edit')}}"
                        class="py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex justify-start items-center"><i
                            class="fal fa-user mr-3 text-[#EEC4FF]"></i> Edit Profile</a>
                </li>
                @if(auth()->user()->is_admin)
                <li class="edit-acc">
                    <a href="{{route('admin.dashboard')}}"
                        class="py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex justify-start items-center"><i
                            class="fal fa-user mr-3 text-[#EEC4FF]"></i> Admin Panel</a>
                </li>
                @endif
                {{-- <li>
                    <a href="{{ route('verify.otp') }}"
                        class=" py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex justify-start items-center"><i
                            class="fas fa-badge-check mr-3 text-[#EEC4FF]"></i> Verify Account</a>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('support') }}"
                        class=" py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex justify-start items-center"><i
                            class="fa fa-question-circle text-[#EEC4FF] mr-3"></i>Support</a>
                </li> --}}
            </ul>
            <div class="py-1">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                        class=" py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white flex justify-start items-center"><i
                            class="fa fa-power-off mr-3 text-[#EEC4FF]"></i> Logout</a>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end navbar -->
