$(document).ready(function(){
    $('#loginForm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/V5/PHP/login.php',
            data: formData,
            success: function(response){
                if(response == 'success'){
                    window.location.href = 'profile.html';
                } else {
                    alert('Invalid username or password');
                }
            }
        });
    });
});
