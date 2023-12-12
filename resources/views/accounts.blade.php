<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','AddAccounts')</title>
  <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/style_main.css') }}" />
   <!-- Inside the head section of your Blade template -->
    <script src="{{ asset('js/addpages.js') }}"></script>

</head>
<body>
  @yield('content')

  <script>
      document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const data = urlParams.get("data");

        if (data) {
          // Parse the data back from the URL parameter
          const checkedItems = JSON.parse(decodeURIComponent(data));

          const container = document.querySelector(".user-items-container");

          checkedItems.forEach(function (item) {
            const userItem = document.createElement("div");
            userItem.className = "user-item";
            userItem.innerHTML = `
                        <img src="${item.profileImage}" class="profile-image" alt="${item.userName}">
                        <div class="user-name">${item.userName}</div>
                        <img src="images/Cancel.png" class="cancel-icon" alt="Cancel">
                    `;

            container.appendChild(userItem);
          });

          // Add a click event listener to each cancel icon
          const cancelIcons = document.querySelectorAll(".cancel-icon");
          cancelIcons.forEach(function (icon) {
            icon.addEventListener("click", function () {
              // Get the parent element (user-item) of the clicked icon and remove it
              const userItem = icon.parentElement;
              userItem.remove();
            });
          });
        }
      });
    </script>
</body>
</html>