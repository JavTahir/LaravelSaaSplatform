
document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("sendToDropdown");
    const selectedOptionsContainer = document.getElementById("selectedOptions");
    const charCountLabel = document.getElementById("charCountLabel");
    const textarea = document.getElementById("myTextarea");

    // Define the character limit for the textarea
    let charLimit = null;

    select.addEventListener("change", function () {
        const selectedOption = select.options[select.selectedIndex];
        const selectedValue = selectedOption.value;

        if (selectedValue) {
            addSelectedOption(selectedValue, selectedOption.text);
            select.remove(select.selectedIndex);
        }
    });

    textarea.addEventListener("input", function () {
        const currentLength = textarea.value.length;

        // Check if there is an option associated with the Twitter icon in selectedOptionsContainer
        const hasTwitterOption = Array.from(selectedOptionsContainer.getElementsByClassName("selected-option")).some(optionDiv => {
            const optionValue = optionDiv.dataset.optionValue;
            return optionValue === "option2";
        });

        // Display character limit only if a Twitter option is present
        if (hasTwitterOption) {
            charLimit = 280; // Set the character limit for Twitter
            charCountLabel.style.color = "#555";
            textarea.style.borderColor = "#dbdbdb";
            charCountLabel.textContent = `${currentLength}/${charLimit}`;
        } else {
            charLimit = null; // No character limit for other options
            charCountLabel.textContent = "";
        }
    });

    selectedOptionsContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-icon")) {
            removeSelectedOption(e.target.parentElement);
        }
    });

    const iconMap = {
        option1: "images/Instagram.png",
        option2: "images/Twitter.png",
        option3: "images/LinkedIn.png",
    };

    function addSelectedOption(optionValue, optionText) {
        const optionDiv = document.createElement("div");
        optionDiv.className = "selected-option";

        // Store the optionValue in a data attribute
        optionDiv.dataset.optionValue = optionValue;

        const iconSrc = iconMap[optionValue];
        optionDiv.innerHTML = `<img src="${iconSrc}" alt="Icon"> ${optionText} <img class="remove-icon" src="images/Close.png" alt="Close" onclick="removeSelectedOption(this.parentNode)">`;
        selectedOptionsContainer.appendChild(optionDiv);
    }

    function removeSelectedOption(optionDiv) {
        const optionText = optionDiv.firstChild.nextSibling.textContent;
        const optionValue = optionDiv.dataset.optionValue;

        const option = document.createElement("option");
        option.value = optionValue;
        option.text = optionText;

        // Check if the option already exists in the dropdown before adding it
        let optionExists = false;
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].value === optionValue) {
                optionExists = true;
                break;
            }
        }

        if (!optionExists) {
            select.add(option);
        }

        optionDiv.remove();

        // Reset character limit when an option is removed
        charLimit = null;
    }




    
    const addNewIcon = document.getElementById("addNewIcon");
    const optionsDialog = document.querySelector(".options-dialog");
    const imagesOption = document.getElementById("imagesOption");
    const videosOption = document.getElementById("videosOption");
    const uploadedImagesContainer = document.getElementById("uploadedImagesContainer");

    let uploadLimit = 3;
    let uploadedImageCount = 0;

    addNewIcon.addEventListener("click", () => {
        optionsDialog.style.display = "block";
    });

    optionsDialog.addEventListener("click", (e) => {
        if (e.target.id === "imagesOption") {
            // Handle the Images option
            if (uploadedImageCount < uploadLimit) {
                const input = document.createElement("input");
                input.type = "file";
                input.accept = "image/*";
                input.addEventListener("change", handleImageUpload);
                input.click();
            } else {
                alert("You can only upload up to three images.");
            }
        } else if (e.target.id === "videosOption") {
            // Handle the Videos option
            alert("Video upload functionality is not implemented in this example.");
        }
        optionsDialog.style.display = "none";
    });

    // Close the options dialog if the user clicks outside of it
    document.addEventListener("click", (e) => {
        if (!optionsDialog.contains(e.target) && e.target !== addNewIcon) {
            optionsDialog.style.display = "none";
        }
    });



    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const uploadedImageContainer = document.createElement("div");
                uploadedImageContainer.className = "uploaded-image-container";

                const uploadedImage = document.createElement("img");
                uploadedImage.src = e.target.result;
                uploadedImage.className = "uploadedImage";

                const removeButton = document.createElement("img");
                removeButton.src = "images/Close.png"; // Update the path to your close icon image
                removeButton.className = "remove-uploaded-image";
                removeButton.addEventListener("click", () => {
                    uploadedImageCount--;
                    uploadedImagesContainer.removeChild(uploadedImageContainer);
                    if (uploadedImageCount < uploadLimit) {
                        imagesOption.style.pointerEvents = "auto";
                    }
                });

                uploadedImageContainer.appendChild(uploadedImage);
                uploadedImageContainer.appendChild(removeButton);
                uploadedImagesContainer.appendChild(uploadedImageContainer);

                uploadedImageCount++;
                if (uploadedImageCount >= uploadLimit) {
                    imagesOption.style.pointerEvents = "none";
                }
            };
            reader.readAsDataURL(file);
        }
    }



    const dropdown = document.querySelector(".ddown");
    const dropdownContent = document.getElementById("myDropdown");  // Corrected ID here
    const instagramPost = document.querySelector(".instagram-post");
    const twitterPost = document.querySelector(".twitter-post");

    dropdown.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdownContent.style.display = "block";
    });

    document.addEventListener("click", function (event) {
        if (!dropdown.contains(event.target)) {
            dropdownContent.style.display = "none";
        }
    });

    // Display the default Twitter post
    twitterPost.style.display = "block";
    instagramPost.style.display = "none";

    // Handle the dropdown options
    dropdownContent.addEventListener("click", function (event) {
        if (event.target.tagName === "A") {
            const selectedType = event.target.getAttribute("data-type");
            if (selectedType === "twitter") {
                twitterPost.style.display = "block";
                instagramPost.style .display = "none";
            } else if (selectedType === "instagram") {
                twitterPost.style.display = "none";
                instagramPost.style.display = "block";
            }
            dropdownContent.style.display = "none";
        }
    });




    

    textarea.addEventListener("input", function () {
        // Get the user's input from the textarea
        const userInput = textarea.value;

        // Split the user's input into lines
        const lines = userInput.split('\n');

        // Update the Instagram post caption with the user's input
        const formattedCaption = lines.join('<br>');
        const instagramCaption = document.querySelector(".instagram-post .post-caption");
        instagramCaption.innerHTML = formattedCaption;

        // Update the Twitter post content with the user's input
        const twitterContent = document.querySelector(".twitter-post .post-content");
        twitterContent.innerHTML = formattedCaption;
    });



    

    
// Function to handle "Add New" icon click
addNewIcon.addEventListener("click", () => {
    if (uploadedImageCount >= uploadLimit) {
        alert("Uploads cannot be more than three.");
        optionsDialog.style.display = "none";
    } else {
        optionsDialog.style.display = "block";
    }
});

// Function to handle image upload
function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageUrl = e.target.result;

            // Create an image element for the uploaded image
            const uploadedImage = document.createElement("img");
            uploadedImage.src = imageUrl;
            uploadedImage.className = "uploadedImage";

            // Create a container for the uploaded image with a remove button
            const uploadedImageContainer = document.createElement("div");
            uploadedImageContainer.className = "uploaded-image-container";
            uploadedImageContainer.appendChild(uploadedImage);

            const removeButton = document.createElement("img");
            removeButton.src = "images/Close.png"; // Update the path to your close icon image
            removeButton.className = "remove-uploaded-image";
            removeButton.addEventListener("click", () => {
                uploadedImageCount--;
                uploadedImagesContainer.removeChild(uploadedImageContainer);
                updatePostsImages(); // Update posts when an image is removed
            });

            uploadedImageContainer.appendChild(removeButton);
            uploadedImagesContainer.appendChild(uploadedImageContainer);

            uploadedImageCount++;

            // Display the uploaded image in the post-image area for both Instagram and Twitter
            displayImageInPosts(imageUrl);
        };
        reader.readAsDataURL(file);
    }
}

        // Function to update post images
        function updatePostsImages() {
            // Create an array to store uploaded image URLs
            const uploadedImages = [];

            // Get all the uploaded images
            const uploadedImageElements = document.querySelectorAll('.uploadedImage');
            uploadedImageElements.forEach((img) => {
                uploadedImages.push(img.src);
            });

            // Display the uploaded images in post-image areas for both Instagram and Twitter
            displayImageInPosts(uploadedImages);
        }

    // Function to display the uploaded image in the post-image area for both Instagram and Twitter
    function displayImageInPosts(imageUrl, uploadedImageContainer) {
        const postImage = document.createElement("img");
        postImage.src = imageUrl;

        // Display the image in both Instagram and Twitter post-image areas
        const instagramPostImages = document.querySelectorAll('.instagram-post .post-image');
        const twitterPostImages = document.querySelectorAll('.twitter-post .post-image');
        
        instagramPostImages.forEach(imgArea => {
            imgArea.innerHTML = ''; // Clear existing images
            imgArea.appendChild(postImage.cloneNode(true));
        });
        
        twitterPostImages.forEach(imgArea => {
            imgArea.innerHTML = ''; // Clear existing images
            imgArea.appendChild(postImage.cloneNode(true));
        });
    }




    const postButton = document.getElementById("postButton");
    const DropdownContent = document.getElementById("dropdownContent");

    postButton.addEventListener("click", function () {
        DropdownContent.style.display = DropdownContent.style.display === "block" ? "none" : "block";
    });

    document.addEventListener("click", function (event) {
        if (!postButton.contains(event.target)) {
            DropdownContent.style.display = "none";
        }
    });




    



});



