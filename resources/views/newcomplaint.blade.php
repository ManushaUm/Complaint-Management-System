<x-app-layout>
    <x-slot name="slot">
        <div class="page-content">
            @auth

            @if(Session('role')=='admin')
            <div class="row">
                <div class="col-16">
                    <div>
                        <x-complaint-form :complaintTypes="$complaintTypes" />
                    </div>
                </div>
            </div>
            @endif
            @endauth

        </div>
    </x-slot>
</x-app-layout>