@auth
<div class="vertical-menu">



    <div data-simplebar class="h-100">


        @if(Session('role') == 'admin')
        <!--- Sidemenu admin only -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">04</span>
                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-task"></i>
                        <span key="t-layouts">Complaints</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true">
                        <li>
                            <a href="{{route('newcomplaint')}}" key="t-vertical">New Complaints</a>
                        </li>
                        <li>
                            <a href="{{route('viewcomplaint')}}" key="t-horizontal">View Complaints</a>
                        </li>
                    </ul>
                </li>





                <li>
                    <a href="{{route('search.complaints')}}" class="waves-effect">
                        <i class="bx bx-search"></i><span class="badge rounded-pill bg-success float-end">New</span>
                        <span key="t-dashboards">Search</span>
                    </a>

                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Internal Services</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('departments')}}" key="t-products">Departments management</a></li>
                        <li><a href="{{route('users')}}" key="t-product-detail">User Management</a></li>

                    </ul>
                </li>

            </ul>
        </div>
        @endif

        @if(Session('role') == 'head' || Session('role') == 'd-head')
        <!--- Sidemenu heads -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">04</span>
                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-task"></i>
                        <span key="t-layouts">Complaints</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true">
                        <li>
                            <a href="{{route('viewcomplaint')}}" key="t-horizontal">View Complaints</a>
                        </li>
                        <li>
                            <a href="{{route('my-jobs')}}" key="t-horizontal">My Jobs</a>
                        </li>

                        <li>
                            <a href="{{route('closed-jobs')}}" key="t-horizontal">Closed Jobs</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('search.complaints')}}" class="waves-effect">
                        <i class="bx bx-search"></i><span class="badge rounded-pill bg-success float-end">New</span>
                        <span key="t-dashboards">Search</span>
                    </a>

                </li>

            </ul>
        </div>
        @endif

        @if(Session('role') == 'member')
        <!--- Sidemenu Members -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">04</span>
                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-task"></i>
                        <span key="t-layouts">Complaints</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true">
                        <li>
                            <a href="{{route('viewcomplaint')}}" key="t-horizontal">View Complaints</a>
                        </li>
                        <li>
                            <a href="{{route('my-jobs')}}" key="t-horizontal">My Jobs</a>
                        </li>
                        <li>
                            <a href="{{route('completedJobs')}}" key="t-horizontal">Completed Jobs</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('search.complaints')}}" class="waves-effect">
                        <i class="bx bx-search"></i><span class="badge rounded-pill bg-success float-end">New</span>
                        <span key="t-dashboards">Search</span>
                    </a>

                </li>

            </ul>
        </div>
        @endif

    </div>

</div>
@endif
<!-- Left Sidebar End -->