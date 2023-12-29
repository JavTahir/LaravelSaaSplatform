<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <title>Profile</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .edit-profile-container {
      background-color: #ffffff;
      box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 80%; /* Adjust the width as needed */
      max-width: 800px; /* Set a max-width for responsiveness */
      text-align: left;
      margin-top: 30px; /* Add some top margin for aesthetics */
    }
    .profile-pic {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }
    .edit-icon {
      position: relative;
      top: 30px;
      left: -30px;
      background-color: #ffffff;
      padding: 5px;
      border-radius: 50%;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }
    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
        max-width: 400px;
    }

    .error-text {
      color: red;
      font-size: 12px;
    }

    .format {
      color: rgb(0, 19, 227);
      font-size: 12px;
    }
  </style>
</head>

<body>
@include('sweetalert::alert')


<div class="container">
  <div class="edit-profile-container">
    <h2>Edit Profile</h2>
    <img src="images/profile.png" alt="Profile Picture" class="profile-pic" id="profilePic">
    <span class="edit-icon" onclick="document.getElementById('fileInput').click()">✎</span>

    <form onsubmit="return validateForm()" id="profileForm" action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Hidden file input outside the visible area -->
    <input type="file" id="fileInput" name="fileInput" accept="image/*" style="position: absolute; left: -9999px;" onchange="updateProfilePic(event)">
        
        <div class="form-group">
            <div class="row">
              <div class="col">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" >
                <span id="fnameError" class="error-text"></span>
              </div>
              <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" >
                <span id="lnameError" class="error-text"></span>
              </div>
            </div>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}"  readonly>
          <span id="emailError" class="error-text"></span>
          <span id="emailformat" class="format"></span>
        </div>

        <div class="form-group">
          <label for="contactNo">Contact No</label>
          <input type="text" class="form-control" id="contactNo" name="contactNo" placeholder="Contact No" >
          <span id="contactNoError" class="error-text"></span>
          <span id="contactformat" class="format"></span>
        </div>

        <div class="form-group">
          <label for="dob">Date of Birth</label>
          <input type="date" class="form-control" id="dob" name="dob" >
          <span id="dobError" class="error-text"></span>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="country">Country</label>
              <input type="text" class="form-control" id="country" name="country" placeholder="Country">
              <span id="countryError" class="error-text"></span>
            </div>
            <div class="col">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="City" >
              <span id="cityError" class="error-text"></span>
            </div>
          </div>
        </div>

       

        <button type="submit" class="btn btn-primary" >Save Changes</button>
    </form>
  </div>
</div>



<script>
  function updateProfilePic(event) {
    const fileInput = event.target;
    const profilePic = document.getElementById('profilePic');

    const file = fileInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        profilePic.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }

  function validateForm() {
    resetErrorMessages();

    const contactNoRegex = /^\d{10}$/;
    const countryRegex = /^[a-zA-Z\s]+$/;
    const cityRegex = /^[a-zA-Z\s]+$/;

    const fname = document.getElementById('fname').value;
    const lname = document.getElementById('lname').value;
    const contactNo = document.getElementById('contactNo').value;
    const country = document.getElementById('country').value;
    const city = document.getElementById('city').value;
    const dob = document.getElementById('dob').value;

    let isValid = true;

    if (fname === '') {
      document.getElementById('fnameError').innerText = 'Fill in the empty field';
      isValid = false;
    }

    if (lname === '') {
      document.getElementById('lnameError').innerText = 'Fill in the empty field';
      isValid = false;
    }

   

    if (dob === '') {
      document.getElementById('dobError').innerText = 'Fill in the empty field';
      isValid = false;
    }

    if (contactNo === '') {
      document.getElementById('contactNoError').innerText = 'Fill in the empty field';
      isValid = false;
    } else if (!contactNoRegex.test(contactNo)) {
      document.getElementById('contactNoError').innerText = 'Invalid contact number';
      document.getElementById('contactformat').innerText = 'Correct Format: 0XXXXXXXXXX';

      isValid = false;
    }

    

    if (country === '') {
      document.getElementById('countryError').innerText = 'Fill in the empty field';
      isValid = false;
    } else if (!countryRegex.test(country)) {
      document.getElementById('countryError').innerText = 'Invalid country name';
      isValid = false;
    }

    if (city === '') {
      document.getElementById('cityError').innerText = 'Fill in the empty field';
      isValid = false;
    } else if (!cityRegex.test(city)) {
      document.getElementById('cityError').innerText = 'Invalid city name';
      isValid = false;
    }

    return isValid;
  }

  function resetErrorMessages() {
    document.getElementById('fnameError').innerText = '';
    document.getElementById('lnameError').innerText = '';
    document.getElementById('contactNoError').innerText = '';
    document.getElementById('countryError').innerText = '';
    document.getElementById('cityError').innerText = '';
    document.getElementById('contactformat').innerText = '';

  }
</script>

</body>
</html>