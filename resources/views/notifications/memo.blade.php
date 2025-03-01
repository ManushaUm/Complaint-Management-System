<x-app-layout>
    <x-slot name="slot">

        <div class="container mt-5 py-10">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Memo Form Component -->
            @include('components.employee-notification-form')

        </div>

    </x-slot>

</x-app-layout>