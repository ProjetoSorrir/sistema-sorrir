<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus títulos Brascap - #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    @php
    $raffle = $invoice->raffle;
    $user = $invoice->user;
    // Variáveis gerais da invoice
    $invoiceId = $invoice->id;
    $createdAt = $invoice->created_at->format('d/m/Y');
    $amount = number_format($invoice->amount, 2, ',', '.');
    $quantityTickets = $invoice->getNumberQty();
    $userName = $user->name;
    $userCpf = $user->cpf;

    // Variáveis do raffle
    $totalNumbers = $raffle->quantity_personalized_tickets;
    $raffleName = $raffle->name;
    $susepProcess = $raffle->susep_process;
    $pricePerNumber = number_format($raffle->price_per_number, 2, ',', '.');
    $winnerValue = is_numeric($raffle->winner) ? number_format($raffle->winner, 2, ',', '.') : $raffle->winner;
    $drawDate = $raffle->draw_date;
    $probability = ($quantityTickets / $totalNumbers) * 100;
    $serieSize = $raffle->serie_size;

    // Números premier
    $premierNumbers = [];
    for ($i = 1; $i <= 30; $i++) { if ($raffle->{'premier_number_' . $i} !== null) {
        $premierNumbers[] = $raffle->{'premier_number_' . $i};
        }
        }

        $numbers = $invoice->numbers->pluck('number')->toArray();
        $formattedNumbers = [];
        foreach ($invoice->numbers as $number) {
        $formattedNumbers[] = formatNumberWithLeadingZeros($number->number, ($totalNumbers - 1));
        }
        sort($formattedNumbers);

        // Filtrar apenas os números premier que também estão presentes nos números da invoice
        $winnerPremierNumber = array_intersect($premierNumbers, $numbers);
        $formattedPremierNumbers = [];
        foreach ($winnerPremierNumber as $number) {
        $formattedPremierNumbers[] = formatNumberWithLeadingZeros($number, ($totalNumbers - 1));
        }
        sort($formattedPremierNumbers);
        @endphp

        <div class="container">
            <div class="header">
                <h2>Recibo da Compra #{{ $invoiceId }}</h2>
                <p>{{ $createdAt }}</p>
            </div>
            <div class="content">
                <h3>Detalhes da compra:</h3>
                <table>
                    <tr>
                        <th>Descrição</th>
                        <th>Detalhe</th>
                    </tr>
                    <tr>
                        <td>Título:</td>
                        <td>{{ $raffleName }}</td>
                    </tr>
                    <tr>
                        <td>Processo SUSEP:</td>
                        <td>{{ $susepProcess }}</td>
                    </tr>
                    <tr>
                        <td>Valor Unitário:</td>
                        <td>R$ {{ $pricePerNumber }}</td>
                    </tr>
                    <tr>
                        <td>Meus Títulos Comprados (Nº):</td>
                        <td>{{ $quantityTickets }}</td>
                    </tr>
                    <tr>
                        <td>Valor da Compra:</td>
                        <td>R$ {{ $amount }}</td>
                    </tr>
                    <tr>
                        <td>Valor do Prêmio:</td>
                        <td>
                            @if (is_numeric($winnerValue))
                            R$ {{ $winnerValue }}
                            @else
                            {{ $winnerValue }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Data do Sorteio:</td>
                        <td>{{ \Carbon\Carbon::parse($drawDate)->format('d/m/Y') }}</td>
                    <tr>
                        <td>Probabilidade de Contemplação:</td>
                        <td>{{ $probability }} %</td>
                    </tr>
                    <tr>
                        <td>Tamanho da Série:</td>
                        <td>{{ $serieSize }}</td>
                    </tr>
                    <tr>
                        <td>Nome do Titular:</td>
                        <td>{{ $userName }}</td>
                    </tr>
                    <tr>
                        <td>CPF do Titular:</td>
                        <td>{{ $userCpf }}</td>
                    </tr>
                </table>

                @if (count($winnerPremierNumber) > 0)
                <h3>Títulos da Sorte:</h3>
                <p>{{ implode(', ', $formattedPremierNumbers) }}</p>
                @endif

                <h3>Meus Títulos:</h3>
                <p>{{ implode(', ', $formattedNumbers) }}</p>
            </div>
        </div>
</body>

</html>
