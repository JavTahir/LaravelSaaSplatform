<div class="rounded-2 border-bottom mt-5 mr-4 ml-4">
      <div class="container-fluid">
        <div class="mb-npx">
          <div class="row align-items-center">
            
              <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                
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
                  <div class="dropdown-menu" id="filterDropdownMenu" aria-labelledby="filterDropdown">
                                <a class="dropdown-item" href="{{ route('analytics', ['filter' => 'last_7_days']) }}">Last
                                    7 days</a>
                                <a class="dropdown-item" href="{{ route('analytics', ['filter' => 'last_month']) }}">Last
                                    Month</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>