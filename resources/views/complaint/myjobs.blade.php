<x-app-layout>
    <x-slot name="slot">
        @if(count($complaints) > 0)
        <x-member-assigned-table :complaints="$complaints" />
        @else
        <div class="page-content">
            <div class="p-4 bg-yellow-100 text-yellow-700 rounded-md">
                <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints.</p>
            </div>
        </div>
        @endif
    </x-slot>
</x-app-layout>