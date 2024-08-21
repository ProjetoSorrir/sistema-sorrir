<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Números Premiados</title>
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
  <div class="container">
    <div class="header">
      <h2>Relatório de Títulos Premiados</h2>
      <small>Relatório gerado em: {{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</small>
    </div>
    @php
    $totalPremierNumbers = 0;
    for ($i = 1; $i <= 30; $i++) { if($raffle->{"premier_number_$i"}) {
      $totalPremierNumbers++;
      $premierNumbers[] = (object) [
      'number' => $raffle->{"premier_number_$i"},
      'award' => $raffle->{"premier_number_award_$i"}];
      }
      }
      @endphp

      <div class="content">
        <h3>Detalhes da Ação</h3>
        <p>Ação: {{ $raffle->name }}</p>
        <p>Total de Títulos: {{ $raffle->quantity_personalized_tickets }}</p>
        <p>Total de Títulos Premiados: {{ $totalPremierNumbers }}</p>
        <table>
          <thead>
            <tr>
              <th>Título Premiado</th>
              <th>Descrição do Prêmio</th>
            </tr>
          </thead>
          <tbody>
            @foreach($premierNumbers as $number)
            <tr>
              <td>{{ formatNumberWithLeadingZeros($number->number, $raffle->quantity_personalized_tickets) }}</td>
              <td>{{ $number->award }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</body>

</html>