@extends('dashboard')
@section('title','analytics')



@section('content')
@include('include.filter')
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
                      >Linkedin</span
                    >
                    <span class="h3 font-bold mb-0">{{ $linkedinConnectionsCount }}</span><span> Followers</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-primary bg-gradient text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-linkedin"></i>
                    </div>
                  </div>
                </div>
                <div class="mt-2 mb-0 text-sm"  >
                  @if($linkedinConnectionsGrowth > 0)
                      <span class="badge badge-pill bg-soft-success text-success me-2">
                          <i class="bi bi-arrow-up me-1"></i>{{ $linkedinConnectionsGrowth }}%
                      </span>
                    <span class="text-nowrap text-xs text-muted" >{{ $timeRange }}</span>
                  
                    @elseif($linkedinConnectionsGrowth < 0)
                      <span class="badge badge-pill bg-soft-danger text-danger me-2">
                          <i class="bi bi-arrow-down me-1"></i>{{ abs($linkedinConnectionsGrowth) }}%
                      </span>
                      <span class="text-nowrap text-xs text-muted" >{{ $timeRange }}</span>

                  
                  @else
                      <span class="text-muted"></span>
                  @endif
                  <span class="text-nowrap text-xs text-muted" style="display:none;">Since last 7 days</span>
                 


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
                    <span class="h3 font-bold mb-0">{{ $twitterFollowersCount }}</span><span> Followers</span>
                  </div>
                  <div class="col-auto">
                    <div
                      class="icon icon-shape bg-black text-white text-lg rounded-circle"
                    >
                      <i class="bi bi-twitter"></i>
                    </div>
                  </div>
                </div>
                <div class="mt-2 mb-0 text-sm"  >
                  @if($twitterFollowersGrowth > 0)
                      <span class="badge badge-pill bg-soft-success text-success me-2">
                          <i class="bi bi-arrow-up me-1"></i>{{ $twitterFollowersGrowth }}%
                      </span>
                    <span class="text-nowrap text-xs text-muted" >{{ $timeRange }}</span>
                  
                    @elseif($twitterFollowersGrowth < 0)
                      <span class="badge badge-pill bg-soft-danger text-danger me-2">
                          <i class="bi bi-arrow-down me-1"></i>{{ abs($twitterFollowersGrowth) }}%
                      </span>
                      <span class="text-nowrap text-xs text-muted" >{{ $timeRange }}</span>

                  
                  @else
                      <span class="text-muted"></span>
                  @endif
                  <span class="text-nowrap text-xs text-muted" style="display:none;">Since last 7 days</span>
                 


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
        const chartData = @json($chartData);
    </script>

@include('include.chart')





@endsection()
