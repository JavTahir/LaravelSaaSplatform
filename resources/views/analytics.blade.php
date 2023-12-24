@extends('dashboard')
@section('title','analytics')



@section('content')
@include('include.filter')
<main class="py-6 bg-surface-secondary">
      <div class="container-fluid">
        <!-- Card stats -->
        <div class="row g-6 mb-6">
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span
                      class="h6 font-semibold text-muted text-sm d-block mb-2"
                      >Facebook</span
                    >
                    <span class="h3 font-bold mb-0">987</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-primary text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-facebook"></i>
                    </div>
                  </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                  <span
                    class="badge badge-pill bg-soft-success text-success me-2"
                  >
                    <i class="bi bi-arrow-up me-1"></i>13%
                  </span>
                  <span class="text-nowrap text-xs text-muted"
                    >Since last month</span
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span
                      class="h6 font-semibold text-muted text-sm d-block mb-2"
                      >Instagram</span
                    >
                    <span class="h3 font-bold mb-0">215</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-tertiary text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-instagram"></i>
                    </div>
                  </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                  <span
                    class="badge badge-pill bg-soft-success text-success me-2"
                  >
                    <i class="bi bi-arrow-up me-1"></i>30%
                  </span>
                  <span class="text-nowrap text-xs text-muted"
                    >Since last month</span
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span
                      class="h6 font-semibold text-muted text-sm d-block mb-2"
                      >Linkedin</span
                    >
                    <span class="h3 font-bold mb-0">1400</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-primary bg-gradient text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-linkedin"></i>
                    </div>
                  </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                  <span
                    class="badge badge-pill bg-soft-danger text-danger me-2"
                  >
                    <i class="bi bi-arrow-down me-1"></i>-5%
                  </span>
                  <span class="text-nowrap text-xs text-muted"
                    >Since last month</span
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span
                      class="h6 font-semibold text-muted text-sm d-block mb-2"
                      >Twitter</span
                    >
                    <span class="h3 font-bold mb-0">950</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-black text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-twitter"></i>
                    </div>
                  </div>
                </div>
                <div class="mt-2 mb-0 text-sm">
                  <span
                    class="badge badge-pill bg-soft-success text-success me-2"
                  >
                    <i class="bi bi-arrow-up me-1"></i>10%
                  </span>
                  <span class="text-nowrap text-xs text-muted"
                    >Since last month</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

@include('include.chart')




@endsection()
