<div class="card" id="employee-notification-form">
    <div class="card-body">
        <h4 class="card-title mb-4">Send a Memo to All</h4>

        <form action="{{ route('memo.store') }}" method="POST">
            @csrf

            <!-- Memo Title -->
            <div class="mb-3">
                <label for="formrow-memotitle-input" class="form-label">Memo Title</label>
                <input type="text" class="form-control" id="formrow-memotitle-input" name="title" placeholder="Enter The Title" required>
            </div>

            <!-- Memo Content -->
            <div class="mb-3">
                <label for="formrow-memocontent-input" class="form-label">Memo Content</label>
                <textarea class="form-control" id="formrow-memocontent-input" name="content" placeholder="Enter Your Content" rows="4" required></textarea>
            </div>

            <!-- Send To Options -->
            <div class="mb-3">
                <label for="send-to-select" class="form-label">Send To</label>
                <select class="form-control" id="send-to-select" name="send_to" required>
                    <option value="all">All Employees</option>
                    <option value="heads">Heads Only</option>
                    <option value="specific">Specific Employee</option>
                </select>
            </div>

            <!-- Specific Employee Search (Hidden by default) -->
            <div id="specific-employee-search" class="mb-3" style="display: none;">
                <label for="specific-employee" class="form-label">Search for Employee</label>
                <input type="text" class="form-control" id="specific-employee" name="specific_employee" placeholder="Search for Employee">
                <div id="employee-results" style="display:none;">
                    <!-- Results will be shown here dynamically -->
                </div>
            </div>

            <!-- Final Check -->
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="final_check">
                    <label class="form-check-label" for="gridCheck">
                        Final Check
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary w-md">Send</button>
            </div>
        </form>
    </div>
</div>

<!-- Add a little JavaScript to toggle the search input -->
<script>
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

    document.getElementById('specific-employee').addEventListener('input', function() {
        var searchTerm = this.value;
        if (searchTerm.length > 2) { // Start searching after 3 characters
            fetch(`/search-employees?name=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    var resultsContainer = document.getElementById('employee-results');
                    resultsContainer.style.display = 'block';
                    resultsContainer.innerHTML = '';
                    data.forEach(employee => {
                        var employeeDiv = document.createElement('div');
                        employeeDiv.textContent = employee.name + ' - ' + employee.email;
                        resultsContainer.appendChild(employeeDiv);
                    });
                });
        } else {
            document.getElementById('employee-results').style.display = 'none'; // Hide results if search is too short
        }
    });
</script>