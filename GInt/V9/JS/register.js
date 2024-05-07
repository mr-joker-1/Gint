$(document).ready(function(){
    $('#registerForm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../PHP/register.php',
            data: formData,
            success: function(response){
                if(response.trim() === "Registration successful") {
                    alert(response);
                    window.location.href = '../HTML/login.html';
                } else {
                    alert(response);
                    $('#registerForm')[0].reset(); // Clear form fields only on failure
                }
            }
        });
    });
});
