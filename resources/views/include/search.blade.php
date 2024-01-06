<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
</head>
<body>
    <div class="rounded-2 border-bottom mt-5 mr-4 ml-4">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <div class="search-container">
                            <form action="{{ route('searchUsers') }}" method="GET">
                                <input type="text" placeholder="Search.." name="search" id="searchInput" oninput="suggest()" />
                                <button type="submit"><i class="fa fa-search"></i></button>
                                <br>
                                <div id="suggestions"></div>
                            </form>
                            <!-- Display the suggestions in this div -->
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function suggest() {
            var term = document.getElementById("searchInput").value;
            const endpoint = "/search/" + term;

            var suggestionsDiv = document.getElementById("suggestions");
            suggestionsDiv.innerHTML = ""; // Clear previous suggestions

            console.log(endpoint);

            fetch(endpoint)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP RESPONSE STATUS:${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    data.forEach((user) => {
                        const suggestionItem = document.createElement("div");
                        suggestionItem.textContent = user.first_name;
                        suggestionItem.addEventListener("click", function () {
                            // Set the selected suggestion as the input value
                            document.getElementById("searchInput").value = user.first_name;
                            // Clear the suggestions
                            suggestionsDiv.innerHTML = "";
                        });
                        suggestionsDiv.appendChild(suggestionItem);
                    });
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    </script>
</body>
