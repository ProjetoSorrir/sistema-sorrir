@php
    $siteName = getSiteName();
    if (empty($siteName)) {
        $siteName = 'WePrêmios';
    }
    $logoPath = getLogo();
@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
</head>

<body>
    <div>
        @if ($logoPath)
            <img src="{{ asset($logoPath) }}"style="max-width: 100px; max-height: 100px;">
        @else
            <svg class="w-16 h-16 text-[#8224E3] -mt-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 24 24" style="width: 100px; height: 100px;">
                <path
                    d="M4 5a2 2 0 0 0-2 2v2.5c0 .6.4 1 1 1a1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
            </svg>
        @endif
    </div>
    <div>
        <p>Olá,</p>
        <p>Você está recebendo este e-mail porque uma solicitação de redefinição de senha foi feita para sua conta.</p>
        <p>Se você não solicitou uma redefinição de senha, ignore este e-mail. Nenhuma ação adicional é necessária.</p>
        <p>Para redefinir sua senha, clique no botão abaixo:</p>
        <a href="{{ route('reset.password', $token) }}">Redefinir Senha</a>
        <p>Atenciosamente,</p>
        <p>{{ $siteName }}</p>
    </div>
</body>

</html>
