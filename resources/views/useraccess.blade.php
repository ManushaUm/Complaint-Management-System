<x-app-layout>
    <x-slot name="slot">

        <div class="py-2">
            <x-vertical-nav-tab :departments="$departments" :divisionsData="$divisionsData" />
        </div>

    </x-slot>
</x-app-layout>