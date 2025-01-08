<div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <a href="/profile">
                            <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-md rounded-circle img-thumbnail"></a>
                    </div>
                    <div class="flex-grow-1 align-self-center">
                        <div class="text-muted">
                            <p class="mb-2">Welcome </p>
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 align-self-center">
                <div class="text-lg-center mt-4 mt-lg-0">
                    <div class="row">
                        <div class="col-4">
                            <div>
                                <p class="text-muted text-truncate mb-2">Total Complaints</p>
                                <h5 class="mb-0">3</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <p class="text-muted text-truncate mb-2">Assigned Complaints</p>
                                <h5 class="mb-0">2</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <p class="text-muted text-truncate mb-2">Completed</p>
                                <h5 class="mb-0">18</h5>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- end row -->
    </div>