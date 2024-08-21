<div>
    @extends('layouts.app')
    @section('title', 'Landing Page')
    @section('content')

        @livewire('preparing-reservation', ['id' => $id])

    @endsection
</div>
