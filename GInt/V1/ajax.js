$(document).ready(function() {
    // AJAX request for user registration
    $('#signup-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
            }
        });
    });

    // AJAX request for user login
    $('#login-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                // Redirect to profile page on successful login
                window.location.href = 'profile.html';
            }
        });
    });

    // AJAX request for updating user profile
    $('#profile-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'profile.php',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
            }
        });
    });
});
