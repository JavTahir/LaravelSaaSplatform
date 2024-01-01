@extends('layout')
@section('title','login')
@section('content')
<div class="container-fluid">
      <div class="row d-flex login-container">
        <div class="col-lg-7 left-container">
          <div class="logo">
            <a href="landingpage.html">
              <img
              src="{{ asset('images/probizlogo2.png') }}"
              alt="Logo"
                style="width: 150px"
              />
            </a>
          </div>
          <div class="row">
            <!-- Text on Left -->
            <div class="col-md-6">
              <div class="left-content">
                <h2>Probiz - One Post Across Platforms!</h2>
                <p>
                Unleash Your Social Presence, One Post Across Platforms!.
                  Streamline your social presence with ease and efficiency.
                </p>
                <img
                src="{{ asset('images/glare-isometric.png') }}"
                  alt="Logo"
                  style="width: 250px; padding-top: 30px"
                />
              </div>
            </div>
            <!-- Video on Right -->
            <div class="col-md-6 video-container ">
              <video width="85%" height="80%" autoplay muted loop>
              <source src="{{ asset('videos/login.mp4') }}" type="video/mp4" />
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>

        <div class="col-lg-5 right-container">
          <h2 class="mb-4 mt-5">Sign In</h2>
            @if($errors->any())
                <div class="mt-2 mb-2 error_div">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger mt-2 mb-2 error_div">{{session('error')}}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success mt-2 mb-2 error_div ">{{session('success')}}</div>
            @endif

          <form onsubmit="return validateForm()" action="{{route('login.post')}}" method="post">
            @csrf
            <div class="form-group mb-4">
              <label for="email" class="form-label mb-1">Email</label>
              <input
                type="text"
                class="form-control"
                id="email"
                placeholder="Enter Email"
                name="email"
              />
              <span id="emailError" class="error"></span>
            </div>

            <div class="form-group mb-3">
              <label for="password" class="form-label mb-1">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Enter password"
                name="password"
              />
              <p style="width: 80%">
                <span id="passwordError" class="error"></span>
              </p>
            </div>


            <button type="submit" class="btn btn-primary mt-4 mb-4">Sign in</button>

            <p class="account">
              Don't have an account?
              <a href="{{route('signup')}}" class="text-primary">Sign up now</a>
            </p>
          </form>

          <div class="mt-4 text-center agreement">
            <p class="text-muted" id="#agreement">
              By selecting Sign in, I agree to Probiz's Terms, including the
              payment terms, and Privacy Policy
            </p>
          </div>

        </div>
      </div>
    </div>

@endsection()
