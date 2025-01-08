<x-app-layout>

    <head>
        <meta charset="utf-8" />
        <title>CI Lanka - Complaint Management System</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
      

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/CI-logo.png">
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <!-- jQuery and Select2 JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <!-- Bootstrap-->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons-->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            User accounts
        </h2>

    </x-slot>

    <div class="py-12">

        <body data-sidebar="dark">

            <!-- Begin page -->
            <div id="layout-wrapper">

                <div class="main-content">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Search Users</h4>
                                    <div class="input-group mb-3">
                                        <input type="text" id="searchBox" class="form-control" placeholder="Search by name or email">
                                        <button id="searchButton" class="btn btn-primary">Search</button>
                                    </div>
                                    <div id="results" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="main-content">
            
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Change User Role</h4>

                                    <!-- Form Start -->
                                    <form id="changeRoleForm">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <!-- User Email Input -->
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">User Email</label>
                                            <input type="email" id="emailInput" class="form-control" placeholder="Enter user's email" required>
                                        </div>

                                        <!-- Role Select Dropdown -->
                                        <div class="mb-3">
                                            <label for="roleSelect" class="form-label">Select Role</label>
                                            <select id="roleSelect" class="form-select" required>
                                                <!-- Options will be populated dynamically -->
                                            </select>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Update Role</button>
                                    </form>
                                    <!-- Form End -->

                                    <!-- Message Display -->
                                    <div id="message" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const roleSelect = document.getElementById("roleSelect");

                            // Fetch roles from the backend
                            fetch('/api/roles')
                                .then(response => response.json())
                                .then(roles => {
                                    // Clear existing options
                                    roleSelect.innerHTML = '<option value="">-- Select Role --</option>';

                                    // Populate roles dynamically
                                    roles.forEach(role => {
                                        const option = document.createElement('option');
                                        option.value = role.name; 
                                        option.textContent = role.name; 
                                        roleSelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error('Error fetching roles:', error));
                        });
                    </script>

<script>
    // Form Submit Logic
    document.getElementById('changeRoleForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const email = document.getElementById('emailInput').value;
        const role = document.getElementById('roleSelect').value;
        const message = document.getElementById('message');

        // Basic validation
        if ( !role || !email) {
            message.innerHTML = '<div class="alert alert-danger">Please fill in all fields.</div>';
            return;
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Send PUT request to update the user's role
        fetch(`/api/users/update-role`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ email: email, role: role })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update role.');
            }
            return response.json();
        })
        .then(data => {
            // Show success message
            message.innerHTML = `<div class="alert alert-success">Role updated successfully for <b>${data.user.name}</b>.</div>`;
        })
        .catch(error => {
            // Show error message
            message.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
    });
</script>

        </body>
    </div>

    <script>
   document.getElementById('searchButton').addEventListener('click', function () {
    const query = document.getElementById('searchBox').value;

    fetch(`/search?query=${query}`) // Corrected template literal
        .then(response => response.json())
        .then(data => {
            let results = '';
            data.forEach(user => {
                results += `
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Name: ${user.name}</h5>
                            <p class="card-text">Email: ${user.email}</p>
                            <p class="card-text">Role: ${user.role}</p>
                        </div>
                    </div>`;
            });
            document.getElementById('results').innerHTML = results || '<p>No users found.</p>';
        })
        .catch(error => console.error('Error fetching users:', error));
});

    </script>
</x-app-layout> 