document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-input");
    const userItems = document.querySelectorAll(".user-item");
  
    searchInput.addEventListener("input", function () {
      const searchQuery = searchInput.value.toLowerCase();
  
      userItems.forEach(function (item) {
        const userName = item
          .querySelector(".user-name")
          .textContent.toLowerCase();
        if (userName.includes(searchQuery)) {
          item.style.display = "flex"; // Display matching items
        } else {
          item.style.display = "none"; // Hide non-matching items
        }
      });
    });
  
    // Array to store checked user items
    const checkedItems = [];
  
    userItems.forEach(function (item) {
      const addIcon = item.querySelector(".add-icon");
      const profileImage = item.querySelector(".profile-image");
      const userName = item.querySelector(".user-name").textContent;
  
      addIcon.addEventListener("click", function () {
        if (addIcon.getAttribute("alt") === "Add") {
          addIcon.setAttribute("src", "images/Checkmark.png");
          addIcon.setAttribute("alt", "Check");
          addIcon.style.width = "20px"; // Set width to 20px
          addIcon.style.height = "20px"; // Set height to 20px
  
          checkedItems.push({
            profileImage: profileImage.getAttribute("src"),
            userName: userName,
          });
        } else {
          addIcon.setAttribute("src", "images/Plus.png");
          addIcon.setAttribute("alt", "Add");
          const index = checkedItems.findIndex(
            (item) => item.userName === userName
          );
          if (index !== -1) {
            checkedItems.splice(index, 1);
          }
        }
      });
    });
  
    const rightArrow = document.querySelector(".right-arrow");
rightArrow.addEventListener("click", function () {
    if (checkedItems.length === 0) {
        alert("Please select at least one item before proceeding.");
    } else {
        // Build a URL to navigate to the 'pagesadded' route and pass the checked items data
        const url = `/pagesadded?data=${encodeURIComponent(JSON.stringify(checkedItems))}`;
        window.location.href = url;
    }
});
  });
  