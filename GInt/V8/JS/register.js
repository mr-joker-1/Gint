$(document).ready(function(){
    $('#registerForm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../PHP/register.php',
            data: formData,
            success: function(response){
                alert(response);
                window.location.href = '../HTML/login.html';
            }
        });
    });
});