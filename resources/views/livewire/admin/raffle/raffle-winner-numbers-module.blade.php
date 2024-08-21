<div>
    @extends('layouts.admin')
    @section('title', 'Admin Home')
    @section('content')

    @livewire('admin.raffle.raffle-winner-numbers',['raffleId' => $id])    

    @endsection
</div>
