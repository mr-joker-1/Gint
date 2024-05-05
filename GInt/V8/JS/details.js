$(document).ready(function() {
  // Make AJAX request to get user details
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

  // Add event listener to logout button
  $("#logout").on("click", function() {
      // Remove username from local storage
      localStorage.removeItem("username");
      // Redirect to login page
      window.location.href = "../HTML/login.html";
  });
});

