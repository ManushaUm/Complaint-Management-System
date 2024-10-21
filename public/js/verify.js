$(document).ready(function() {
    $('#verify-userid-btn').click(function() { // Change the button ID to match user ID verification
        var userId = $('#user_id').val(); // Get the entered user ID
        
        $.ajax({
            url: "/verify-user", // Change URL to reflect user ID verification route
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                user_id: userId // Change to user_id instead of policy_number
            },
            success: function(response) {
                if (response.exists) {
                    $('#verification-message').html('<div class="alert alert-success">User ID is valid!</div>');
                } else {
                    $('#verification-message').html('<div class="alert alert-danger">User ID does not exist.</div>');
                }
            },
            error: function() {
                $('#verification-message').html('<div class="alert alert-danger">Error verifying user ID. Please try again later.</div>');
            }
        });
    });
});
