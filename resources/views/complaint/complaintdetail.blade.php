<x-app-layout>

    <div class="py-12">
        @auth
        @if(Session('role')=='admin')

        <body data-sidebar="light">
            <!-- Begin page -->
            <div id="layout-wrapper">
                <div class="main-content">
                    <h1>hiii</h1>
                </div>
            </div>
        </body>
        @endif
        @endauth
    </div>


</x-app-layout>