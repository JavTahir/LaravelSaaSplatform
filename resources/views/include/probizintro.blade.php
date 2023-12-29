
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Combined Page</title>
    <!-- Bootstrap CSS link -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <style>
      /* Custom Styles */

      /* Custom card styles */
      .custom-card {
        width: 700px;
        height: 300px;
        border-radius: 15px;
        background-color: #dac7f1;
        margin-top: 50px;
      }

      .custom-card-columns {
        height: 100%;
      }

      .custom-card-text {
        padding-top: 40px;
        padding-left: 40px;
      }

      .custom-card-text p {
        margin-top: 30px;
        margin-bottom: 20px;
        color: #333333bb;
      }

      .custom-card-text h3 {
        color: #333333f2;
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 24px;
      }

      .custom-button {
        border-radius: 8px;
      }

      .custom-image {
        object-fit: cover;
        border-radius: 15px;
        margin-left: 20px;
        margin-top: 20px;
      }

      /* Custom styles for the carousel */
      #customCarousel {
        max-width: 340px;
        height: 240px;
        margin-top: 50px;
        margin-left: 160px;
        border-radius: 15px;
        

      }

      #customCarousel .carousel-inner {
        border-radius: 15px;
        overflow: hidden;
      }

      #customCarousel .carousel-item {
        text-align: center;
        position: relative;


      }

      #customCarousel h3 {
        font-size: 24px;
        margin-bottom: 5px;
        font-weight: 700;
        position: absolute;
        top: 60%;
        left: 30%;
        transform: translateX(-50%);
        width: 100%;
        color: rgb(255, 230, 0);
      }

      #customCarousel p {
        font-size: 16px;
        margin-bottom: 20px;
        position: absolute;
        bottom: 35px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        font-weight: 500;
        color: rgb(254, 254, 254);
      }

      #customCarousel img {
        width: 100%;
        height: 300px;
        border-radius: 8px;
        opacity: 0.8;
        position: relative;

      }

      #customCarousel .carousel-inner .dark-fade {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 120px; /* Adjust the height of the dark fade as needed */
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
        }



    </style>
  </head>

    <div class="container">
      <div class="row">
        <!-- Bootstrap Card and Carousel in the same row -->
        <div class="col-md-6">
          <div class="card custom-card">
            <div class="row no-gutters custom-card-columns">
              <!-- Left Column with Text -->
              <div class="col-md-6">
                <div class="card-body custom-card-text">
                  <h3 class="card-title">Welcome back 👋</h3>
                  @if(auth()->user())
                    <h3 class="card-title">{{auth()->user()->first_name}}</h3>
                  @endif
                  <p class="card-text">
                  Save time by posting to multiple platforms in one go.
                  Trust in a secure environment for managing your socials.
                  </p>
                  <!-- <button class="btn btn-primary custom-button">
                    Click me
                  </button> -->
                </div>
              </div>
              <!-- Right Column with Image -->
              <div class="col-md-6">
                <img
                  src="{{ asset('images/vector.png') }}"
                  alt="Placeholder Image"
                  class="card-img custom-image"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap Carousel -->
        <div class="col-md-6">
          <div
            id="customCarousel"
            class="carousel"
            data-ride="carousel"
            data-interval="2000"
          >
            <div class="carousel-inner">
              <!-- Slide 1 -->
              <div class="carousel-item active">
                <img src="{{ asset('images/crousel1.jpg') }}" alt="Image 1" />
                <div class="dark-fade"></div>

                <h3>Post in One go</h3>
                <p>post to multiple accounts in one click</p>
              </div>
              <div class="carousel-item">
                <img src="{{ asset('images/crousel2.jpg') }}" alt="Image 2" />
                <div class="dark-fade"></div>

              </div>
              <div class="carousel-item">
                <img src="{{ asset('images/crousel3.jpg') }}" alt="Image 3" />
                <div class="dark-fade"></div>

              </div>
            <!-- Navigation Arrows -->
            <a
              class="carousel-control-prev"
              href="#customCarousel"
              role="button"
              data-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Previous</span>
            </a>
            <a
              class="carousel-control-next"
              href="#customCarousel"
              role="button"
              data-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
