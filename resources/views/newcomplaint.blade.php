<x-app-layout>

    <div class="py-12">
        @auth
        @if(Session('role')=='admin')

        <body data-sidebar="light">
            <!-- Begin page -->
            <div id="layout-wrapper">
                <div class="justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <x-complaint-form :complaintTypes="$complaintTypes" />
                        </div>
                    </div>
                </div>
            </div>
        </body>
        @endif
        @endauth
    </div>





</x-app-layout>