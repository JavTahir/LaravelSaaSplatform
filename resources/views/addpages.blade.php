@extends('accounts')
@section('title','AddPages')
@section('content')

<div class="container">
      <div class="sub-text">Which pages would you like to Add!</div>
      <!-- Search bar -->
      <input type="text" placeholder="Search..." class="search-input" />
      <!-- Custom div below the search bar -->
      <div class="custom-div">
        <!-- User items -->
        <div class="user-item">
          <img
            src="images/profile 1.png"
            class="profile-image"
            alt="User 1"
          />
          <div class="user-name">Marketing</div>
          <img src="images/Plus.png" class="add-icon" alt="Add" />
        </div>
        <div class="user-item">
          <img
            src="images/profile 1.png"
            class="profile-image"
            alt="User 2"
          />
          <div class="user-name">Finance</div>
          <img src="images/Plus.png" class="add-icon" alt="Add" />
        </div>

        <div class="user-item">
          <img
            src="images/profile 1.png"
            class="profile-image"
            alt="User 2"
          />
          <div class="user-name">Nature Sparkles</div>
          <img src="images/Plus.png" class="add-icon" alt="Add" />
        </div>
        <!-- Repeat user items as needed -->
      </div>
      <img
        src="images/Chevron Right.png"
        class="right-arrow"
        alt="Right Arrow"
      />
    </div>
@endsection()