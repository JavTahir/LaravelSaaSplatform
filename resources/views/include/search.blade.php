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
                <form action="/action_page.php">
                  <input type="text" placeholder="Search.." name="search" />
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div>
            </div>
            <!-- Actions -->
            <div class="col-sm-6 col-12 text-sm-end">
              <div class="mx-n1">
                <div class="dropdown">
                  <button
                    class="dropdown-toggle filter-btn"
                    type="button"
                    id="filterDropdown"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    Filter
                  </button>
                  <div
                    class="dropdown-menu"
                    id="filterDropdownMenu"
                    aria-labelledby="filterDropdown"
                  >
                    <a class="dropdown-item" href="#">All</a>
                    <a class="dropdown-item" href="#">Filter 1</a>
                    <a class="dropdown-item" href="#">Filter 2</a>
                    <a class="dropdown-item" href="#">Filter 3</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
