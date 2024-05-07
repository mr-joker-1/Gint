$(document).ready(function(){
    $('#loginForm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            type: 'POST',
            url: '../PHP/login.php',
            data: formData, // Use formData variable here
            dataType: 'json', // Parse response as JSON
            success: function(response){
                if(response.status == 'success'){
                    // Store token in local storage
                    localStorage.setItem('token', response.token);
                    
                    // Check if user details are present in MongoDB
                    $.ajax({
                        type: 'POST',
                        url: '../PHP/check_user_details.php',
                        data: formData, // Send formData to check user details
                        success: function(result){
                            if(result == 'details_present'){
                                // User details are present, forward to details.html
                                window.location.href = '../HTML/details.html';
                            } else {
                                // User details are not present, forward to profile.html
                                window.location.href = '../HTML/profile.html';
                            }
                        },
                        error: function(xhr, status, error){
                            // Handle error
                            console.error(error);
                        }
                    });
                } else {
                    alert('Invalid username or password');
                }
            },
            error: function(xhr, status, error){
                // Handle error
                console.error(error);
            }
        });
    });
});
