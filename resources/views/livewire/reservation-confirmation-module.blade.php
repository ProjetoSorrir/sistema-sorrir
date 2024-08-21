<div>
    @extends('layouts.app')
    @section('title', 'Landing Page')
    @section('content')

    @livewire('reservation-confirmation', ['id' => $id])    

    @endsection
</div>