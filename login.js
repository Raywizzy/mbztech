$(document).ready(function() {
  $("#login").click(function() {
      var username = $("#username").val();
      var password = $("#password").val();
      var csrfToken = $("input[name=csrf_token]").val();

      $.ajax({
          type: "POST",
          url: "login_process.php",
          data: {
              username: username,
              password: password,
              csrf_token: csrfToken
          },
          success: function(response) {
              if (response === "success") {
                  window.location.href = "dashboard.php"; // Redirect to dashboard on successful login
              } else {
                  $(".alert").html(response).fadeIn(); // Display error message
              }
          }
      });
  });
});
