<x-app-layout>

    <x-slot name="header">
        <x-user-profile />

    </x-slot>
    <main>

        <x-vertical-nav-tab :departments="$departments" :divisionsData="$divisionsData" />

    </main>

</x-app-layout>