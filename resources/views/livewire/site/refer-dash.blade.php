<div class="px-6 py-4 min-h-[calc(100vh-350px)]">
    <style type="text/css">
        .box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, .05);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
        }

        .collapse-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .collapse-content {
            display: none;
        }
    </style>

    <div class="box flex items-center gap-4 p-4">
        <div class="bg-primary rounded-full w-[5px] h-[60px] mr-1"></div>
        <h1 class="text-xl lg:text-[25px] font-semibold col-span-12">Painel do afiliado -
            {{ App\Models\Settings::get('site_name') ?? '' }} @yield('title', 'Bem-vindo')</h1>
    </div>

    <div class="grid grid-cols-12 gap-4 mt-4">
       <div class="border-[1px] col-span-12 md:col-span-4 lg:col-span-3 bg-white rounded-lg p-4">
            <p class="text-2xl lg:text-4xl font-bold mb-1">R${{ number_format($totalComissoes, 2, ',', '.') }}</p>
            <p class="text-[#000]/60 text-sm font-bold">Comissões pendentes</p>
            <p class="mt-2 text-xs">Valores referentes as vendas pagas realizadas a partir do seu link</p>
        </div>

        <div class="border-[1px] col-span-12 md:col-span-4 lg:col-span-3 bg-white rounded-lg p-4">
            <p class="text-2xl lg:text-4xl  font-bold mb-1">R${{ number_format($comissaoAtual, 2, ',', '.') }}</p>
            <p class="text-[#000]/60 text-sm font-bold">Comissões recebidas</p>
            <p class="mt-2 text-xs">Todos os valores pagos pelo administrador do site a você</p>
        </div>
        {{-- <div class="border-[1px] bg-white rounded-lg p-4">
                <p class="text-2xl font-bold">R$ 0,00</p>
                <p class="text-[#000]/60 text-sm font-bold">Total em saques</p>
            </div> --}}

        <div class="p-6 bg-white rounded-lg col-span-12 md:col-span-4">

            @if (empty($tipoChaveRevendedor) && empty($chaveRevendedor))
                <div>
                    <h2 class="text-sm mb-2">Afilie-se e receba <span
                            class="font-bold">{{ $commissioning_percentage_formated }}% de
                            comissão</span> a
                        cada venda que você fizer!</h2>
                    <button class="affiliate-btn primary-button w-full">Quero me afiliar</button>
                    <button class="md:hidden read-rules-btn mt-2 text-sm text-primary">Ler Regras de Afiliação</button>
                </div>


            @else
                {{-- Link afiliação --}}
                <div class="link-container mb-2 ">
                    <h2 class="text-sm mb-6 mt-2">Compartilhe seu link e receba <span
                            class="font-bold">{{ $commissioning_percentage_formated }}% de comissão</span> a
                        cada venda que você fizer!</h2>
                    <div class="relative">
                        <input type="text"
                            class="form-control border-1 border-gray-300 p-2 py-3 w-full rounded-lg text-sm"
                            id="linkIndicacao"
                            value="{{ route('store.referral', ['code' => auth()->user()->referral_code]) }}" readonly>
                        <button onclick="copiarLinkIndicacao()"
                            class="absolute bg-primary hover:bg-primary/70 text-white font-bold py-2 px-4 w-fit right-[5px] top-[7px] rounded-lg">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>


                    <button class="update-pix-btn mt-6 text-sm text-primary">Preciso atualizar minha chave
                        PIX</button>
                </div>
            @endif
        </div>
    </div>


    <div class="box form-container p-6 mx-2 mt-6" style="display: {{ $errors->any() ? 'block' : 'none' }}">
        <h2 class="text-md font-bold mb-4">Preencha os dados da sua chave pix para garantir seu pagamento e gerar
            seu
            link exclusivo</h2>
        <div class="grid grid-cols-12 gap-4">
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4
            ">
                <label for="tipoChaveRevendedor">Tipo de Chave PIX:</label>
                <select id="tipoChaveRevendedor" name="tipoChaveRevendedor" wire:model.defer="tipoChaveRevendedor">
                    <option value="">Selecione o tipo de chave</option>
                    <option value="CPF/CNPJ">CPF/CNPJ</option>
                    <option value="CELULAR">Celular</option>
                    <option value="EMAIL">E-mail</option>
                    <option value="ALEATORIA">Aleatória</option>
                </select>
                @error('tipoChaveRevendedor')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-container col-span-12 md:col-span-6">
                <label for="chaveRevendedor">Preencha sua
                    chave Pix:</label>
                <input type="text" id="chaveRevendedor" name="chaveRevendedor" placeholder="Sua chave PIX"
                    wire:model.defer="chaveRevendedor">
                @error('chaveRevendedor')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="btn-container col-span-12 lg:col-span-2 flex items-end">
                <button class="btn w-full primary-button" wire:click="updatePixKey">
                    <!-- Changed this line -->
                    Salvar alterações
                </button>

            </div>

        </div>
    </div>


    {{-- Comissões --}}
    @if (!$invoices->isEmpty())
        <div class="box p-8 lg:p-12 mt-6">
            <div class="w-full">
                <h2 class="text-center font-bold text-lg mb-1">Lista de comissões</h2>
                <h6 class="text-center text-xs px-4">Mantenha seus dados bancários atualizados e evite atrasos
                    nos
                    recebimentos de
                    suas comissões.</h6>
                <table class="min-w-full leading-normal mt-6">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Valor da Comissão
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Valor da Rifa
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nº de bilhetes
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nome da Rifa
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nome
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Porcentagem
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Data
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pagamento
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            @php
                                $raffle_value = $invoice->raffle ? $invoice->raffle->price_per_number : 0;
                                $number_raffle = $invoice->getNumberQty();
                                $raffle_name = $invoice->raffle ? $invoice->raffle->name : '';

                            @endphp
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        R${{ number_format($invoice->refer_amount, 2, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        R${{ number_format($raffle_value, 2, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $number_raffle }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $raffle_name }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $invoice->user->name }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $invoice->user->email }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @if (!is_null($invoice->payed_at) && !is_null($invoice->invoice_path))
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Pago{{-- Agu. Pagamento --}}</span>
                                        </span>
                                        {{-- @elseif(!is_null($invoice->payed_at) && !is_null($invoice->invoice_path) &&
                            !is_null($invoice->payed_refer))
                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                <span class="relative">Pago</span>
                            </span> --}}
                                    @else
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Usuário ainda não confirmou o
                                                pagamento</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $invoice->refer_percentage !== null ? number_format($invoice->refer_percentage * 100, 2) . '%' : '-' }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $invoice->created_at->modify('-3 hours')->format('d/m/Y H:i') }}
                                    </p>
                                </td>
                                <td>
                                    @if ($invoice->refer_payment_status != 'Paid' && $invoice->refer_payment_status != 'Canceled')
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Aguardando pagamento</span>
                                        </span>
                                    @elseif($invoice->refer_payment_status === 'Paid')
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Pago em
                                                {{ \Carbon\Carbon::parse($invoice->payed_refer)->format('d/m/Y') }}</span>
                                        </span>
                                    @elseif($invoice->refer_payment_status === 'Canceled')
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Cancelado em
                                                {{ \Carbon\Carbon::parse($invoice->payed_refer)->format('d/m/Y') }}</span>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $invoices->links() }}

            </div>
        </div>
    @else
        <div class="box my-4 p-2">
            <h4 class="text-center px-4">Nenhuma comissão gerada até o momento.</h4>
        </div>
    @endif


    <div class="collapse-container box instructions px-8 py-4 mt-6">
        <div class="collapse-header text-[16px] lg:text-[22px] font-semibold col-span-12">
            <span>Regras e Funcionamento</span>
            <button class="toggle-btn">
                <svg class="icon open-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                    height="24">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        d="M9.29 6.71a.996.996 0 0 0 0 1.41L12.59 12l-3.3 3.29a.996.996 0 1 0 1.41 1.41l4-4a.996.996 0 0 0 0-1.41l-4-4a.996.996 0 0 0-1.41 0z" />
                </svg>
                <svg class="icon close-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        d="M18.29 5.71a.996.996 0 1 0-1.41 1.41L12 10.41l-4.29-4.3a.996.996 0 1 0-1.41 1.41L10.59 12 5.3 17.29a.996.996 0 1 0 1.41 1.41L12 13.41l4.29 4.3a.996.996 0 1 0 1.41-1.41L13.41 12l5.3-5.29z" />
                </svg>
            </button>
        </div>
        <div class="collapse-content my-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-6">
                    <p class="text-wrap">
                        {{ getCommissioningRules() }}
                    </p>
                    <p class="text-xs mt-6">Assista ao vídeo abaixo e entenda como você pode faturar revendendo as
                        Rifas
                        do
                        {{ $host }}</p>
                </div>
                <div class="col-span-12 lg:col-span-6 mt-2 lg:mt-0 min-h-[180px] md:min-h-[300px] lg:min-h-[200px]">
                    <iframe class="w-full rounded-lg" height="100%"
                        src="https://www.youtube.com/embed/-L5kRSabcqI?rel=0" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>




    {{-- <div class="box instructions px-8 py-4 lg:p-12 mt-6 mx-2">
        <h2 class="text-[22px] font-semibold col-span-12 mb-4">Regras e Funcionamento</h2>
        <div class="grid grid-cols-12">
            <div class="lg:col-span-6">
                <p class="text-wrap">
                    {{ getCommissioningRules() }}
                </p>
                <p class="text-xs mt-6">Assista ao vídeo abaixo e entenda como você pode faturar revendendo as Rifas
                    do
                    {{ $host }}</p>
            </div>
            <div class="lg:col-span-6">
                <iframe class="w-full rounded-lg" height="100%"
                    src="https://www.youtube.com/embed/-L5kRSabcqI?rel=0" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

        </div>
    </div> --}}
</div>

<script>
    function copiarLinkIndicacao() {
        // Create a temporary textarea element
        var tempElement = document.createElement("textarea");
        // Get the value of the referral link input
        var copyText = document.getElementById("linkIndicacao").value;
        // Set the value of the textarea to the referral link
        tempElement.value = copyText;
        // Append the textarea to the body (needed to execute the select method)
        document.body.appendChild(tempElement);
        // Select the content of the textarea
        tempElement.select();
        // Copy the selected content to the clipboard
        document.execCommand("copy");
        // Remove the temporary textarea from the document
        document.body.removeChild(tempElement);
        // Optional: Alert the user that the text has been copied
        alert("Link copiado com sucesso " + copyText);
    }

    $(document).ready(function() {

        $(".affiliate-btn").click(function() {
            $(".form-container").fadeIn();
            $("html, body").animate({
                scrollTop: $(".form-container").offset().top
            }, 1000);
        });

        $(".update-pix-btn").click(function() {
            $(".form-container").fadeIn();
            $("html, body").animate({
                scrollTop: $(".form-container").offset().top
            }, 1000);
        });

        // Função para o container do pix sumir
        // $(".submit-pix-btn ").click(function() {
        //     $(".form-container").fadeOut();

        //     $("html, body").animate({
        //         scrollTop: 0
        //     }, 1000);
        // });
    });

    $(document).ready(function() {
        $('.collapse-header').click(function() {
            $(this).next('.collapse-content').slideToggle();
            $(this).find('.icon').toggleClass('hidden');
        });
    });

    $(document).ready(function() {
        $('.read-rules-btn').click(function() {
            $("html, body").animate({
                scrollTop: $(".collapse-container").offset().top
            }, 1000);
        })
    })
</script>
