<div>
    @extends('layouts.app')
    @section('title', 'Landing Page')
    @section('content')

        @livewire('site.institutional.faq')
        @livewire('site.institutional.contact')

    @endsection
</div>
