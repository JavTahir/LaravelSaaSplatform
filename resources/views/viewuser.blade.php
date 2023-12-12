@extends('dashboard_admin')
@section('title','View User')

@section('content')

<head>
  

    <style>
      body {
        background-color: #f8f9fa;
      }

      .user-info-container {
        max-width: 950px;
        margin: auto;
        padding: 150px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        position: relative;
      }

      .close-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        z-index: 1;
        /* Ensure the close icon is above other elements */
        color: #6c757d;
        /* Grey color for the close icon */
      }

      .profile-pic {
        width: 300px;
        height: 270px;
        border-radius: 0%;
        margin-left: -10%;
        margin-top: -10%;
        margin-right: 100px;
        /* Added margin-right for spacing */
        margin-bottom: 30px;
        background-color: #ddd;
        overflow: hidden;
        float: left;
      }

      .name-label {
        font-size: 30px;
        /* Adjusted font size for the name label */
        font-weight: bold;
        /* Added font-weight for emphasis */
        margin-bottom: 60px;
        /* Adjusted margin for spacing */
        color: rgb(134, 73, 164);
        /* Black color for text */
      }

      .info-section1,
      .info-section {
        margin-left: 10px;
        clear: left;
        float: left;
        /* Added float to make info-section1 and custom-div appear in a row */
      }

      .info-section1 i,
      .info-section i {
        color: #6c757d;
        /* Grey color for icons */
        margin-right: 40px;
      }

      .info-section1 p,
      .info-section p {
        color: #343a40;
        /* Black color for text */
        margin-bottom: 10px;
        font-size: 21px;
      }

      /* Div below the search bar */
      .custom-div {
        background: rgba(213.9, 201.95, 233.4, 0.78);
        width: 300px;
        /* Set the width to your desired value */
        height: 200px;
        /* Set the height to your desired value */
        margin-left: 30px;
        border-radius: 2px;
        margin-top: 10px;
        overflow: auto;
        /* Enable scrolling */
        box-shadow: 5px 5px 5px #888888;
      }

      .custom-div::-webkit-scrollbar {
        width: 5px;
      }

      .custom-div::-webkit-scrollbar-thumb {
        background: rgba(154, 133, 187, 0.99);
        /* Dark purple color for the thumb */
        border-radius: 10px;
      }

      .custom-div::-webkit-scrollbar-track {
        background: rgba(202.04, 189.99, 221.71, 0.78);
        /* Light purple color for the track */
        border-radius: 10px;
      }

      /* User item container */
      .user-item {
        display: flex;
        align-items: center;
        padding: 10px;
      }

      /* Profile image styles */
      .profile-image {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: -70px;
      }

      /* User name styles */
      .user-name {
        flex: 1;
        font-size: 16px;
        margin-left: 90px;
        text-align: left;
      }

      .add-icon {
        width: 30px;
        height: 30px;
      }

      @media (max-width: 768px) {
        /* Apply styles for screens smaller than 768px */
        .info-section1,
        .info-section,
        .profile-pic,
        .name-label,
        .info-section1 i,
        .info-section i,
        .info-section1 p,
        .info-section p,
        .custom-div,
        .user-item,
        .profile-image,
        .user-name,
        .add-icon {
          width: 100%;
          /* Make elements full width */
          margin-right: 0;
          /* Remove right margin */
          margin-left: 0;
          /* Remove left margin */
        }

        .user-info-container {
          padding: 20px;
          /* Decreased padding for smaller screens */
        }

        .profile-image {
          width: 30px;
        }

        .add-icon {
          width: 20px;
        }
      }
    </style>
  </head>

  <body>
    <div class="user-info-container">
      <div class="close-icon" onclick="toggleContainer()">
        <i class="fas fa-times-circle fa-2x"></i>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="profile-pic">
            <!-- You can replace the image URL with the user's profile picture -->
            <img
              src="images/profile 1.png"
              alt="Profile Picture"
              class="img-fluid"
              style="width: 300px; height: 270px"
            />
          </div>

          <div class="info-section">
            <div class="name-label">John Doe</div>
            <!-- Replace with the actual name -->

            <p><i class="fas fa-user"></i>Administrator</p>
            <p><i class="fas fa-building"></i>ABC Company</p>
            <p><i class="fas fa-map-marker-alt"></i>Switzerland</p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-section1">
            <p><i class="fas fa-envelope"></i>user@example.com</p>
            <p><i class="fas fa-phone"></i>+123 456 789</p>
            <p><i class="fas fa-calendar-alt"></i>January 1, 1990</p>
            <p><i class="fas fa-clock"></i>January 1, 2020</p>
          </div>
          <label
            style="
              margin-top: 100px;
              font-size: 24px;
              font-weight: 600;
              margin-left: 10px;
              color: #615959;
            "
            >Linked Accounts</label
          >

          <div class="custom-div" style="float: right">
            <!-- User items -->
            <div class="user-item">
              <img
                src="images/profile 1.png"
                class="profile-image"
                alt="User 1"
              />
              <div class="user-name">Marketing</div>
              <img
                src="images/Instagram.png"
                class="add-icon"
                alt="Add"
              />
            </div>
            <div class="user-item">
              <img
                src="images/profile 1.png"
                class="profile-image"
                alt="User 2"
              />
              <div class="user-name">Finance</div>
              <img
                src="images/LinkedIn.png"
                class="add-icon"
                alt="Add"
              />
            </div>

            <div class="user-item">
              <img
                src="images/profile 1.png"
                class="profile-image"
                alt="User 2"
              />
              <div class="user-name">Nature Sparkles</div>
              <img
                src="images/Twitter.png"
                class="add-icon"
                alt="Add"
              />
            </div>
            <!-- Repeat user items as needed -->
          </div>
        </div>
      </div>
    </div>

    <script>
      function toggleContainer() {
        var container = document.querySelector(".user-info-container");
        container.style.display =
          container.style.display === "none" || container.style.display === ""
            ? "block"
            : "none";
      }
    </script>
@endsection()