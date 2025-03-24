<x-app-layout>
    <x-slot name="slot">
        <div class="page-content">
            @if(count($complaints) > 0)
            <x-member-assigned-table :complaints="$complaints" />
            @else

            <div class="p-4 bg-yellow-100 text-yellow-700 rounded-md">
                <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no complaints left.</p>
            </div>

            @endif
        </div>
    </x-slot>
</x-app-layout>