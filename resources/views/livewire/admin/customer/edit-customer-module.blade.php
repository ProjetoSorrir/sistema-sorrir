<div>
    @extends('layouts.admin')
    @section('title', 'Admin Home')
    @section('content')

    @livewire('admin.customer.edit-customer', ['userId' => $id])    

    @endsection
</div>