<div class="mx-8">
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div>
        <button wire:click="showModal"
            class="px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
            type="button">
            Create
        </button>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Sellers</h6>
            </div>
            <div class="flex items-center md:ml-auto md:pr-4">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        {{-- <input wire:model.live="search" type="search"
                            id="default-search"
                            class="block w-full p-4 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft relative rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-10 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Search here..." required /> --}}
                        {{-- <button type="submit" style="margin-bottom:-4px; font-size: 12px;"
                            class="text-fuchsia-500 border-fuchsia-500 absolute end-2.5 bottom-2.5 bg-transparent focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-transparent dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:text-fuchsia-500 ">
                            Search
                        </button> --}}
                    </div>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        First Name
                                </th>
                                <th
                                    class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <button wire:click="sortBy('last_name')" type="button" class="flex">
                                        Last Name
                                        <x-sort-icon field="last_name" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </button>
                                </th>
                                <th
                                class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <button wire:click="sortBy('username')" type="button" class="flex">
                                    UserName
                                    <x-sort-icon field="username" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </button>
                            </th>
                            <th
                            class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <button wire:click="sortBy('phone_number')" type="button" class="flex">
                                Number
                                <x-sort-icon field="phone_number" :sortField="$sortField" :sortAsc="$sortAsc" />
                            </button>
                        </th>
                        <th
                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        email
                </th>  
                       
                    <th
                    class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        Approved or Not
                </th>   

                                <th
                                    class="px-2 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($sellers as $seller)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ $seller->first_name }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ $seller->last_name }}

                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ $seller->username }}

                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ $seller->phone_number }}

                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ $seller->user->email }}

                                        </p>
                                    </x-admin.table.cell>
                                   
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            @if ($seller->is_approved)
                                            <span class="text-green-500">✅</span>
                                        @else
                                            <span class="text-red-500">❌</span>
                                        @endif
                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        {{-- <a  href="{{ route('admin.seller.payouts',$seller->id) }}"
                                            class="text-white bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 hover:text-white hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:gray:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Payouts
                                        </a> --}}
                                        <a  href="{{ route('admin.seller.view',$seller->id) }}"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:text-white hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                           
                                            View
                                        </a>
                                        <button type="button"
                                        wire:click="confirmChangeStatus('{{ $seller->id }}', '{{ $seller->is_approved }}')"
                                        class="text-white bg-gradient-to-r {{ $seller->is_approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $seller->is_approved ? 'Approved' : 'Pending Approval' }}</button>

                                        
                                        <button type="button" wire:click="editSeller({{ $seller->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Edit</button>
                                        <button type="button" wire:click="deleteUser({{ $seller->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Delete
                                        </button>
                                    </x-admin.table.cell>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-4 px-6 text-center" colspan="9">
                                        No Record Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-admin.table>
                    <div class="p-4 ">
                        {{ $sellers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-modals.delete-alert message="You are going to delete Seller (Note: all data related seller also will be deleted)" />
   
    @if ($addUserModal)
        <x-modals.modal wire:model.live="addUserModal" maxWidth="5xl">
            @slot('headerTitle')
               @if ($sellerEditId)
               {{ 'Edit Seller' }}
               @else
               {{ 'Add new Seller' }}
               @endif 
            @endslot

            @slot('content')
            <form wire:submit.prevent="register">
                <div class="py-4">
                    @if (!$sellerEditId)
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-600">Select User</label>
                        <select required id="user_id" class="mt-1 p-3 w-full border rounded-md"
                            wire:model.live="user_id">
                            <option  selected>Select User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @endforeach
                        </select> 
                        <x-input-error for="user_id" />
                    </div>
                    @endif 

                    
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="firstName" class="block text-sm font-medium text-gray-600">First Name</label>
                            <input wire:model.live="first_name" type="text" id="firstName"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="50"> 
                            <x-input-error for="first_name" />
                        </div>
                        <div class="ml-2 w-1/2">
                            <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name</label>
                            <input wire:model.live="last_name" type="text" id="lastName"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="50">
                            <x-input-error for="last_name" />
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                            <input type="text" wire:model.live="username" id="username"
                                class="mt-1 p-3 w-full border rounded-md" maxlength="100">
                            <x-input-error for="username" />
                        </div>
                        <div class="ml-2 w-1/2">
                            <div wire:ignore>
                                <label for="phoneNumber" class="block text-sm font-medium text-gray-600">Phone
                                    Number</label>
                                <input type="tel" wire:model="phone_number" id="phoneNumber"
                                    class="mt-1 p-3 w-full border rounded-md">
                            </div>
                            <x-input-error for="phone_number" />
                           
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="country" class="block text-sm font-medium text-gray-600">Are you an
                                individual
                                or a
                                business</label>
                            <select id="country" class="mt-1 p-3 w-full border rounded-md"
                                wire:model.live="individual_or_business">
                                <option value="individual">Individual</option>
                                <option value="business">Business</option>
                            </select>
                            <x-input-error for="individual_or_business" />
                        </div>
                        <!-- Name Input -->
                        <div class="mr-2 w-1/2">
                            @if ($individual_or_business === 'individual')
                                <label for="businessName" class="block text-sm font-medium text-gray-600">Individual
                                    Name</label>
                            @else
                                <label for="businessName" class="block text-sm font-medium text-gray-600">Company
                                    Name</label>
                            @endif
                            <input type="text" wire:model.live="businessName" maxlength="100" id="businessName"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="businessName" />
                        </div>
                    </div>
                   
    
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="country" class="block text-sm font-medium text-gray-600">Country</label>
                            <select wire:model.live="country_id" id="country" class="mt-1 p-3 w-full border rounded-md">
                                <option value="">Select country</option>
                                @foreach (App\Models\Country::select('id', 'name')->get() as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="country_id" />
    
                        </div>
                        <div class="mr-2 w-1/2">
                            <label for="city" class="block text-sm font-medium text-gray-600">City</label>
                            <input type="text" wire:model.live="city" maxlength="100" id="city"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="city" />
                        </div>
                    </div>
    
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                        <input type="text" wire:model.live="address" maxlength="255" id="address"
                            class="mt-1 p-3 w-full border rounded-md">
                        <x-input-error for="address" />
                    </div>
                    <div class="mb-4">
                        <label for="businessImage" class="block text-sm font-medium text-gray-600">Add Business
                            logo</label>
    
                        <x-form.upload-files wire:model.live="businessImage"  previous="{{ $businessImage != null ? $businessImage : null }}" perview
                            allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                        <x-input-error for="businessImage" />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea wire:model.lazy="description" id="description" rows="6" class="mt-1 p-3 w-full border rounded-md"
                            wire:keydown.enter.prevent wire:keydown.shift.enter="$set('description', $event.target.value + '\n')"
                            maxlength="2000" minlength="5">
                                    </textarea>
                        <small class="text-xs text-gray-500">Min: 5, Max: 2000 characters.</small>
                        <x-input-error for="description" />
                    </div>
                        <button wire:click="register" type="submit"
                            class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full"
                            wire:loading.attr="disabled">
                            <span wire:loading wire:target="register">
                                <!-- Replace this with your spinner icon or HTML -->
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                            <span wire:loading.remove>
                                Submit
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            @endslot
        </x-modals.modal>
    @endif

  
     <x-modals.change-status-modal
    message="You are going to {{ $statusChangeInfo['is_approved'] ? 'Approved' : 'Pending Approval' }}" />

</div>
