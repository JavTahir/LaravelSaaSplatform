@extends('dashboard')
@section('title','New Post')
@section('content')

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="{{ asset('js/newpost.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/style_newpost.css') }}" />
<style>
    #imageInput {
      display: none; /* Hide the file input initially */
    }
    #videoInput{
      display: none;
    }
    
  </style>
</head>


<div class="container whole-div d-flex">
<form id="postForm" method="POST"  enctype="multipart/form-data">
  
  @csrf
      <div class="centered-div1" style="height:550px" >
        <div class="inbox-section1">
          <div class="custom-dropdown">
            <select class="custom-select" id="sendToDropdown">
              <!-- Add your options here -->
              <option value="" selected>Send to...</option>
              <option value="option2">Twitter</option>
              <option value="option3">LinkedIn</option>
            </select>
          </div>
          <div class="selected-options" id="selectedOptions">
            <!-- Selected options will be added here dynamically -->
          </div>
          
            
          

   
          <!-- Add this inside the form, after the textarea -->
          <div class="file-input-container">
          
            <input type="file" id="imageInput" name="images[]" accept="image/*" multiple>
          </div>
   
         
          <input type="file" id="videoInput" name="videos[]" accept="video/*">

          <label style="margin-top:90px; margin-left:20px;"><strong>Selected images/video:</strong></label>


          <div style="margin-left:20px;" id="images-name">
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
              <div id="videos-div" class="option">
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
              padding-top: 30px;

            "
            >Overview</label
          >

          <div class="centered-rectangle" >
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
                
                <div class="username">
                    @auth
                      {{auth()->user()->first_name}}
                    @endauth
                </div>
              </div>
              <div class="post-content">
                <p>Reading is a good habbit for u n me. here you go.</p>
              </div>
              <div class="post-image mb-2" id="postImage">
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
           
                  <button type="submit" class="custom-button"id="postButton">
                      Post 
                  </button>
              
              <!-- <div class="custom-dropdown-content" id="dropdownContent">
                <a class="dropdown-item" href="#">Post directly</a>
                <a class="dropdown-item" href="#">Schedule a post</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      </form>
      <!-- Bootstrap Modal for Success Message -->
    
    </div>
  <script>
      document.addEventListener("DOMContentLoaded", function () {
    const MAX_IMAGES = 3;
    let selectedImageFiles = [];

    // Add New button click event
    document.getElementById("addNewIcon").addEventListener("click", function () {
        document.querySelector(".options-dialog").style.display = "block";
    });

    // Images option click event
    document.getElementById("images-div").addEventListener("click", function () {
        // Trigger the click event for the hidden file input
        document.getElementById("imageInput").click();
    });

    // Videos option click event
    document.getElementById("videos-div").addEventListener("click", function () {
        // Trigger the click event for the hidden video input
        document.getElementById("videoInput").click();
    });

    // Image input change event
    document.getElementById("imageInput").addEventListener("change", function (event) {
        handleFileSelection(event.target.files, 'image');
    });

    // Video input change event
    document.getElementById("videoInput").addEventListener("change", function (event) {
        handleFileSelection(event.target.files, 'video');
    });

    // Function to handle selected files
    function handleFileSelection(files, mediaType) {
        const selectedFilesContainer = document.getElementById("images-name");
        selectedFilesContainer.innerHTML = "";

        if (files.length > MAX_IMAGES) {
            alert("Upload up to 3 images only");
            return;
        }

        selectedImageFiles = Array.from(files);
        for (const file of files) {
            const fileNameElement = createFileNameElement(file);
            selectedFilesContainer.appendChild(fileNameElement);
        }

        // Display the first selected media in the post area
        if (selectedImageFiles.length > 0) {
            displayMediaInPosts(selectedImageFiles[0], mediaType);
        }
    }

    // Function to create file name element with remove icon
    function createFileNameElement(file) {
        const fileNameElement = document.createElement("div");
        fileNameElement.textContent = file.name;

        const removeIcon = document.createElement("span");
        removeIcon.innerHTML = "&times;";
        removeIcon.classList.add("remove-icon");

        fileNameElement.appendChild(removeIcon);

        // Add click event to remove the file
        removeIcon.addEventListener("click", function () {
            removeSelectedFile(file);
            fileNameElement.remove();
        });

        return fileNameElement;
    }

    // Function to remove selected file
    function removeSelectedFile(file) {
        selectedImageFiles = selectedImageFiles.filter(f => f !== file);
    }

    // Function to display media in the post area
    function displayMediaInPosts(file, mediaType) {
        // Assuming you have an element with the ID "postImage" for displaying the media
        const postImage = document.getElementById("postImage");
        postImage.innerHTML = ""; // Clear existing content

        const mediaElement = document.createElement(mediaType === 'image' ? 'img' : 'video');
        mediaElement.src = URL.createObjectURL(file);
        mediaElement.alt = "Post Media";
        mediaElement.style.maxWidth = "100%"; // Adjust styling as needed

        postImage.appendChild(mediaElement);
    }


    document.getElementById("postForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    const sendToDropdown = document.getElementById("sendToDropdown");
    const selectedOption = document.querySelector(".selected-option");
    const selectedOptionCount = document.querySelectorAll("#selectedOptions .selected-option").length;

    if ("{{ auth()->user()->plan_name }}") {
      console.log("hi");

      var currentPlanLimit = parseInt("{{ auth()->user()->plan_limit }}");
      console.log(currentPlanLimit);

      if (currentPlanLimit > 0 || currentPlanLimit < 0) {
        if (selectedOptionCount === 2) {
            if (selectedImageFiles.length > 0) {
              this.action = "{{ url('/media-post') }}";
            } else {
              this.action = "{{ url('/simple-post') }}";
            }
          console.log('hi');
        } else if (selectedOption.dataset.optionValue === "option3") {
            if (selectedImageFiles.length > 0) {
              this.action = "{{ url('/post-to-linkedin') }}";
            } else {
              this.action = "{{ url('/linkedin/postform') }}";
            }
        }else if (selectedOption.dataset.optionValue === "option2") {
            if (selectedImageFiles.length > 0) {
              this.action = "{{ url('/post-to-twitter') }}";
            } else {
              this.action = "{{ url('/twitter/postform') }}";
            }

         
        }

         // Decrement the plan_limit by 1
         fetch("{{ url('/decrement-plan-limit') }}", {
              method: 'POST',
              headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Continue with the existing logic based on selectedOption
                console.log('hi');
                // This will submit the form after your logic
                this.submit();
              
              } else {
                toastr.error("You can't post because you have reached your limit today.");
              }
            })
            .catch(error => {
              console.error('Error:', error);
            });
      }else {
        toastr.warning("You have reached your posting limit for today.");
      }
    }else {
      toastr.warning("Subscribe to any plan first.");
    }
   
    
  });
});


</script>



 




    
@endsection()