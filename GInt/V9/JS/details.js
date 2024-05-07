$(document).ready(function() {
    // Retrieve token from localStorage
    var token = localStorage.getItem('token');
    
    // Check if token is present
    if (!token) {
        // Redirect to login page if token is not present
        window.location.href = "../HTML/login.html";
        return; // Stop further execution
    }

    // Make AJAX request to validate token
    $.ajax({
        type: "POST",
        url: "../PHP/validate_token.php",
        data: { token: token },
        dataType: "json",
        success: function(response) {
            if (response.valid) {
                // Token is valid, proceed to fetch user details
                $.ajax({
                    type: "GET",
                    url: "../PHP/details.php",
                    dataType: "json",
                    success: function(data) {
                        // Display user details
                        const output = `
                            <p>Username: ${data.username}</p>
                            <p>Name: ${data.name}</p>
                            <p>DOB: ${data.dob}</p>
                            <p>Mobile: ${data.mobile}</p>
                            <p>Email: ${data.email}</p>
                        `;
                        $("#output").html(output);
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error("AJAX Error:", error);
                        $("#output").html("<p>Error retrieving user details.</p>");
                    }
                });
            } else {
                // Token is invalid, redirect to login page
                window.location.href = "../HTML/login.html";
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX error
            console.error("AJAX Error:", error);
            // Redirect to login page
            window.location.href = "../HTML/login.html";
        }
    });

    // Add event listener to logout button
    $("#logout").on("click", function() {
        // Remove token from localStorage
        localStorage.removeItem("token");
        // Redirect to login page
        window.location.href = "../HTML/login.html";
    });
});
