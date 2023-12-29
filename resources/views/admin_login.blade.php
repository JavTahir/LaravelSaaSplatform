<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
  />
  <title>Super Admin Login</title>
  <style>
      body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        font-family: "Montserrat", sans-serif;
      }

      .login-box {
        width: 400px;
        height: 400px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #ceb0e991;
      }

      .login-box h2 {
        margin: 10px 0;
        font-weight: bold;

        background-image: linear-gradient(
          to right,

          rgb(84, 58, 90),
          rgb(87, 58, 95)
        );
        color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
      }

      .form-control {
        border: 1px solid #e5e5e5;
        border-color: rgb(232, 232, 232) !important;
        font-size: 13px;
        font-weight: 400;
      }

      .form-control:hover {
        outline: none;
        border: 1px solid black !important ;
      }
      .form-control:focus {
        outline: none;
        border: 2px solid black !important ;
      }

      /* Adjusting label, input fields, and buttons weight to 300 */
      .form-label {
        font-weight: 500;
        margin-left: 20px;
      }

      .btn {
        font-size: 14px;
        font-weight: 600;
      }

      /* Setting width of buttons and input fields to 300px */
      .form-control,
      .btn {
        width: 90%;
        height: 50px;
        border-radius: 8px;
        margin-left: 20px;
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
        background: linear-gradient(to right, rgb(67, 46, 73), rgb(84, 58, 90));
      }
    </style>
</head>
<body>
  <div class="login-box">
    <h2 class="text-center mb-4">Super Admin Login</h2>

    <form action="/login/admin" method="post" onsubmit="return validateForm()">
     @csrf
      <div class="form-group mb-4">
        <label for="email" class="form-label mb-1">Email</label>
        <input
          type="email"
          class="form-control"
          id="email"
          placeholder="Enter your Email"
          name="email"
          oninput="validateEmail()"
        />
        <span id="emailError" class="error"></span>
      </div>

      <div class="form-group mb-4">
        <label for="password" class="form-label mb-1">Password</label>
        <input
          type="password"
          class="form-control"
          id="password"
          placeholder="Enter password"
          name="password"
          oninput="validatePassword()"
        />
        <p style="width: 80%">
          <span id="passwordError" class="error"></span>
        </p>
      </div>
      <button type="submit" class="btn btn-dark mb-4">Sign Up</button>
    </form>
  </div>

  

  <script>
    function validateEmail() {
      const emailInput = document.getElementById('email');
      const emailError = document.getElementById('emailError');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (emailInput.value.match(emailRegex)) {
        emailError.textContent = '';
      } else {
        emailError.textContent = 'Invalid email format';
      }
    }

    function validatePassword() {
      const passwordInput = document.getElementById('password');
      const passwordError = document.getElementById('passwordError');
      const passwordRegex = /^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/;

      if (passwordInput.value.match(passwordRegex)) {
        passwordError.textContent = '';
      } else {
        passwordError.textContent = 'Password must be at least 8 characters and contain at least one letter and one number';
      }
    }

    function validateForm() {
      validateEmail();
      validatePassword();

      // Add additional validation logic if needed

      // If all validations pass, you can proceed with form submission
      return true;
    }
  </script>
</body>
</html>
