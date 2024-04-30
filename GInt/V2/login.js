$(document).ready(function(){
    $("#loginForm").submit(function(event){
        event.preventDefault();
        
        var username = $("#username").val();
        var password = $("#password").val();
        
        $.ajax({
            type: "POST",
            url: "login_handler.php",
            data: {
                username: username,
                password: password
            },
            success: function(response){
                if(response === "success"){
                    // Set session in localstorage
                    localStorage.setItem("username", username);
                    // Redirect to profile page
                    window.location.href = "profile.php";
                } else {
                    alert("Invalid username or password");
                }
            }
        });
    });
});
