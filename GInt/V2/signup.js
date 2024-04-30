$(document).ready(function(){
    $("#signupForm").submit(function(event){
        event.preventDefault();
        
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();
        
        $.ajax({
            type: "POST",
            url: "signup_handler.php",
            data: {
                username: username,
                email: email,
                password: password
            },
            success: function(response){
                alert(response);
                // Redirect to login page after successful signup
                window.location.href = "login.html";
            }
        });
    });
});
