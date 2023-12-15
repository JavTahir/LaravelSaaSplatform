@extends('dashboard')
@section('title','New Post')
@section('content')

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="{{ asset('js/newpost.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/style_newpost.css') }}" />
</head>

<div class="container d-flex" style="min-height: 100vh">
<form id="postForm" method="POST" action="{{ url('/post-to-linkedin') }}">
  
  @csrf
      <div class="centered-div1">
        <div class="inbox-section1">
          <div class="custom-dropdown">
            <select class="custom-select" id="sendToDropdown">
              <!-- Add your options here -->
              <option value="" selected>Send to...</option>
              <option value="option1">Option 1</option>
              <option value="option2">Option 2</option>
              <option value="option3">Option 3</option>
            </select>
          </div>
          <div class="selected-options" id="selectedOptions">
            <!-- Selected options will be added here dynamically -->
          </div>
          <div class="uploaded-images">
            <div id="uploadedImagesContainer"></div>
          </div>

          <div class="text-area-post">
            <textarea
              id="myTextarea"
              name="content"
              rows="5"
              cols="40"
              placeholder="Type Message here"
              style="background-color: #cabede; width: 100%"
            ></textarea>

            <div class="options-dialog">
              <div id="images-div" class="option">
                <img
                  id="imagesOption"
                  src="images/Photo Gallery.png"
                  alt="Images"
                  style="height: 40px"
                />
              </div>
              <div id="images-div" class="option">
                <img
                  id="videosOption"
                  src="images/Video.png"
                  alt="Videos"
                />
              </div>
            </div>

            <label class="char-count-label" id="charCountLabel">0/0 </label>

            <img
              src="images/Add New.png"
              alt="Custom Icon"
              id="addNewIcon"
              style="margin-top: -90px; width: 28px; margin-right: 30px"
            />
          </div>
        </div>

        <div class="right-section" id="right-section">
          <label
            style="
              font-size: 24px;
              font-family: Arial, Helvetica, sans-serif;
              font-weight: 700;
              margin-left: 30px;
              margin-bottom: -50px;
            "
            >Overview</label
          >

          <div class="centered-rectangle">
            <div class="ddown">
              <div class="dropdown-icon" id="dropdownIcon">
                <img
                  src="images/Down Button.png"
                  alt="Dropdown Icon"
                />
              </div>
              <div class="dropdown-content" id="myDropdown">
                <a href="#" data-type="instagram">Instagram</a>
                <a href="#" data-type="twitter">Twitter</a>
              </div>
            </div>

            <div class="instagram-post" style="display: none">
              <div class="post-header">
                <img
                  class="profile-pic"
                  src="images/profile 1.png"
                  alt="Profile Pic"
                />
                <div class="username">username</div>
              </div>
              <div class="post-image">
                <img src="images/poetry.jpg" alt="Post Image" />
              </div>
              <div class="post-caption">Caption text goes here...</div>
            </div>

            <!-- Twitter Post Layout -->
            <div class="twitter-post">
              <div class="post-header">
                <img
                  class="profile-pic"
                  src="images/profile 1.png"
                  alt="Profile Pic"
                />
                <div class="username">TwitterUser</div>
              </div>
              <div class="post-content">
                <p>Reading is a good habbit for u n me. here you go.</p>
              </div>
              <div class="post-image">
                <img src="images/poetry.jpg" alt="Post Image" />
              </div>
              <div class="post-actions">
                <i class="fas fa-comment"></i> 123
                <i class="fas fa-retweet"></i> 45
                <i class="fas fa-heart"></i> 678
              </div>
            </div>
          </div>

          <div class="post-button">
            <div class="custom-dropdown">
           
                    
                    <button type="submit" class="custom-button" id="postButton">
                        Post <i class="fas fa-caret-up"></i>
                    </button>
              
              <div class="custom-dropdown-content" id="dropdownContent">
                <a class="dropdown-item" href="#">Post directly</a>
                <a class="dropdown-item" href="#">Schedule a post</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>

    
@endsection()