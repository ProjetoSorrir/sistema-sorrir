<div>
    @extends('layouts.admin')
    @section('title', 'Admin Home')
    @section('content')

    @livewire('admin.raffle.edit',['raffleId' => $id])    

    @endsection
</div>
