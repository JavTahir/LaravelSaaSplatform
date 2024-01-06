<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title','Admin Dashboard')</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <!-- Other head elements -->

    <!-- Yield the styles pushed by included files -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />

  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="{{ asset('js/chart_adm.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


   



</head>
<body>
    
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        @include('include.navbar_admin')
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            @include('include.admin_header')
            @if(Route::is('admin.dashboard'))
                @include('include.probizintro')
            @endif

           



            <!-- Conditionally include the search bar for the 'users' page -->

            
            @yield('content')
        </div>
    </div>
    

    
       
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
</html>