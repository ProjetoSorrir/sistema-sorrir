<div>
    <!-- Button to open the modal -->
    <button wire:click="$set('showModal', true)"
        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150 ease-in-out">
        Add a New Site
    </button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="my-modal">
            <!-- Modal content -->
            <div
                class="relative top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-5 border w-1/3 shadow-lg rounded-md bg-white">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900">Add a New Site</h3>
                    <form wire:submit.prevent="saveTenant" class="mt-4">
                        <!-- Form fields -->
                        <div class="mb-4">
                            <label for="tenantId" class="block text-sm font-medium text-gray-700">Site ID</label>
                            <input wire:model="tenantId" type="text" id="tenantId"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('tenantId')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="domain" class="block text-sm font-medium text-gray-700">Domain</label>
                            <input wire:model="domain" type="text" id="domain"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('domain')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save Site
                            </button>
                            <button wire:click="$set('showModal', false)" type="button"
                                class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Button to open the modal -->
    <button wire:click="$set('showModalCreateUser', true)"
        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 ease-in-out float-right">
        Add New User
    </button>

    <!-- Modal -->
    @if ($showModalCreateUser)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="my-modal">
            <!-- Modal content -->
            <div
                class="relative top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-5 border w-1/3 shadow-lg rounded-md bg-white">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900">Add new User</h3>
                    <form wire:submit.prevent="createUserClient" class="mt-4">
                        <!-- Form fields -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input wire:model="name" type="text" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('name')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input wire:model="email" type="text" id="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('email')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input wire:model="password" type="text" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('password')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save User
                            </button>
                            <button wire:click="$set('showModalCreateUser', false)" type="button"
                                class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">ID</th>
                    <th scope="col" class="py-3 px-6">Domains</th>
                    <th scope="col" class="py-3 px-6">Site Database Name</th>
                    <th scope="col" class="py-3 px-6">Status</th>
                    <th scope="col" class="py-3 px-6">Filesystem v2</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    @php
                        $storagePath = storage_path('framework/cache');
                        if (!file_exists($storagePath)) {
                            mkdir($storagePath, 0777, true);
                        }
                    @endphp
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">
                            {{ $tenant->id }}
                        </td>
                        <td class="py-4 px-6">
                            @foreach ($tenant->domains as $domain)
                                <p>{{ $domain->domain }}</p>
                            @endforeach
                        </td>
                        <td class="py-4 px-6">
                            {{ $tenant->tenancy_db_name }}
                        </td>
                        <td class="py-4 px-6">
                            @if ($tenant->siteSpecs)
                                @php
                                    switch ($tenant->siteSpecs->status) {
                                        case 'created':
                                            $badgeColor = 'bg-gray-500 text-white';
                                            break;
                                        case 'creating_dns_records':
                                            $badgeColor = 'bg-blue-500 text-white';
                                            break;
                                        case 'waiting_dns_propagation':
                                            $badgeColor = 'bg-yellow-500 text-white';
                                            break;
                                        case 'creating_ssl':
                                            $badgeColor = 'bg-green-500 text-white';
                                            break;
                                        case 'active':
                                            $badgeColor = 'bg-purple-500 text-white';
                                            break;
                                        default:
                                            $badgeColor = 'bg-gray-500 text-white';
                                            break;
                                    }
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeColor }}">
                                    {{ ucfirst(str_replace('_', ' ', $tenant->siteSpecs->status)) }}
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500 text-white">
                                    No Status
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            {{ file_exists($storagePath) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Table -->
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">ID</th>
                    <th scope="col" class="py-3 px-6">Name</th>
                    <th scope="col" class="py-3 px-6">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">
                            {{ $user->id }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $user->name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $user->email }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
