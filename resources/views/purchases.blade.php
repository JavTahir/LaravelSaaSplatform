@extends('dashboard_admin')
@section('title','Payments')

@section('content')
<head>
  

    <style>
      body {
        background-color: #f8f9fa; /* Set a light background color */
      }

      .custom-container {
        background-color: rgba(
          255,
          255,
          255,
          0.9
        ); /* Set a transparent white background */
        border-radius: 10px; /* Add rounded corners */
        padding: 20px;
        max-width: 600px; /* Set a maximum width */
        margin: 50px auto 0; /* Center the container horizontally and add margin from the top */

        max-height: 550px; /* Set a maximum height for the container */
        position: relative; /* Relative positioning for absolute positioning of the button */
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
        max-width: 150px; /* Increase the size of the profile picture */
        height: 50px;
        border-radius: 50%;
      }

      .user-info {
        margin-top: 15px;
      }

      .user-name {
        font-size: 1.2em; /* Increase font size for the username */
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 600;
        color: rgb(108, 41, 108);
        margin-bottom: 0;
      }

      .subscription-info {
        margin-top: 20px;
        background-color: rgba(227, 227, 227, 0.299);
        padding: 3px;

        padding-left: 10px;
      }

      /* .subscription-info:hover {
            
            background-color: rgb(201, 201, 201);
            padding: 3px;
        } */

      /* .info:hover{
            background-color: rgb(201, 201, 201);
            padding: 1px;
        } */

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
        margin-top: -10px; /* Add margin-top to the Next Payment Cost */
      }

      .reminder {
        margin-bottom: 50px;
      }
    </style>
  </head>
  <body>
    <div class="custom-container" data-simplebar>
      <div class="reminder">
        <button class="set-reminder-button">Set Reminder</button>
      </div>

      <!-- User Cards -->
      <div class="user-card">
        <div class="d-flex align-items-center user-info">
          <img
            src="images/profile 1.png"
            alt="Profile Pic"
            class="user-profile-pic mr-3"
          />
          <div>
            <h4 class="user-name">John Doe</h4>
            <label style="font-size: 14px; color: rgb(135, 133, 133)"
              >ID-1334</label
            >
          </div>
        </div>
        <div class="info">
          <div class="subscription-info">
            <p style="margin-bottom: 15px">
              Basic Plan (1 month)
              <span class="status-label active-status">Active</span>
            </p>
            <p class="next-payment-cost">
              <strong>Next Payment Cost:</strong> $10.00
            </p>
          </div>
        </div>
      </div>

      <div class="user-card">
        <div class="d-flex align-items-center user-info">
          <img
            src="images/profile 1.png"
            alt="Profile Pic"
            class="user-profile-pic mr-3"
          />
          <div>
            <h4 class="user-name">John Doe</h4>
            <label style="font-size: 14px; color: rgb(135, 133, 133)"
              >ID-1334</label
            >
          </div>
        </div>
        <div class="info">
          <div class="subscription-info">
            <p style="margin-bottom: 15px">
              Basic Plan (1 month)
              <span class="status-label1 renewal-status">renewal</span>
            </p>
            <p class="next-payment-cost"><strong>To be paid:</strong> $10.00</p>
          </div>
        </div>
      </div>

      <!-- Add more user cards as needed -->
    </div>
@endsection()
