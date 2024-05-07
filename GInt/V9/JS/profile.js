$(document).ready(function(){
    // Retrieve token from localStorage
    var token = localStorage.getItem('token');

    // Check if token is present
    if (!token) {
        // Redirect to login page if token is not present
        window.location.href = '../HTML/login.html';
        return; // Stop further execution
    }

    // Validate token
    $.ajax({
        type: 'POST',
        url: '../PHP/validate_token.php',
        data: { token: token },
        dataType: 'json',
        success: function(response) {
            if (!response.valid) {
                // Token is invalid, redirect to login page
                window.location.href = '../HTML/login.html';
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error:', error);
            // Redirect to login page
            window.location.href = '../HTML/login.html';
        }
    });

    // Profile Save Functionality
    $('#saveProfile').click(function(){
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var dob = $('#dob').val();
        $.ajax({
            type: 'POST',
            url: '../PHP/profile.php',
            data: {name: name, email: email, mobile: mobile, dob: dob},
            success: function(response){ 
                console.log('Success');
                alert(response); // Display success message or handle as needed
            },
            error: function(xhr, status, error){
                console.log('Failure');
                alert(error); // Display error message or handle as needed
            }
        });
    });

    // Redirect to View Details Page
    $('#viewDetails').click(function(){
        window.location.href = '../HTML/details.html';
    });

    // Logout Functionality
    $('#logout').click(function(){
        // Remove token from localStorage
        localStorage.removeItem('token');
        // Redirect to login page
        window.location.href = '../HTML/login.html';
    });

    // Retrieve Profile Data Functionality
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../PHP/profile.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('output').innerHTML = response; // Display the variable in the HTML element
        }
    };
    xhr.send();
});
