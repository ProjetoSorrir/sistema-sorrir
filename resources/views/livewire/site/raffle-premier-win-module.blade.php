<div>
    @extends('layouts.app')
    @section('title', 'Landing Page')
    @section('content')

    @livewire('site.raffle-premier-win', ['id' => $id])

    @endsection
</div>