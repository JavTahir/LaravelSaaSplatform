@extends('dashboard')
@section('title','Streams')
@section('content')


<div class="container mt-3">
      <div class="whole-container">
        <div class="row">
          <div class="col-md-4">
            <div class="tweet-card">
              <div class="heading-bar">
                <h3>Explore</h3>
                <button
                  type="button"
                  class="close "
                  aria-label="Close"
                  style=" margin-left:250px; "
                >
                  <span aria-hidden="false">&times;</span>
                </button>
              </div>
              <hr />
              <div class="explore-header mb-3">
                <h5 style="font-weight: bold">Trends for you</h5>
              </div>
              <ul class="hashtag-list">
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#SocialMedia</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#Technology</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#WebDev</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#DevOps</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#Karachi</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#Rescue</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#MoyeMoye</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#LikeAWow</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#Earthquake</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#Miami</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#Tesla</span>
                </li>
                Trending in Pakistan
                <li class="hashtag-list-item">
                  <i class="fab fa-twitter hashtag-icon text-info"></i>
                  <span class="hashtag-text">#BabarAzam</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-md-4">
            <div class="tweet-card">
              <div class="heading-bar">
                <h3>For You</h3>
                <button
                  type="button"
                  class="close "
                  aria-label="Close"
                  style=" margin-left:250px;"
                >
                  <span aria-hidden="false">&times;</span>
                </button>
              </div>
              <hr />
              <div class="d-flex align-items-center">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  class="rounded-circle mr-3"
                />
                <div>
                  <h5 class="user-name">Saad Gondal</h5>
                  <p>@_saadjutt</p>
                </div>
              </div>
              <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit
                mollitia repudiandae cum impedit! A, fugit praesentium enim
                adipisci aliquam, quisquam ipsa molestias laudantium
                exercitationem necessitatibus nulla totam rem nemo quis.
                Voluptatum corrupti atque nulla asperiores et at itaque
                necessitatibus, amet aperiam velit architecto! Eos veniam
                necessitatibus id inventore similique tempora recusandae vel
                quisquam, reiciendis magni ex quia fuga blanditiis repellat,
                nemo perferendis quos deleniti incidunt quo reprehenderit porro.
                Sapiente earum asperiores at facere illum, dolore nulla totam
                sunt deleniti est nobis dolores impedit libero, nisi enim
                voluptas obcaecati eius veritatis temporibus id quod adipisci
                corrupti dolorem quas! Labore reiciendis laboriosam dignissimos,
                rerum optio nisi nostrum tempore soluta maiores, mollitia
                aliquid totam quaerat consequuntur, corporis doloremque iusto
                quo vitae dolores at. Reprehenderit voluptatem molestiae beatae,
                debitis, necessitatibus veniam ipsum magni perspiciatis laborum
                quibusdam unde explicabo commodi est delectus dolorem minus
                itaque iusto officiis sed atque asperiores aliquid. Natus esse
                pariatur distinctio?
              </p>
              <div class="text-muted">
                <i class="far fa-clock"></i> 20 mins ago
              </div>
              <div class="mt-3 d-flex justify-content-start align-items-center">
                <button
                  type="button"
                  class="btn btn-link text-info mr-1"
                  style="width: 50px"
                >
                  <i class="fas fa-retweet"></i>
                  <p>91</p>
                </button>
                <button
                  type="button"
                  class="btn btn-link text-info mr-1"
                  style="width: 50px"
                >
                  <i class="fas fa-reply"></i>
                  <p>43</p>
                </button>
                <button
                  type="button"
                  class="btn btn-link text-info mr-1"
                  style="width: 50px"
                >
                  <i class="fas fa-heart"></i>
                  <p>118</p>
                </button>
                <button
                  type="button"
                  class="btn btn-link text-info mr-1"
                  style="width: 50px"
                >
                  <i class="fas fa-eye"></i>
                  <p>145</p>
                </button>
                <span class="text-muted"></span>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="tweet-card">
              <div class="heading-bar">
                <h3>Notifications</h3>
                <button
                  type="button"
                  class="close "
                  aria-label="Close"
                  style=" margin-left:250px;"
                >
                  <span aria-hidden="false">&times;</span>
                </button>
              </div>
              <hr />
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> liked your tweet</p>
                  <p class="text-muted">20 mins ago</p>
                </div>
                <i class="fas fa-heart text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> mentioned you in a tweet</p>
                  <p class="text-muted">1 hour ago</p>
                </div>
                <i class="fas fa-at text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> mentioned you in a tweet</p>
                  <p class="text-muted">1 hour ago</p>
                </div>
                <i class="fas fa-at text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> liked your tweet</p>
                  <p class="text-muted">1 hour ago</p>
                </div>
                <i class="fas fa-heart text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> liked your tweet</p>
                  <p class="text-muted">20 mins ago</p>
                </div>
                <i class="fas fa-heart text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> mentioned you in a tweet</p>
                  <p class="text-muted">1 hour ago</p>
                </div>
                <i class="fas fa-at text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> mentioned you in a tweet</p>
                  <p class="text-muted">1 hour ago</p>
                </div>
                <i class="fas fa-at text-info"></i>
              </div>
              <div class="notification-card">
                <img
                  src="https://via.placeholder.com/50"
                  alt="Profile Pic"
                  width="50"
                  height="50"
                />
                <div class="notification-content">
                  <p><strong>@username</strong> liked your tweet</p>
                  <p class="text-muted">1 hour ago</p>
                </div>
                <i class="fas fa-heart text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection()