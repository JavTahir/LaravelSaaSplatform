@extends('accounts')
@section('title','AddAccounts')
@section('content')

<div class="container1">
      <div class="centered-text">Hi, John!</div>
      <div class="sub-text1">Let's sync your social accounts</div>
      <div class="icon-container">
        <div class="icon">
          <a href="{{ route('facebookRedirect') }}">
                  <img class="Add-icon" src="images/Plus Math.png" alt="Add" style="width: 30px; height: 30px" />
          </a>
          <img src="images/Instagram.png" alt="Instagram" />
          
        </div>
        <div class="icon">
        <a href="{{ route('twitterRedirect') }}">
                  <img class="Add-icon" src="images/Plus Math.png" alt="Add" style="width: 30px; height: 30px" />
          </a>
          <img src="images/LinkedIn.png" alt="LinkedIn" />

        </div>
        <div class="icon">
        <a href="{{ route('linkedinRedirect') }}">
                  <img class="Add-icon" src="images/Plus Math.png" alt="Add" style="width: 30px; height: 30px" />
          </a>
          <img src="images/LinkedIn.png" alt="LinkedIn" />

        </div>
      </div>
    </div>
  @endsection()