<div>
    @extends('layouts.admin')
    @section('title', 'Admin Home')
    @section('content')

    @livewire('admin.raffle.raffle-premier-numbers',['raffleId' => $id])    

    @endsection
</div>
