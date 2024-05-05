$(document).ready(function(){
    localStorage.getItem("username")
    $('#saveProfile').click(function(){
        
        // Retrieve the username from the hidden input field and display it
        // var username = document.getElementById("username").value;
        // document.getElementById("displayUsername").innerText = username;

        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var dob = $('#dob').val();
        console.log("Clicked");
        $.ajax({
            type: 'POST',
            url: '../PHP/profile.php',
            data: {name: name, email: email, mobile: mobile, dob: dob},
            success: function(response){ 
                console.log("Sucess");
                alert(response); // Display success message or handle as needed
            },
            // error: function(response){
            //     console.log("Failure")
            //     alert(response); // Display error message or handle as needed
            // }
        })
    })
    

    $('#viewDetails').click(function(){
        window.location.href = '../HTML/details.html';
    });

    $('#logout').click(function(){
        localStorage.removeItem('loggedInUser');
        window.location.href = '../HTML/login.html';
    });

    // JavaScript code
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
