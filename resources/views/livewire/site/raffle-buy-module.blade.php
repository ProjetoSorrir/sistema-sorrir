<div>
    @extends('layouts.app')
    @section('title', 'Landing Page')
    @section('content')

    @livewire('site.raffle-buy', ['raffleId' => $raffleId])

    @endsection
</div>