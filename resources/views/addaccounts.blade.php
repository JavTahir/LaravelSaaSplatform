@extends('accounts')
@section('title', 'AddAccounts')
@section('content')

<div class="container1">
    <div class="centered-text">Hi, John!</div>
    <div class="sub-text1">Let's sync your social accounts</div>
    <div class="icon-container">
        <!-- Your existing icons and links -->
        <div class="icon">
            <a href="{{ route('facebookRedirect') }}">
                <img class="Add-icon" src="{{ asset('images/Plus Math.png') }}" alt="Add" style="width: 30px; height: 30px" />
            </a>
            <img src="{{ asset('images/Instagram.png') }}" alt="Instagram" />
        </div>
        <div class="icon">
            <a href="{{ route('twitterRedirect') }}">
                <img class="Add-icon" src="{{ asset('images/Plus Math.png') }}" alt="Add" style="width: 30px; height: 30px" />
            </a>
            <img src="{{ asset('images/Twitter.png') }}" alt="LinkedIn" />
        </div>
        <div class="icon">
            <a href="{{ route('linkedinRedirect') }}">
                <img class="Add-icon" src="{{ asset('images/Plus Math.png') }}" alt="Add" style="width: 30px; height: 30px" />
            </a>
            <img src="{{ asset('images/Linkedin.png') }}" alt="LinkedIn" />
        </div>
    </div>
    <!-- New line with a link -->
    <div  class="sub-text2">
        You have to set up a <a href="{{ route('lixSetupPage') }}">Lix account</a><br>
                         after adding a LinkedIn account.
    </div>

    <div class="card p-4 mt-3 ml-4 mb-4">
        <!-- LinkedIn Account -->
        @if(isset($linkedinAccount))
            <div class="second d-flex flex-row mt-2">
                <div class="image mr-2">
                    <img class="rounded-circle" src="{{ $linkedinAccount['linkedin_avatar'] }}" width="60" height="60" alt="linkedin">
                </div>
                <div>
                    <div class="d-flex flex-row mb-1">
                        <i class="fab fa-linkedin ml-2 mr-1" style="color: #0077B5;  font-size: 20px;"></i> <!-- LinkedIn Icon -->

                        <span>{{ $linkedinAccount['linkedin_name'] }}</span>

                    </div>
                    <div>
                      <div class="outlined-box">
                        {{ $linkedinAccount['linkedin_name'] }} 
                      </div>
                    </div>
                </div>
            </div>
            <hr class="line-color" />
        @endif

        <!-- Twitter Account -->
        @if(isset($twitterAccount))
            <div class="second d-flex flex-row mt-2">
                <div class="image mr-2">
                    <img class="rounded-circle" src="{{ $twitterAccount['twitter_avatar'] }}" width="60" height="60" alt="twitter">
                </div>
                <div>
                    <div class="d-flex flex-row mb-1">
                        <i class="fab fa-twitter ml-2 mr-1" style="color: #0077B5; font-size: 20px;"></i> <!-- LinkedIn Icon -->

                        <span>{{ $twitterAccount['twitter_uname'] }}</span>
                    </div>
                    <div>
                        <div class="outlined-box">
                        {{ $twitterAccount['twitter_name'] }} 
                        </div>
                    </div>
                </div>
            </div>
 
        @endif


    </div>

    @if(isset($linkedinAccount) || isset($twitterAccount))
        <div>
            <a class="btn btn-outline-dark btn-sm mb-4" href="{{ route('dashboard') }}">
                DONE
                <i class="fas fa-angle-double-right"></i>
            </a>
        </div>
    @endif






</div>





@endsection
