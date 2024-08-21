<div class="card card-margins">
    <div class="card__title">Clientes</div>
    <div class="page-instructions">
        @if (empty($all_customers))
            <p>Você ainda não tem clientes.</p>
        @else
            <p>Aqui você pode encontrar, editar ou remover os seus clientes.</p>
        @endif
    </div>
    @if (session()->has('profile-updated'))
        <div class="alert alert-success"
            style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 10px; margin-bottom: 15px;">
            {{ session('profile-updated') }}
        </div>
    @endif
        <div>
            @if ($editing)
                <form class="space-y-6" wire:submit.prevent="submit">
                    <div class="max-w-4xl">
                        <div class="grid grid-cols-12 gap-2 md:gap-4">
                            <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="name">Nome
                                    *</label>
                                <input type="text" wire:model="name" id="name" name="name"
                                    placeholder="Seu nome">
                                @error('name')
                                    <smal class="text-red-500">{{ $message }}</smal>
                                @enderror
                            </div>
                            <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700">E-mail *</label>
                                <input type="email" wire:model="email" id="email" name="email"
                                    placeholder="Seu e-mail">
                                @error('email')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="input-container col-span-3 md:col-span-2 ">
                                <label for="ddi">DDI</label>
                                <input type="text" wire:model="ddi" id="ddi" name="ddi" placeholder="+55">
                                @error('ddi')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="input-container col-span-9  md:col-span-4">
                                <label for="phone">Telefone</label>
                                <input type="text" wire:model="phone" id="phone" name="phone"
                                    placeholder="(00) 00000-0000" pattern="[0-9]*"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full">
                                @error('phone')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="password" class="block text-sm text-gray-700 font-bold">Senha</label>
                                <div class="relative shadow-sm flex items-center border border-primary rounded px-2">
                                    <input type="password" wire:model="password" id="password" name="password"
                                        placeholder="******" class="border-none w-full">
                                    <button type="button" onclick="togglePasswordVisibility()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-700">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_1130_3314" style="mask-type:alpha"
                                                maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <rect width="24" height="24" />
                                            </mask>
                                            <g mask="url(#mask0_1130_3314)">
                                                <path
                                                    d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12 flex justify-end mt-4">
                            <button type="submit" class="primary-button">
                                Atualizar
                            </button>
                        </div>
                </form>
            @endif
        </div>

        <div class="flex flex-col w-[240px] min-[375px]:w-[300px] min-[425px]:w-full md:w-1/2 mt-4 ">
            <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Pesquisar cliente</label>
            <div class="flex items-center border border-primary rounded px-2">
                <input wire:model.live.debunce.300ms="search" type="text" placeholder="Buscar" required=""
                    class="border-none w-full">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="fill-dark-grey">
                    <mask id="mask0_702_2663" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                        width="24" height="24">
                        <rect width="24" height="24" />
                    </mask>
                    <g mask="url(#mask0_702_2663)">
                        <path
                            d="M19.6 21L13.3 14.7C12.8 15.1 12.225 15.4167 11.575 15.65C10.925 15.8833 10.2333 16 9.5 16C7.68333 16 6.14583 15.3708 4.8875 14.1125C3.62917 12.8542 3 11.3167 3 9.5C3 7.68333 3.62917 6.14583 4.8875 4.8875C6.14583 3.62917 7.68333 3 9.5 3C11.3167 3 12.8542 3.62917 14.1125 4.8875C15.3708 6.14583 16 7.68333 16 9.5C16 10.2333 15.8833 10.925 15.65 11.575C15.4167 12.225 15.1 12.8 14.7 13.3L21 19.6L19.6 21ZM9.5 14C10.75 14 11.8125 13.5625 12.6875 12.6875C13.5625 11.8125 14 10.75 14 9.5C14 8.25 13.5625 7.1875 12.6875 6.3125C11.8125 5.4375 10.75 5 9.5 5C8.25 5 7.1875 5.4375 6.3125 6.3125C5.4375 7.1875 5 8.25 5 9.5C5 10.75 5.4375 11.8125 6.3125 12.6875C7.1875 13.5625 8.25 14 9.5 14Z" />
                    </g>
                </svg>
            </div>
        </div>
        <div class="overflow-x-auto mt-4">
            <div class="w-full lg:w-3/4">
                @if(count($users) > 0)
                    <table class="custom-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col">
                                    Nome
                                </th>
                                <th scope="col">
                                    E-mail
                                </th>
                                <th scope="col">
                                    Telefone
                                </th>
                                <th scope="col">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->ddi ? $user->ddi . ' ' : '' }}
                                        {{ $user->phone
                                            ? '(' . substr($user->phone, 0, 2) . ') ' . substr($user->phone, 2, 5) . '-' . substr($user->phone, 7)
                                            : 'Sem telefone registrado' }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex items-center justify-center space-x-2">
                                        <button wire:click="editCustomer({{ $user->id }})" aria-label="Editar">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                class="fill-dark-grey hover:fill-black"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_957_2643" style="mask-type:alpha"
                                                    maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                    <rect width="24" height="24" />
                                                </mask>
                                                <g mask="url(#mask0_957_2643)">
                                                    <path
                                                        d="M5 19H6.425L16.2 9.225L14.775 7.8L5 17.575V19ZM3 21V16.75L16.2 3.575C16.4 3.39167 16.6208 3.25 16.8625 3.15C17.1042 3.05 17.3583 3 17.625 3C17.8917 3 18.15 3.05 18.4 3.15C18.65 3.25 18.8667 3.4 19.05 3.6L20.425 5C20.625 5.18333 20.7708 5.4 20.8625 5.65C20.9542 5.9 21 6.15 21 6.4C21 6.66667 20.9542 6.92083 20.8625 7.1625C20.7708 7.40417 20.625 7.625 20.425 7.825L7.25 21H3ZM15.475 8.525L14.775 7.8L16.2 9.225L15.475 8.525Z" />
                                                </g>
                                            </svg>
                                        </button>
                                        <button wire:click="deleteCustomer({{ $user->id }})" aria-label="Deletar"
                                            wire:confirm="Você tem certeza de que deseja excluir este Cliente?">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                class="fill-dark-grey hover:fill-black"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_959_2649" style="mask-type:alpha"
                                                    maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                    <rect width="24" height="24" />
                                                </mask>
                                                <g mask="url(#mask0_959_2649)">
                                                    <path
                                                        d="M7 21C6.45 21 5.97917 20.8042 5.5875 20.4125C5.19583 20.0208 5 19.55 5 19V6H4V4H9V3H15V4H20V6H19V19C19 19.55 18.8042 20.0208 18.4125 20.4125C18.0208 20.8042 17.55 21 17 21H7ZM17 6H7V19H17V6ZM9 17H11V8H9V17ZM13 17H15V8H13V17Z" />
                                                </g>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Nenhum cliente encontrado</p>
                @endif
            </div>
        </div>

        <div class="py-4 px-3">
            {{ $users->links() }}
        </div>
</div>
</div>
</div>


<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
