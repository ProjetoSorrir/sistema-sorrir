<div class="card card-margins">
    <h2 class="card__title">Ações</h2>
    <div class="flex flex-col md:flex-row justify-between md:mr-16">
        <p class="page-instructions">Uma lista de todas as ações, incluindo detalhes como nome,
            descrição, quantidade de títulos e dias para o sorteio.</p>
        <a href="{{ route('my_raffles.create') }}" class="primary-button flex justify-center items-center py-3 px-4">
            Criar Ação
        </a>
    </div>

    <div class="max-w-4xl mt-4">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative" role="alert"
                id="successMessage">
                {{ session()->get('success') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('successMessage').remove();
                }, 5000); // 5000 milissegundos = 5 segundos
            </script>
        @endif
    </div>


    <div class="grid grid-cols-12 gap-6 lg:w-3/4 mt-4 mb-2">
        <div class="flex flex-col col-span-12 md:col-span-5 w-[240px] min-[375px]:w-[300px] md:w-full">
            <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Pesquisar Ações por Nome</label>
            <div class="flex items-center border border-primary rounded px-2">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar" required=""
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
    </div>

    <div class="mt-4 flow-root">
        <div class="mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="custom-table">
                    <thead class="">
                        <tr>
                            <th scope="col">
                                Nome
                            </th>
                            <th scope="col">
                                Imagem Principal
                            </th>
                            <th scope="col">
                                Total de Títulos
                            </th>
                            <th scope="col">
                                Títulos Reservados
                            </th>
                            <th scope="col">
                                Títulos Pagos
                            </th>
                            <th scope="col">
                                Títulos Restantes
                            </th>
                            <th scope="col">
                                Total de dias para o Sorteio
                            </th>
                            <th scope="col">
                                Situação
                            </th>
                            <th scope="col">
                                Opções
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($raffles as $raffle)
                            <tr>
                                <td>
                                    <a class="text-blue-600 hover:text-blue-900" target="_blank"
                                        href="/action/{{ $raffle->id }}"
                                        style="cursor: pointer;">{{ $raffle->name }}</a>
                                </td>
                                <td class="flex justify-center">
                                    @if ($raffle->main_photo)
                                        <img src="{{ asset($raffle->main_photo) }}" alt="Foto Principal"
                                            class="h-20 w-40 object-cover">
                                    @else
                                        Sem foto
                                    @endif
                                </td>
                                <td>
                                    @if ($raffle->quantity_personalized_tickets > $raffle->total_numbers)
                                        {{ $raffle->quantity_personalized_tickets }}
                                    @else
                                        {{ $raffle->total_numbers }}
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $raffleId = $raffle->id;
                                        $reservedNumbers = App\Models\Number::where('raffle_id', $raffleId)
                                            ->whereNotNull('reserved_at')
                                            ->where(function ($query) {
                                                $query->doesntHave('invoice')->orWhereHas('invoice', function ($query) {
                                                    $query->whereNull('invoice_path');
                                                });
                                            })
                                            ->count();
                                    @endphp
                                    {{ $reservedNumbers }}
                                </td>
                                <td>
                                    @php
                                        $raffleId = $raffle->id;
                                        $paidNumbers = App\Models\Number::where('raffle_id', $raffleId)
                                            ->whereHas('invoice', function ($query) {
                                                $query->whereNotNull('invoice_path');
                                            })
                                            ->count();
                                    @endphp
                                    {{ $paidNumbers }}
                                </td>
                                <td>
                                    @php
                                        if ($raffle->quantity_personalized_tickets > $raffle->total_numbers) {
                                            $remainingNumbers =
                                                $raffle->quantity_personalized_tickets -
                                                ($paidNumbers + $reservedNumbers);
                                        } else {
                                            $remainingNumbers =
                                                $raffle->total_numbers - ($paidNumbers + $reservedNumbers);
                                        }
                                    @endphp
                                    {{ $remainingNumbers }}
                                </td>
                                <td>
                                    @php
                                        $now = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
                                        $drawDate = \Carbon\Carbon::parse($raffle->draw_date);
                                        $drawHour = \Carbon\Carbon::parse($raffle->draw_hour);

                                        // Calcula a diferença em horas até o sorteio, levando em conta tanto a data quanto a hora do sorteio
                                        $hoursToDraw = $now->diffInHours($drawDate->copy()->setTimeFrom($drawHour)); // false para obter valores negativos se já passou
                                    @endphp
                                    @if ($now->format('Y-m-d') == $drawDate->format('Y-m-d'))
                                        <p
                                            class="text-red-700 bg-red-50 border border-red-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Hoje é o dia do sorteio @if ($drawHour)
                                                às {{ $drawHour->format('H:i') }}
                                            @endif
                                        </p>
                                    @elseif ($drawDate->isTomorrow())
                                        <p
                                            class="text-yellow-700 bg-light-yellow border border-yellow-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Amanhã é o dia do sorteio @if ($drawHour)
                                                às {{ $drawHour->format('H:i') }}
                                            @endif
                                        </p>
                                    @elseif ($drawDate->isPast())
                                        <p
                                            class="text-gray-700 bg-gray-100 border border-gray-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Sorteio Realizado
                                        </p>
                                    @else
                                        <p
                                            class="text-cyan-700 bg-cyan-50 border border-cyan-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Faltam {{ $now->diffInDays($drawDate, false) + 1 }} dias para o sorteio
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex justify-center align-center h-full">
                                        @if (
                                            $raffle->status === 'ativa' &&
                                                (is_null($raffle->publication_date) ||
                                                    $raffle->publication_date > \Carbon\Carbon::now()->subHours(3)->format('Y-m-d') ||
                                                    ($raffle->publication_date === \Carbon\Carbon::now()->subHours(3)->format('Y-m-d') &&
                                                        (is_null($raffle->publication_hour) ||
                                                            $raffle->publication_hour > \Carbon\Carbon::now()->subHours(3)->format('H:i')))))
                                            <div
                                                class="text-yellow-700 bg-light-yellow border border-yellow-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Aguardando Publicação
                                            </div>
                                        @elseif ($raffle->status === 'ativa')
                                            <div
                                                class="text-green-700 bg-light-green border border-green-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Publicada
                                            </div>
                                        @else
                                            <div
                                                class="text-red-700 bg-red-100 border border-red-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Inativada
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                {{-- <td>
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('edit-raffles', [$raffle->id]) }}" aria-label="Editar"> <svg
                                                width="24" height="24" viewBox="0 0 24 24"
                                                class="fill-dark-grey hover:fill-black"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_957_2643" style="mask-type:alpha"
                                                    maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                                    height="24">
                                                    <rect width="24" height="24" />
                                                </mask>
                                                <g mask="url(#mask0_957_2643)">
                                                    <path
                                                        d="M5 19H6.425L16.2 9.225L14.775 7.8L5 17.575V19ZM3 21V16.75L16.2 3.575C16.4 3.39167 16.6208 3.25 16.8625 3.15C17.1042 3.05 17.3583 3 17.625 3C17.8917 3 18.15 3.05 18.4 3.15C18.65 3.25 18.8667 3.4 19.05 3.6L20.425 5C20.625 5.18333 20.7708 5.4 20.8625 5.65C20.9542 5.9 21 6.15 21 6.4C21 6.66667 20.9542 6.92083 20.8625 7.1625C20.7708 7.40417 20.625 7.625 20.425 7.825L7.25 21H3ZM15.475 8.525L14.775 7.8L16.2 9.225L15.475 8.525Z" />
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $raffles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
