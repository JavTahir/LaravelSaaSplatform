<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    <link
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
      body {
        background-color: rgb(255, 255, 255);
        font-family: "Montserrat", sans-serif;
        
      }

      nav{
        font-weight:700;
      }


      .header_shadow{
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
      }
      .custom-button {
        color:rgb(0, 0, 0);
        border-color:  rgb(182, 135, 193);

        border-radius: 40px;
        border-width: 2px;
        font-weight:500;
        font-size: 14px;
        height: 40px;
        width: 120px;
        text-align: center;
      }

      .custom-button:hover {

        background-color:rgb(182, 135, 193);
        color: white;
        font-weight: 500;

      }

      .custom-toggler.navbar-toggler {
            border-width: 0;
            
        }
      .bg_white{
        background-color: rgb(255, 255, 255);
        


      }

      .logo{
        width:140px ;
        height:50px;

      }


      #arrow {
        background: linear-gradient(
          to right,
          rgb(201, 153, 215),
          rgb(182, 135, 193)
        );
        display: inline-block;
        -webkit-background-clip: text;
        color: transparent;
        text-decoration: none;
        font-size: 40px; /* Adjust this to increase or decrease the size of the arrow icon */
      }

      .banner_heading {
        font-size: 40px;
        font-family: "Montserrat", sans-serif;
        font-weight: bold;
        background-image: linear-gradient(
          to right,
          rgb(201, 153, 215),
          rgb(182, 135, 193)
        );
        color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
      }

      .grey_color{
        color: rgba(60, 57, 57, 0.632);
      }

      .white-color {
        color: rgb(255, 255, 255);
      }

      .banner_description {
        font-family: "Montserrat", sans-serif;
        color: Gray;
        font-size: 14px;
      }

      .center_oval {
        width: 100%;
        height: auto;
        background: radial-gradient(
          circle at center,rgba(186, 241, 245, 0.714),rgb(225, 184, 241)
          

        );
        box-shadow: 0px 4px 4px rgba(192, 183, 231, 0.01);
        border-radius: 90px;
        padding: 20px 0;
        position: relative;

        
        
        
      }

      .center_oval h3{
        color: rgb(255, 255, 255); 
        font-weight: bolder;
      }

      .LocationIcon {
        width: 70px;
        height: 48px;
        position: relative;
        margin: 0 auto; /* to center it in its parent column */

      }

      .separator {
        border-left: 2px rgba(203, 203, 205, 0.541) solid;
        height: 75%; /* Adjust the height of the separator */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 33.33%; /* To position the first separator */
      }

      .second-separator {
        border-left: 2px rgba(203, 203, 205, 0.541) solid;
        height: 75%; /* Adjust the height of the separator */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 66.66%; /* To position the second separator */
      }

      .other_heading {
        font-size: 36px;
        font-weight: bold;
        
        color: rgba(60, 57, 57, 0.789);

        -webkit-background-clip: text;
        background-clip: text;
      }

      .other_para {
        font-size: 28px;
        font-weight: lighter;
        color: rgba(60, 57, 57, 0.789);
      }

      .btn-light {
        background: linear-gradient(90deg, #8176af 0%, #c0b7e8 100%);
        color: #343045;
        border: none;
      }

      .slide_image{
        animation: slideIn 1s ease-in-out;
      }

      #aboutimage{
        /* animation: slideInn 1s ease-in-out; */
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
      }



      #aboutimage.active {
          opacity: 1;
          transform: translateY(0);
        }

      @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
      }

      @keyframes slideInn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
      }

      .custom-box {
        height: 500px;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;        border-radius: 1%;
        padding: 20px;
      }

      .custom-box:hover{
        background: radial-gradient(
          circle at center,rgb(224, 193, 236),
          rgba(186, 241, 245, 0.714)

        );
        color: white;

      }

      .circle-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 20px auto; /* Center horizontally */
        text-align: center;

      }
      .circle-placeholder img{
        border-radius: 50%;
      }




      .box-content {
        margin-top: 30px;
        text-align: center;
      }

      .price_heading {
        font-size: 28px;
        font-weight: bold;
        color: rgba(60, 57, 57, 0.789);
        -webkit-background-clip: text;
        background-clip: text;
      }

      .price_desc {
        font-size: 12px;
        font-weight: 400;
        color: #000000c1;
      }

      /* Add this CSS to your stylesheet or in the head section of your HTML */

  .perks{
        padding: 30px;
      }
    .perks-list {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }

    .perks-list li {
      margin-bottom: 8px; /* Adjust the spacing between list items */
    }

    .perks-list li:before {
      content: ''; /* No bullet point */
    }

    .btn-subscribe {
      margin-top: 20px; /* Adjust the spacing between the perks list and the button */
      width: 100%;
      background: linear-gradient(to right, rgb(201, 153, 215), rgb(182, 135, 193));
      border:0;
      font-weight: 400;    

    }

    .btn-subscribe:hover{
      background: linear-gradient(to right, rgb(201, 153, 215), rgb(84, 58, 90));
      font-weight: 500;


    }


      ul {
        margin: 0px;
        padding: 0px;
      }
      .footer-section {
        position: relative;
        font-family: "Montserrat", sans-serif;
      }
      .footer-cta {
        border-bottom: 1px solid #373636;
      }
      .single-cta i {
        color: #ff5e14;
        font-size: 30px;
        float: left;
        margin-top: 8px;
      }
      .cta-text {
        padding-left: 15px;
        display: inline-block;
      }
      .cta-text h4 {
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 2px;
      }
      .cta-text span {
        color: #757575;
        font-size: 15px;
      }
      .footer-content {
        position: relative;
        z-index: 2;
      }
      .footer-pattern img {
        position: absolute;
        top: 0;
        left: 0;
        height: 330px;
        background-size: cover;
        background-position: 100% 100%;
      }
      .footer-logo {
        margin-bottom: 30px;
      }
      .footer-logo img {
          max-width: 200px;
      }
      .footer-text p {
        margin-bottom: 14px;
        font-size: 14px;
            color: #7e7e7e;
        line-height: 28px;
      }
      .footer-social-icon span {
        color: #fff;
        display: block;
        font-size: 20px;
        font-weight: 700;
        font-family: "Montserrat", sans-serif;
        margin-bottom: 20px;
      }
      .footer-social-icon a {
        color: #fff;
        font-size: 16px;
        margin-right: 15px;
      }
      .footer-social-icon i {
        height: 40px;
        width: 40px;
        text-align: center;
        line-height: 38px;
        border-radius: 50%;
      }
      .socials-bg{
        background: rgba(192, 183, 232, 1);
        color: #191721;
      }
      .footer-widget-heading h3 {
        color: rgba(60, 57, 57, 0.789);
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 40px;
        position: relative;
      }
      .footer-widget-heading h3::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: -15px;
        height: 2px;
        width: 50px;
        background-image: linear-gradient(
          to right,
          rgb(201, 153, 215),
          rgb(182, 135, 193)
        );
      }
      .footer-widget ul li {
        display: block;
        width: 50%;
        margin-bottom: 12px;
      }
      .footer-widget ul li a:hover{
        color:rgb(211, 17, 211);
      }
      .footer-widget ul li a {
        color: #878787;
        text-transform: capitalize;
      }
      .subscribe-form {
        position: relative;
        overflow: hidden;
      }
      .subscribe-form input {
        width: 100%;
        padding: 14px 28px;
        background: #2E2E2E;
        border: 1px solid #2E2E2E;
        color: #fff;
      }
      .subscribe-form button {
          position: absolute;
          right: 0;
          background: #ff5e14;
          padding: 13px 20px;
          border: 1px solid #ff5e14;
          top: 0;
      }
      .subscribe-form button i {
        color: #fff;
        font-size: 22px;
        transform: rotate(-6deg);
      }
      .copyright-area{
        padding: 25px 0;
        font-family: "Montserrat", sans-serif;
      }
      .copyright-text p {
        margin: 0;
        font-size: 14px;
        color: #cbbfbf;
      }
      .copyright-text p a{
        color: #ff5e14;
      }
      .footer-menu li {
        display: inline-block;
        margin-left: 20px;
        color: #cbbfbf;
      }
      .footer-menu li:hover a{
        color:rgb(211, 17, 211);

      }
      .footer-menu li a {
        font-size: 14px;
        color: #878787;
      }

      .divider-vertical {
          border-left: 3px solid #62606e;
          height: 200px;
        }

      /* @media (max-width: 768px) {

        #arrowvertical{
          transform: rotate(90deg);
          height: 20px;

        }
          
      } */

 
    </style>
  </head>

  <body>
    <nav class="navbar   bg_white navbar-expand-lg navbar-dark  px-5 sticky-top header_shadow">
      <a class="navbar-brand" href="#">
          <img src="{{ asset('images/probizlogo2.png') }}"  class="d-inline-block logo align-top" alt="" />
      </a>
      <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item active mr-4">
                <a class="nav-link" href="#" style="color: rgb(0, 0, 0)">HOME <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item mr-4">
                <a class="nav-link" href="#about" style="color: rgb(0, 0, 0)">ABOUT</a>
            </li>
            <li class="nav-item mr-4">
                <a class="nav-link" href="#pricing" style="color: rgb(0, 0, 0)">PRICING</a>
            </li>

            <li class="nav-item mr-4">
                <a class="nav-link" href="#contact" style="color: rgb(0, 0, 0)">CONTACT US</a>
            </li>
          </ul>
          <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center mt-5 mt-lg-0">
              <button class="btn custom-button ml-0  mb-3 mb-lg-0 mr-lg-3" style="border-color: linear-gradient(to right, rgb(201, 153, 215), rgb(182, 135, 193));" type="submit">CONTACT US</button>
              <button class="btn custom-button" style="background: linear-gradient(to right, rgb(201, 153, 215), rgb(182, 135, 193)); border-width: 0px; color: black;" href="{{route('login')}}" type="submit">
              <a href="{{route('signup')}}" style="color:black; text-decoration: none;" >
              JOIN NOW
              </a>
              
              </button>
          </div>
      </div>
</nav>

<!--  banner section -->
    <section class="py-lg-16 py-8 mt-5">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row align-items-center">
          <!-- col -->
          <div class="col-lg-5 mb-6 mb-lg-0">
            <!-- heading -->
            <h1 class="banner_heading mb-5">
              <i
                class="fe fe-check icon-xxs icon-shape bg-light-success text-success rounded-circle me-2"
              ></i
              >Probiz  
              <span class="grey_color">- Unleash Your Social Presence, </span>Across Platforms!
            </h1>

            <p class="pe-lg-10 mb-5 banner_description">
            ProBiz is a comprehensive social media management platform that empowers users to effortlessly connect and post across multiple social platforms simultaneously. Streamline your social presence with ease and efficiency.
            </p>
            <!-- btn -->
            <div class="d-flex align-items-center">
              <button
                href="#"
                class="btn custom-button my-2 my-sm-0 m-3"
                style="
                  background: linear-gradient(
                    to right,
                    rgb(201, 153, 215),
                    rgb(182, 135, 193)
                  );
                  border-width: 0px;
                  color: black;
                  width: 150px;
                "
              >
              <a href="{{route('signup')}}" style="color:black; text-decoration: none;" >
              JOIN NOW
              </a>              </button>
              <a id="arrow" href="{{route('signup')}}" class="my-2 my-sm-0 m-3">
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <!-- col -->
          <div class="col-lg-5 d-flex justify-content-center">
            <!-- images -->
            <div class="d-none d-lg-block position-relative w-100 h-100">
              <img
                src="{{ asset('images/bannerimage.png') }}"
                alt=""
                class="img-fluid slide_image"
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- socials -->
    <div class="d-none d-lg-block container mt-5 mb-5 ">
      <div class="center_oval py-3 row align-items-center">
        <!-- Learn with Us Section -->
        <div class="col-md-4 text-center">
          <div class="LocationIcon">
            <!-- Placeholder for an appropriate learning icon. You can replace it with a <img> tag or a <div> with a background-image. -->

            <img
              src="https://img.icons8.com/color/48/linkedin.png"
              alt="linkedin"
            />
          </div>
          <h3 class="mt-2">Linkedin</h3>
          <p style="color: rgba(0, 0, 0, 0.765)">
            Access webinars, tutorials, and guides.
          </p>
        </div>

        <!-- Separator -->
        <div class="separator"></div>

        <!-- Need Help? Section -->
        <div class="col-md-4 text-center">
          <div class="LocationIcon">
            <!-- Placeholder for an appropriate help/support icon. -->

            <img
              src="https://img.icons8.com/fluency/48/twitter.png"
              alt="twitter"
            />
          </div>
          <h3 class="mt-2">Twitter</h3>
          <p style="color:rgba(0, 0, 0, 0.765)">
            Call our 24/7 support at (110) 1111-1010.
          </p>
        </div>

        <!-- Separator -->
        <div class="second-separator"></div>

        <!-- Stay Connected Section -->
        <div class="col-md-4 text-center">
          <div class="LocationIcon">
            <!-- Placeholder for an appropriate connection icon. -->

            <img
              src="https://img.icons8.com/color/48/facebook-new.png"
              alt="facebook-new"
            />
          </div>
          <h3 class="mt-2">Facebook</h3>
          <p style="color: rgba(0, 0, 0, 0.765)">
            engage with us on social media.
          </p>
        </div>
      </div>
    </div>

    <!-- intro Section -->
    <section>
      <div class="container mt-5 mb-5" style="padding-top: 20px">
        <div class="row">
          <!-- Left Side Content -->
          <div class="col-lg-3">
            <h1 class="other_heading">INTRODUCTION</h1>
            <p class="other_para">TO PROBIZ</p>
          </div>

          <!-- Center Content - Larger Arrow -->
          <div class="col-lg-3 mt-4 d-none d-lg-block">
            <a href="#" class="d-inline-block ">
              <!-- Adjusted the font-size for larger arrow -->
              <img
                src="{{ asset('images/arrow.png') }}"
                alt="long-arrow-right--v1"
                             />
            </a>
          </div>

          <!-- Right Side Content -->
          <div class="col-lg-5">
            <p style="color: GRAY">
            Welcome to ProBiz, where managing your social media presence becomes a breeze. Our platform is designed to simplify the complexities of handling various social media accounts, allowing you to focus on what matters most—creating meaningful content and engaging with your audience.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- about me -->
    <section class="py-lg-16 py-8 mt-5 mb-5" id="about">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row align-items-center">
          <!-- Image Part on the Left Side -->
          <div class="col-lg-4 d-flex justify-content-center mb-6 mb-lg-0">
            <!-- images -->
            <div class="position-relative w-100 h-100">
              <img
                src="{{ asset('images/aboutme.png') }}"
                alt=""
                class="img-fluid slide_about"
                id="aboutimage"
              />
            </div>
          </div>
          <div class="col-lg-2"></div>
          <!-- Text Part on the Right Side -->
          <div class="col-lg-6">
            <!-- heading -->
            <div>
              <h1 class="other_heading ">ABOUT</h1>
              <p class="other_para">HOOTSUITE</p>
            </div>

            <p class="pe-lg-10 mb-5" style="color: gray">
            At ProBiz, we are driven by the belief that managing your online presence should be intuitive and seamless. Our dedicated team has crafted a user-friendly experience that caters to the needs of both individuals and businesses. With ProBiz, you gain control, insight, and efficiency in navigating the dynamic world of social media.
            </p>

            
          </div>
        </div>
      </div>
    </section>

    <!-- why section-->
    <section>
      <div class="container mt-5 mb-5" style="padding-top: 20px">
        <div class="row">
          <!-- Left Side Content -->
          <div class="col-lg-3">
            <h1 class="other_heading">WHY APP ?</h1>
            <p class="other_para">WHY PROBIZ</p>
          </div>

          <!-- Center Content - Larger Arrow -->
          <div class="col-lg-3 mt-4 d-none d-lg-block">
            <a href="#" class="d-inline-block">
              <!-- Adjusted the font-size for larger arrow -->
              <img
                src="{{ asset('images/arrow.png') }}"
                alt="long-arrow-right--v1"
              />
            </a>
          </div>

          <!-- Right Side Content -->
          <div class="col-lg-5">
            <p style="color: GRAY">

            Effortlessly streamline your social media strategy with our unified posting platform, enabling you to post seamlessly across multiple platforms in one go. Access valuable insights through intuitive analytics, track performance, and engage with your audience effortlessly.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- pricing section-->
    <section>
      <div class="container" style="margin-top:150px; margin-bottom:150px;" id="pricing">
        <div class="row">
          <!-- First box -->
          <div class="col-md-4">
            <div class="custom-box">
              <div class="box-content" style="margin-top: 5px;">
                <h1 class="price_heading">Gold Plan</h1>
                <p class="price_desc">Limited Access upto 15 posts</p>
              </div>
              <div class="circle-placeholder">
                <img
                  src="{{ asset('images/goldplan.png') }}"
                  alt=""
                  style="width:150px; height: 150px;"
                />
              </div>
              <div  class="perks">

                <ul class="perks-list">
                  <li><i class="fa fa-check-circle"></i> 15 posts</li>
                  <li><i class="fa fa-check-circle"></i> Social Analytics</li>
                  <li><i class="fa fa-check-circle"></i> Customer Support</li>
                </ul>
                <!-- Subscription button -->
                <button class="btn btn-primary btn-subscribe">Subscribe</button>
              </div>
            </div>
          </div>

          <!-- Second box -->
          <div class="col-md-4">
            <div class="custom-box">
              <div class="box-content" style="margin-top: 5px;">
                <h1 class="price_heading">Premium Plan</h1>
                <p class="price_desc">Unlimited posts & handling</p>
              </div>
              <div class="circle-placeholder">
                <img
                  src="{{ asset('images/platinumplan.png') }}"
                  alt=""
                  style="width: 150px; height: 150px;"             />
              </div>
              <div  class="perks">

                <ul class="perks-list">
                  <li><i class="fa fa-check-circle"></i> Unlimited posts</li>
                  <li><i class="fa fa-check-circle"></i> Social Analytics</li>
                  <li><i class="fa fa-check-circle"></i> Customer Support</li>
                </ul>
                <!-- Subscription button -->
                <button class="btn btn-primary btn-subscribe">Subscribe</button>
              </div>
            </div>
          </div>

          <!-- Third box -->
          <div class="col-md-4">
            <div class="custom-box">
              <div class="box-content" style="margin-top: 5px;">
                <h1 class="price_heading">Bronze Plan</h1>
                <p class="price_desc">Limited Access upto 5 posts</p>
              </div>
              <div class="circle-placeholder">
                <img
                  src="{{ asset('images/bronzeplan.jpg') }}"
                  alt=""
                  style="width: 130px; height: 130px; border-radius: 50%"
                />
              </div>
              <div  class="perks">

                <ul class="perks-list">
                  <li><i class="fa fa-check-circle"></i> Upto 5 posts</li>
                  <li><i class="fa fa-check-circle"></i> Social Analytics </li>
                  <li><i class="fa fa-check-circle"></i> Customer Support</li>
                </ul>
                <!-- Subscription button -->
                <button class="btn btn-primary btn-subscribe">Subscribe</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- footer -->
    <footer class="footer-section" id="contact">
      <div class="container">
          <div class="footer-content pt-5 pb-5">
              <div class="row">
                  <div class="col-xl-4 col-lg-4 mb-50">
                      <div class="footer-widget">
                          <div class="footer-logo">
                              <a href="/dist/User/login.html"><img src="{{ asset('images/probizlogo2.png') }}" class="img-fluid" alt="logo"></a>
                          </div>

                      </div>
                  </div>
                <div class=" col-1 divider-vertical d-none d-lg-block"></div>
                  <div class="col-xl-2 col-lg-2 col-md-2 mb-30">
                      <div class="footer-widget">
                          <div class="footer-widget-heading">
                              <h3>Useful Links</h3>
                          </div>
                          <ul>
                              <li><a href="#">Home</a></li>
                              <li><a href="#">about</a></li>
                              <li><a href="#">services</a></li>
                              <li><a href="#">portfolio</a></li>

                 
                          </ul>
                      </div>
                  </div>
                  <div class=" col-1 divider-vertical d-none d-lg-block"></div>
                  <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                      <div class="footer-widget">
                          <div class="footer-widget-heading">
                              <h3>Socials</h3>
                          </div>


                          <div class="footer-social-icon">
                              <a href="#"><i class="fab fa-facebook-f socials-bg"></i></a>
                              <a href="#"><i class="fab fa-twitter socials-bg"></i></a>
                              <a href="#"><i class="fab fa-google-plus-g socials-bg"></i></a>
                              <a href="#"><i class="fab fa-linkedin-in socials-bg"></i></a>
                              <a href="#"><i class="fab fa-instagram socials-bg"></i></a>
                          </div>
                        
                    </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="copyright-area">
          <div class="container">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                      <div class="copyright-text">
                          <p>Copyright &copy; 2023, All Right Reserved </p>
                      </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                      <div class="footer-menu">
                          <ul>
                              <li><a href="#">Home</a></li>
                              <li><a href="#">Terms</a></li>
                              <li><a href="#">Privacy</a></li>
                              <li><a href="#">Policy</a></li>
                              <li><a href="#">Contact</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const imageContainer = document.getElementById("aboutimage");
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(imageContainer);
    });
</script>

  </body>
</html>
