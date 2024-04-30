$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: 'profile.php',
        success: function(response){
            $('#profileInfo').html(response);
        }
    });

    $('#logout').click(function(){
        localStorage.removeItem('loggedInUser');
        window.location.href = 'login.html';
    });
});
