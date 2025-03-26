<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="card" id="employee-notification-form">
    <div class="card-body">
        @if(Session::get('role') == 'member')
        <h4 class="card-title mb-3">Send a Memo</h4>
        <form action="{{ route('memo.store') }}" method="POST">
            @csrf
            <!-- Memo Title -->
            <div class="mb-2">
                <label for="formrow-memotitle-input" class="form-label">Memo Title</label>
                <input type="text" class="form-control" id="formrow-memotitle-input" name="title" placeholder="Enter The Title" required>
            </div>

            <!-- Memo Content -->
            <div class="mb-2">
                <label for="formrow-memocontent-input" class="form-label">Memo Content</label>
                <textarea class="form-control" id="formrow-memocontent-input" name="content" placeholder="Enter Your Content" rows="2" required></textarea>
            </div>

            <!-- Send To Options -->
            <div class="mb-2">
                <label for="send-to-select" class="form-label">Send To</label>
                <select class="form-control" id="send-to-select" name="send_to" required>
                    <option value="all">All Employees</option>
                    <option value="heads">Heads Only</option>
                    <option value="specific">Specific Employee</option>
                </select>
            </div>

            <!-- Specific Employee Search (Hidden by default) -->
            <div id="specific-employee-search" class="mb-2" style="display: none;">
                <label for="specific-employee" class="form-label">Search for Employee</label>
                <input type="text" class="form-control" id="specific-employee" name="specific_employee" placeholder="Search for Employee">
                <div id="employee-results" style="display:none;">
                    <!-- Results will be shown here dynamically -->
                </div>
            </div>

            <!-- Timer for Memo Expiration -->
            <div class="mb-2">
                <label for="time-to-vanish" class="form-label">Send To</label>
                <select class="form-control" id="time-to-vanish" name="timer" required>
                    <option value="1">1 Hour</option>
                    <option value="2">2 Hours</option>
                    <option value="3">3 Hours</option>
                </select>
            </div>

            <!-- Final Check -->
            <div class="mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="final_check">
                    <label class="form-check-label" for="gridCheck">
                        Final Check
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-md">Send</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary w-md" data-bs-toggle="modal" data-bs-target="#memosModal" id="replyMemosButton">
                        Reply Memos
                    </button>
                </div>
            </div>

            <!-- Memo Modal for Reading -->
            <div class="modal fade" id="memoReadModal" tabindex="-1" aria-labelledby="memoReadModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="memoReadModalLabel">Memo Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 id="modalMemoTitle"></h5>
                            <p id="modalMemoContent"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table for displaying memos -->
            <div class="modal fade" id="memosModal" tabindex="-1" aria-labelledby="memosModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="memosModalLabel">Memos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Employee</th>
                                        <th>Content</th>
                                        <th>Reply</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="employee-memo-table-body">
                                    <!-- Memo rows will be added dynamically here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        @else
        <div class="card-body mt-1">
            <h4 class="card-title mb-3">Your Memos</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employee-memo-table-body">
                        <!-- Memos will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>



        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Toggle specific employee search visibility based on "Send To" selection
        document.getElementById('send-to-select').addEventListener('change', function() {
            var sendToValue = this.value;
            var searchContainer = document.getElementById('specific-employee-search');

            if (sendToValue === 'specific') {
                searchContainer.style.display = 'block';
            } else {
                searchContainer.style.display = 'none';
                document.getElementById('employee-results').style.display = 'none'; // Hide results when not searching
            }
        });

        // Fetch and display employee search results dynamically
        document.getElementById('specific-employee').addEventListener('input', function() {
            var searchTerm = this.value;
            if (searchTerm.length > 2) { // Start searching after 3 characters
                fetch(`/search-employees?specific-employee=${searchTerm}`)
                    .then(response => response.json())
                    .then(data => {
                        var resultsContainer = document.getElementById('employee-results');
                        resultsContainer.style.display = 'block';
                        resultsContainer.innerHTML = '';
                        data.forEach(employee => {
                            var employeeDiv = document.createElement('div');
                            employeeDiv.textContent = employee.emp_id + ' - ' + employee.full_name;
                            employeeDiv.addEventListener('click', function() {
                                document.getElementById('specific-employee').value = employee.full_name;
                                document.getElementById('employee-results').style.display = 'none';
                                document.getElementById('specific-employee-id').value = employee.emp_id; // Save emp_id to hidden field
                            });
                            resultsContainer.appendChild(employeeDiv);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching employee data:', error);
                    });
            } else {
                document.getElementById('employee-results').style.display = 'none'; // Hide results if search is too short
            }
        });

        document.getElementById('replyMemosButton').addEventListener('click', function() {
            console.log('Fetching memos');
            fetch('/memos') // Ensure you're calling the right route for fetching employee-specific memos
                .then(response => response.json())
                .then(data => {
                    var tableBody = document.getElementById('employee-memo-table-body');
                    tableBody.innerHTML = ''; // Clear existing data

                    if (data.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="5">No memos available.</td></tr>';
                    }

                    data.forEach(memo => {
                        var row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${memo.title}</td>
                    <td>${memo.specific_employee || 'All Employees'}</td>
                    <td>${memo.content}</td>
                    <td>${memo.reply || 'No reply yet'}</td>
                    <td>
                        <form action="{{ route('memo.reply', ':id') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="reply" class="form-control" required>
                                <button type="submit" class="btn btn-primary">Reply Back</button>
                            </div>
                        </form>
                    </td>
                `;
                        // Replace :id with the actual memo ID in the form action
                        row.querySelector('form').action = row.querySelector('form').action.replace(':id', memo.id);
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching memos:', error);
                });
        });

    });

    document.addEventListener('DOMContentLoaded', fetchMemos); // Fetch memos when the page loads

    // Function to fetch and display memos for the employee
    function fetchMemos() {
        console.log('Fetching memos...');

        fetch('/employee-memos')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('employee-memo-table-body');
                tableBody.innerHTML = ''; // Clear existing data

                if (data.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="3">No memos available.</td></tr>';
                }

                console.log(data); // Add this line to log the fetched data

                // Loop through the memos and add them to the table
                data.forEach(memo => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${memo.title}</td>
                <td>${memo.content}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <!-- Reply input field always visible -->
                        <div class="input-group me-2">
                            <input type="text" id="reply-input-${memo.id}" class="form-control" placeholder="Enter your reply" />
                            <button class="btn btn-info" onclick="replyMemo(${memo.id})">Reply</button>
                        </div>
                        
                        <!-- "Mark as Read" button is only visible if the memo is unread -->
                        <div style="display: ${memo.read ? 'none' : 'block'}">
                            <button class="btn btn-primary" onclick="markAsRead(${memo.id})">Read ✔</button>
                        </div>
                        
                        <!-- "Read" badge is only visible if the memo is read -->
                        <div style="display: ${memo.read ? 'block' : 'none'}">
                            <span class="badge bg-success">Read</span>
                        </div>
                    </div>
                </td>
                `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching memos:', error));
    }

    // Function to reply to a memo
    function replyMemo(memoId) {
        const replyText = document.getElementById(`reply-input-${memoId}`).value;
        if (!replyText) return;

        fetch(`/memo/reply/${memoId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    reply: replyText
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Reply sent successfully!');
                    fetchMemos(); // Re-fetch the memos to update the replies
                } else {
                    alert('Failed to send reply.');
                }
            })
            .catch(error => console.error('Error replying to memo:', error));
    }

    // Function to mark a memo as read
    function markAsRead(memoId) {
        fetch(`/memo/read/${memoId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchMemos(); // Re-fetch memos to update the read status
                } else {
                    console.error('Failed to mark memo as read.');
                }
            })
            .catch(error => console.error('Error marking memo as read:', error));
    }
</script>