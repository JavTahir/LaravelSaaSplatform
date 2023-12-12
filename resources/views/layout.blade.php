<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Google Sign-In Script -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <title>@yield('title','Custom Auth Laravel')</title>
    <style>
      body {
        background: linear-gradient(
          to right,
          rgb(218, 174, 231),
          rgb(67, 62, 69)
        );
        font-family: "Montserrat", sans-serif;
      }

      .login-container {
        overflow: hidden;
      }

      /* .left-container {
        padding: 20px;
        padding-left: 60px;
    
      } */

      .left-container {
        position: -webkit-sticky; /* For Safari */
        position: sticky;
        top: 0;
        height: 100vh; /* to make it take the full viewport height */
        overflow-y: hidden; /* to prevent the scroll */
        padding-left: 30px;
      }

      .right-container {
        max-height: 100vh;
        overflow-y: hidden;
        padding: 30px 20px;
        padding-top: 50px;
        padding-left: 80px;
        background-color: rgb(255, 255, 255);
      }

      .logo {
        margin-top: 30px;
        margin-bottom: 30px;
        z-index: 10; /* Ensure logo stays on top */
        position: relative;
      }

      .left-content {
        margin-bottom: 40px;
      }

      .left-content h2 {
        margin: 10px 0;
        font-weight: bold;
        color: #333;
      }

      .left-content p {
        margin: 20px 0;
        color: #585757;
        font-weight: 400;
      }

      .video-container {
        padding: 20px;
      }

      .video-content {
        padding-top: 20px;
        padding-bottom: 20px;
      }

      .right-container h2 {
        margin: 10px 0;
        font-weight: bold;

        background-image: linear-gradient(
          to right,

          rgb(84, 58, 90),
          rgb(201, 153, 215)
        );
        color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
      }

      .form-control {
        border-radius: 6px;
        border: 1px solid #e5e5e5;
      }

      /* Adjusting label, input fields, and buttons weight to 300 */
      .form-label {
        font-weight: 500;
      }
      .form-control,
      .btn {
        font-weight: 400;
      }

      .form-control {
        border-color: rgba(52, 48, 69, 1);
      }

      /* Setting width of buttons and input fields to 300px */
      .form-control,
      .btn {
        width: 400px;
      }

      .btn-dark {
        background-color: #333;
      }

      .btn-primary {
        background: linear-gradient(
          to right,
          rgb(201, 153, 215),
          rgb(182, 135, 193)
        );
        border: none;
      }

      .btn-primary:hover {
        background: linear-gradient(
          to right,
          rgb(201, 153, 215),
          rgb(84, 58, 90)
        );
      }

      .agreement {
        width: 80%;
        font-size: 12px;
        margin-left: 10px;
      }
      .account {
        font-size: 14px;
        text-align: center;
        margin-right: 80px;
      }

      .error {
        color: red;
        font-size: 12px;
      }

      @media (max-width: 992px) {
        .login-container {
          border-radius: 0;
        }

        .right-container {
          overflow-x: hidden;
          padding: 10px 10px;
          padding-top: 30px;
          padding-left: 50px;

          background-color: rgb(255, 255, 255);
        }

        .form-control,
        .btn {
          width: 85%;
        }
      }
    </style>
  </head>
  <body>
    @yield('content')


    <script>
      function validateForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        var emailRegex =
          /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var passwordRegex = /^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/;

        var isValid = true;

        if (!emailRegex.test(email)) {
          document.getElementById("emailError").innerHTML =
            "Invalid email address";
          isValid = false;
        } else {
          document.getElementById("emailError").innerHTML = "";
        }

        if (!passwordRegex.test(password)) {
          document.getElementById("passwordError").innerHTML =
            "Password must be at least 8 characters long and contain at least one number and one letter";
          isValid = false;
        } else {
          document.getElementById("passwordError").innerHTML = "";
        }

        return isValid;
      }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>

