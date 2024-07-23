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
                <h6>Users</h6>
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
                                        Name
                                </th>
                                <th
                                    class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <button wire:click="sortBy('name')" type="button" class="flex">
                                        Email
                                        <x-sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </button>
                                </th>
                                <th
                                class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <button wire:click="sortBy('name')" type="button" class="flex">
                                    Admin
                                    <x-sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </button>
                            </th>
                            <th
                            class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <button wire:click="sortBy('name')" type="button" class="flex">
                                Seller
                                <x-sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" />
                            </button>
                        </th>
                                <th
                                    class="px-2 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($users as $user)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ $user->name }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ $user->email }}

                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            @if ($user->is_admin)
                                            <span class="text-green-500">✅</span>
                                        @else
                                            <span class="text-red-500">❌</span>
                                        @endif
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            @if ($user->is_seller)
                                            <span class="text-green-500">✅</span>
                                        @else
                                            <span class="text-red-500">❌</span>
                                        @endif
                                        </p>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>
                                        {{-- @if (!$user->is_admin)
                                        <button type="button"
                                        wire:click="confirmChangeStatus('{{ $user->id }}', '{{ $user->is_seller }}')"
                                        class="text-white bg-gradient-to-r {{ $user->is_seller ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $user->is_seller ? 'Remove from Seller' : 'Make Seller' }}</button>

                                        @endif --}}
                                        <a  href="{{ route('admin.user.view',$user->id) }}"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            View
                                        </a>
                                        
                                        <button type="button" wire:click="editUser({{ $user->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Edit</button>
                                        <button type="button" wire:click="deleteUser({{ $user->id }})"
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-modals.delete-alert message="You are going to delete User (Note: all data related user also will be deleted)" />
   
    @if ($addUserModal)
        <x-modals.modal wire:model.live="addUserModal" maxWidth="2xl">
            @slot('headerTitle')
               @if ($userEditId)
               {{ 'Edit User' }}
               @else
               {{ 'Add new User' }}
               @endif 
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="createUpdateUser">

                    <div class=" mb-4">
                        <div class="">
                            <x-admin.form.label for="weightName">Name</x-admin.form.label>
                            <x-admin.form.input wire:model.live="name" maxlength="50" type="text" id="weightName" placeholder="Enter Name" />
                            <x-input-error for="name" />
                        </div>
                    </div>

                    <div class=" mb-4">
                        <div class="">
                            <x-admin.form.label for="email">Email</x-admin.form.label>
                            <x-admin.form.input wire:model.live="email" maxlength="30" type="text" id="email" placeholder="Enter Email" />
                            <x-input-error for="email" />
                        </div>
                    </div>

                    <div class=" mb-4">
                        <div class="">
                            <x-admin.form.label for="password">Password</x-admin.form.label>
                            <x-admin.form.input wire:model.live="password" maxlength="30" type="password" id="password" placeholder="Enter Password" />
                            <small>if you don't need to change the password so remain it empty</small>

                            <x-input-error for="password" />
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>

                </form>
            @endslot
        </x-modals.modal>
    @endif

    {{-- <x-modals.change-status-modal
    message="You are going to {{ $statusChangeInfo['is_seller'] ? 'Make' : 'Remove from' }} Seller" /> --}}

</div>
