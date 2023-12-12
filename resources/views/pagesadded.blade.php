@extends('accounts')
@section('title','PagesAdded')
@section('content')

<div class="container">
      <div class="centered-text">ADDED PAGES!</div>

      <div class="custom-div">
        <div class="user-items-container"></div>
      </div>

      <div class="post-button">
        <div class="custom-dropdown">
          <button class="done-button" id="postButton">Done</button>
        </div>
      </div>
    </div>

    <script>
    document.getElementById('postButton').addEventListener('click', function () {
        // Redirect to the dashboard route
        window.location.href = '{{ route("dashboard") }}';
    });
</script>
@endsection()