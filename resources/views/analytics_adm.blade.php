@extends('dashboard_admin')
@section('title','analytics')



@section('content')
@include('include.filter_adm')
<main class="py-6 bg-surface-secondary">
      <div class="container-fluid">
        <!-- Card stats -->
        <div class="row g-6 mb-6">
          
        <div class="col-xl-3 col-sm-6 col-12"></div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span
                      class="h6 font-semibold text-muted text-sm d-block mb-2"
                      >Probiz Users</span
                    >
                    <span class="h3 font-bold mb-0">{{ $totalUsers }}</span><span>  Users</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-primary bg-gradient text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-linkedin"></i>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </main>

    <script>
        const chartData = @json($chartData);
        console.log( chartData);
    </script>

  

@include('include.userchart')





@endsection()
