@extends('dashboard_admin')
@section('title','Users')

@section('content')
@include('include.search')
<main class="py-6 bg-surface-secondary">
      <div class="container-fluid">
        <div class="card shadow border-0 mb-7">
          <div class="card-header">
            <h5 class="mb-0">Users</h5>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-nowrap">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Plan</th>
                  <th scope="col">Social Accounts</th>
                  <th scope="col">Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @forelse($users as $user)
                <tr class="user-row">
                  <td>
                    <img
                      alt="..."
                      src="{{ asset('storage/uploads/' . $user->image_path) }}"
                      class="avatar avatar-sm rounded-circle me-2"
                    />
                    <a class="text-heading font-semibold" href="#">
                    {{ $user->first_name }} {{ $user->last_name }}
                    </a>
                  </td>
                  <td>{{ $user->created_at->format('M d, Y') }}</td>
                  <td>
                  @php
                      $planName = $user->plan_name;
                  @endphp
                    <img
                    alt="..."
                    src="
                        @if($planName === 'Basic')
                            {{ asset('images/aboutme.png') }}
                        @elseif($planName === 'Gold')
                            {{ asset('images/Age.png') }}
                        @else
                            {{ asset('images/arrow.png') }}
                        @endif
                    "
                    class="avatar avatar-xs rounded-circle me-2"
                    />
                    <span class="text-heading font-semibold" >
                      {{$user->plan_name}}
                    </span>
                  </td>
                  <td>{{ $user->social_accounts }}</td>
                  <td>
                  {{ $user->email }}
                  </td>
                  <td class="text-end">
                    <div class="d-flex">
                        <a href="{{ route('adminViewUser', ['user' => $user->id]) }}" class="btn btn-sm btn-neutral me-2">View</a>
                        <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6">No users found.</td>
                    </tr>
                @endforelse


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script for search functionality -->
<script>
  $(document).ready(function () {
    // Trigger the search on keyup
    $("#searchInput").on("keyup", function () {
      var searchText = $(this).val().toLowerCase();

      // Show/hide rows based on the search input
      $(".user-row").each(function () {
        var userName = $(this).find("td:first-child a").text().toLowerCase();

        if (userName.includes(searchText)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
  });
</script>

@endsection()