$(document).ready(function() {
    $('#verify-policy-btn').click(function() {
        var policyNumber = $('#policy_number').val(); // Get the entered policy number
        
        $.ajax({
            url: "/verifyPolicy",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                policy_number: policyNumber
            },
            success: function(response) {
                if (response.exists) {
                    // If the policy number exists, show success message
                    $('#policy-verification-message').html('<div class="alert alert-success">Policy number is valid!</div>');
                } else {
                    // If the policy number does not exist, show error message
                    $('#policy-verification-message').html('<div class="alert alert-danger">Policy number does not exist.</div>');
                }
            },
            error: function() {
                // Handle any errors during the AJAX request
                $('#policy-verification-message').html('<div class="alert alert-danger">Error verifying policy. Please try again later.</div>');
            }
        });
    });
});
