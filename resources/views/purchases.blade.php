@extends('dashboard_admin')
@section('title','Payments')

@section('content')
<head>
    <style>
      body {
        background-color: #f8f9fa;
      }

      .custom-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        max-width: 900px;
        margin: 50px auto 0;
        max-height: 800px;
        position: relative;
      }

      .set-reminder-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(
          255,
          255,
          255,
          0.8
        ); /* Light transparent background */
        color: #333; /* Text color */
        border: 1px solid #333; /* Solid border */
        border-radius: 23px;
        padding: 7px 10px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease,
          border-color 0.3s ease;
      }

      .set-reminder-button:hover {
        background: linear-gradient(
          to right,
          rgb(201, 153, 215),
          rgb(84, 58, 90)
        );
        color: #fff; /* Text color on hover */
        border-color: #fff; /* Border color on hover */
      }
      .user-card {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 10px;
        margin-bottom: 15px;
      }

      .user-profile-pic {
        max-width: 150px;
        height: 50px;
        border-radius: 50%;
      }

      .user-info {
        margin-top: 15px;
      }

      .user-name {
        font-size: 1.2em;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 600;
        color: rgb(108, 41, 108);
        margin-bottom: 0;
        margin-left:50px;
      }

      .subscription-info {
        margin-top: 20px;
        background-color: rgba(227, 227, 227, 0.299);
        padding: 3px;
        padding-left: 10px;
      }

      .status-label {
        font-weight: 600;
        font-size: 13px;
        padding: 0px;
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: 2px;
        border-radius: 5px;
        margin-left: 10px; /* Add margin between subscription name and status label */
        background-color: rgba(166, 222, 170, 0.568);
      }

      .status-label1 {
        font-weight: 600;
        font-size: 13px;
        padding: 0px;
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: 2px;
        border-radius: 5px;
        margin-left: 10px; /* Add margin between subscription name and status label */
        background-color: rgba(225, 168, 160, 0.568);
      }

      .active-status {
        color: #5c7746d6; /* Green color for active status */
      }

      .renewal-status {
        color: #dc3545; /* Light red color for renewal status */
      }

      .next-payment-cost {
        margin-top: -10px;
      }

      .reminder {
        margin-bottom: 50px;
      }

      .timer {
        font-size: 14px;
        font-weight: bold;
        color: black; /* Text color */
        padding: 5px 10px;
        border-radius: 5px;
        margin-top: 5px;
        display: inline-block;
    }

    
    </style>
  </head>
  <body>
    <div class="custom-container" data-simplebar>
      <div class="reminder">
        <button class="set-reminder-button">Set Reminder</button>
      </div>

      @foreach($users as $user)
      <div class="user-card">
        <div class="d-flex align-items-center user-info">
        <img
            src="{{ asset('storage/uploads/' . $user->image_path) }}"
            alt="Profile Pic"
            class="user-profile-pic mr-3"
        />

          <div>
            <h4 class="user-name">{{ $user->first_name }} {{ $user->last_name }}</h4>
            <label style="font-size: 14px; color: rgb(135, 133, 133); margin-left:50px;"
              >ID-{{ $user->id }}</label
            >
          </div>
        </div>
        <div class="info">
          <div class="subscription-info">
          <p style="margin-bottom: 15px">
              {{ $user->plan_name }} Plan
              @if (strtotime($user->plan_date . ' +30 days') > time())
                  <span class="status-label active-status">Active</span>
              @else
                  <span class="status-label1 renewal-status">Renewal</span>
              @endif

          </p>


            <p class="next-payment-cost">
              <strong>Expiration Timer:</strong>
              <span class="timer" data-start="{{ $user->plan_date }}" data-duration="30"></span>
            </p>
          </div>
        </div>
      </div>
      @endforeach

    </div>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Timer Script -->
<script>
    $(document).ready(function () {
        $(".timer").each(function () {
            var startDate = new Date($(this).data("start")).getTime();
            var duration = parseInt($(this).data("duration")) * 24 * 60 * 60 * 1000;
            var expirationDate = startDate + duration;

            var timerInterval = setInterval(function () {
                var now = new Date().getTime();

                if (now < startDate) {
                    var timeRemainingBeforeStart = startDate - now;
                    var daysBeforeStart = Math.floor(timeRemainingBeforeStart / (1000 * 60 * 60 * 24));
                    var hoursBeforeStart = Math.floor((timeRemainingBeforeStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutesBeforeStart = Math.floor((timeRemainingBeforeStart % (1000 * 60 * 60)) / (1000 * 60));

                    $(this).html(daysBeforeStart + "d | " + hoursBeforeStart + "hrs | " + minutesBeforeStart + "min ");
                  } else if (now > expirationDate) {
                    clearInterval(timerInterval);
                    $(this).html("Expired").addClass("expired");
                } else {
                    var timeRemaining = expirationDate - now;
                    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));

                    $(this).html(days + "d | " + hours + "hrs | " + minutes + "min ");
                }
            }.bind(this), 1000);
        });
    });
</script>

  </body>
@endsection