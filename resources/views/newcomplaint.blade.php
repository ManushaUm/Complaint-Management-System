<x-app-layout>
    <x-slot name="slot">
        <div class="py-12">
            @auth
            @if(Session('role')=='admin')

            <x-complaint-form :complaintTypes="$complaintTypes" />


        </div>
        @endif
        @endauth
        </div>

    </x-slot>



</x-app-layout>