$(document).ready(function(){
    $('#saveProfile').click(function(){
        var username = $('#username').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var dob = $('#dob').val();

        $.ajax({
            type: 'POST',
            url: '/V3-Partial-Work/PHP/profile.php',
            data: {name: name, email: email, mobile: mobile, dob: dob},
            success: function(response){
                alert(response); // Display success message or handle as needed
            }
        });
    });

    $('#logout').click(function(){
        localStorage.removeItem('loggedInUser');
        window.location.href = 'login.html';
    });
});
