@extends('dashboard')
@section('title','Streams')
@section('content')
<style>

    .streamdiv{
      padding:20px;
      box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
      
    }


    .postdiv{
      box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
      padding:10px;
      border-radius:8px;
      
    }
    .custom-pink-color {
        color: rgb(231,84,128); 
    }

    .craousel_div{
        border: none;
        /* background-color: aqua; */
        height: 250px;

    }


    .craousel_div img{
        border-radius: 0%;
        width: 100%;
        height: 250px;

    }
</style>


<div class="container mt-2">
    <div class="row">

        <div class="col-md-6">
            <div class="whole-container custom-container streamdiv">
                <h3 class="text-center title-heading"><b><i>LinkedIn Streams</i></b></h3>

                @forelse ($linkedin_posts as $post)
                        <div class="tweet-card mt-3 postdiv">
                            <div class="d-flex align-items-center mb-4">
                                <img src="{{ asset('storage/uploads/' . auth()->user()->image_path) }}" alt="Profile Pic" class="rounded-circle mr-4" style="width: 50px; height: 50px;">
                                <div style="padding:15px;">
                                    {{ auth()->user()->linkedin->linkedin_name }}
                                </div>
                                <div class="text-muted small" style="margin-left: 220px;">
                                </div>
                            </div>

                            <p style="margin-left:30px;">{{ $post->content }}</p>
                            @if ($post->images && count($post->images) > 0)
                            <div class="carousel_div">
                                <div id="linkedinCarousel{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @for ($i = 0; $i < count($post->images); $i++)
                                            <button type="button" data-bs-target="#linkedinCarousel{{ $loop->index }}" data-bs-slide-to="{{ $i }}" @if ($i === 0) class="active" @endif></button>
                                        @endfor
                                    </div>

                                    <div class="carousel-inner">
                                    @foreach ($post->images as $index => $image)
                                        @if (pathinfo($image, PATHINFO_EXTENSION) == 'mp4' || pathinfo($image, PATHINFO_EXTENSION) == 'webm')
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <video class="d-block w-100" controls>
                                                    <source src="{{ asset('storage/uploads/' . $image) }}" type="video/{{ pathinfo($image, PATHINFO_EXTENSION) }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @else
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <img src="{{ asset('storage/uploads/' . $image) }}" alt="Image {{ $index + 1 }}" class="d-block w-100">
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>

                                    <button class="carousel-control-prev" type="button" data-bs-target="#linkedinCarousel{{ $loop->index }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#linkedinCarousel{{ $loop->index }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        @endif




                            <div class="mt-3 d-flex justify-content-start align-items-center">
                                <button type="button" class="btn btn-link text-muted mr-1" style="width: 70px">
                                    <i class="fab fa-linkedin"></i>
                                    <p>Share</p>
                                </button>
                                <button type="button" class="btn btn-link text-muted mr-1" style="width: 100px">
                                    <i class="fas fa-comment"></i>
                                    <p>Comment</p>
                                </button>
                                <button type="button" class="btn btn-link text-primary mr-1" style="width: 100px">
                                    <i class="fas fa-thumbs-up"></i>
                                    <p>Like</p>
                                </button>
                                <span class="text-muted"></span>
                            </div>
                        </div>
                    @empty
                    <p>No LinkedIn posts available.</p>
                    @endforelse




            </div>
        </div>

        <div class="col-md-6">
            <div class="whole-container custom-container streamdiv">
                <h3 class="text-center title-heading"><b><i>Twitter Streams</i></b></h3>

                @forelse ($twitter_posts as $post)
                    <div class="tweet-card mt-3 postdiv">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('storage/uploads/' . auth()->user()->image_path) }}" alt="Profile Pic" class="rounded-circle mr-4" style="width: 50px; height: 50px;"/>
                            <div style="padding:15px;">
                                {{ auth()->user()->twitter->twitter_name}}
                            </div>
                            <div class="text-muted small" style="margin-left: 220px;">
                            </div>
                        </div>
                        <p style="margin-left:30px;">{{ $post->content }}</p>                        @if ($post->images && count($post->images) > 0)
                          <div class="carousel_div">
                              <div id="twitterCarousel{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                                  <div class="carousel-indicators">
                                      @for ($i = 0; $i < count($post->images); $i++)
                                          <button type="button" data-bs-target="#twitterCarousel{{ $loop->index }}" data-bs-slide-to="{{ $i }}" @if ($i === 0) class="active" @endif></button>
                                      @endfor
                                  </div>

                                  <div class="carousel-inner">
                                    @foreach ($post->images as $index => $img)
                                        @if (pathinfo($img, PATHINFO_EXTENSION) == 'mp4' || pathinfo($img, PATHINFO_EXTENSION) == 'webm')
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <video class="d-block w-100" controls>
                                                    <source src="{{ asset('storage/uploads/' . $img) }}" type="video/{{ pathinfo($img, PATHINFO_EXTENSION) }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @else
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <img src="{{ asset('storage/uploads/' . $img) }}" alt="Image {{ $index + 1 }}" class="d-block w-100">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                  <button class="carousel-control-prev" type="button" data-bs-target="#twitterCarousel{{ $loop->index }}" data-bs-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#twitterCarousel{{ $loop->index }}" data-bs-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  </button>
                              </div>
                          </div>
                      @endif
                            
                        <div class="mt-3 d-flex justify-content-start align-items-center">
                            <button type="button" class="btn btn-link text-muted mr-1" style="width: 70px">
                                <i class="fas fa-retweet"></i>
                                <p>{{ $post->retweets ?? 4 }}</p>
                            </button>
                            <button type="button" class="btn btn-link text-muted mr-1" style="width: 70px">
                                <i class="fas fa-reply"></i>
                                <p>{{ $post->replies ?? 3 }}</p>
                            </button>
                            <button type="button" class="btn btn-link custom-pink-color mr-1" style="width: 70px">
                                <i class="fas fa-heart"></i>
                                <p>{{ $post->likes ?? 89 }}</p>
                            </button>

                            <button type="button" class="btn btn-link text-muted mr-1" style="width: 70px">
                                <i class="fas fa-eye"></i>
                                <p>{{ $post->views ?? 103 }}</p>
                            </button>
                            <span class="text-muted"></span>
                        </div>
                    </div>
                @empty
                    <p>No tweets available.</p>
                @endforelse

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize LinkedIn Carousels
        var linkedinCarousels = document.querySelectorAll('#linkedinCarousel');
        linkedinCarousels.forEach(function (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: false  // Disable automatic cycling
            });
        });

        // Initialize Twitter Carousels
        var twitterCarousels = document.querySelectorAll('#twitterCarousel');
        twitterCarousels.forEach(function (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: false  // Disable automatic cycling
            });
        });
    });
</script>

@endsection



