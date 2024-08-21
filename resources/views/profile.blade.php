<div>
    @extends('layouts.app')
    @section('title', 'Profile')
    @section('content')

    <div class="py-12">
        <div class="grid md:grid-cols-2 gap-4">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

        </div>
    </div>

    @endsection
</div>