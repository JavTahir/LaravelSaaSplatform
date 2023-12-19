<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Abraham\TwitterOAuth\TwitterOAuth;
use \Abraham\TwitterOAuth\TwitterOAuthMediaTrait;
use Atymic\Twitter\Twitter as TwitterClient;
use GuzzleHttp\Client;


class TwitterController extends Controller
{
    public function postTweetWithMedia(Request $request)
    {
        try {
            $accessToken = Session::get('twitter_accesstoken');
            $accessTokenSecret = Session::get('twitter_token');
    
            // Twitter API credentials
            $consumerKey = '8n2kX7hxigWxuh9Dc01e7MFXj';
            $consumerSecret = 'hiYS0ddgkrOLPKphPGelS2Iuh5iUbjM3e24P3txkCQ7hXzdxSG';
    
            // Image file from the request
            // $image = $request->file('image');
    
            // Create TwitterOAuth instance
            $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
            $twitterOAuth->setApiVersion(1.1);

            
            $content = $request->input('content');
            // $image =  $request->file('image')->path();
            // dd($image);
            $images = $request->file('image');
            // dd($images);


            $mediaIds = []; // Array to store media IDs

            foreach ($images as $image) {
                // Prepare image data for upload
                $imagePath = $image->path();
    
                // Upload image using POST media/upload
                $media = $twitterOAuth->upload('media/upload', ['media' => $imagePath]);
                // dd($media);
                
                
    
                // Store media ID in the array
                $mediaIds[] = $media->media_id_string;
            }

            
    
            // Prepare image data for upload
    
            // dd("hii");
    
            // Upload image using POST media/upload
            // $media1 = $twitterOAuth->upload('media/upload', ['media' => $image]);
            // $media2 = $twitterOAuth->upload('media/upload', ['media' => 'C:/Users/Fouzia/Pictures/wreck_facebook.jpg']);
            $twitterOAuth->setApiVersion(2);
            $parameters = [
                'text' => $content,
                'media' => ['media_ids' =>$mediaIds],
            ];
            $result = $twitterOAuth->post('tweets', $parameters, true);
            // dd($result);
            if ($twitterOAuth->getLastHttpCode() >= 200 && $twitterOAuth->getLastHttpCode() < 300) {
                // Successfully posted on Twitter
                return redirect()->back()->with('success', 'Tweet successfully posted on Twitter!');
            } else {
                // Handle errors
                return redirect()->back()->with('error', 'Failed to post on Twitter. Check the Twitter API response for details.');
            }


        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function postTweet(Request $request)
    {
        // Get Twitter access token and secret from the session
        $accessToken = Session::get('twitter_accesstoken');
        $accessTokenSecret = Session::get('twitter_token');

        // Twitter API credentials
        $consumerKey = 'G7SKbWYUJVTZqTWDXg2pXEnCl';
        $consumerSecret = 'K4nh7tcKbNESol6loubGbhrU5HlloBioeY2fBmM6Lzh1Qq5SKL';

        // Create a TwitterOAuth instance
        $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        // $twitterOAuth->setApiVersion('1.1');
        try {

            $tweet = $twitterOAuth->post(
                'tweets',
                [
                    'text' => 'hello',
                ]
                

            );
        
            // Get the tweet details using the tweet ID
            // $tweetDetails = $twitterOAuth->get('statuses/show', ['id' => $tweet->id_str]);
        
            return response()->json([
                'status_code' => 200,
                'data'        => $tweet,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => $e->getCode(),
                'error'       => $e->getMessage(),
            ], $e->getCode());
        }
    }


    public function postTweetWithVideo(Request $request)
    {
        try {
            $accessToken = Session::get('twitter_accesstoken');
            $accessTokenSecret = Session::get('twitter_token');
    
            // Twitter API credentials
            $consumerKey = 'G7SKbWYUJVTZqTWDXg2pXEnCl';
            $consumerSecret = 'K4nh7tcKbNESol6loubGbhrU5HlloBioeY2fBmM6Lzh1Qq5SKL';
    
            // Image file from the request
            // $image = $request->file('image');
    
            // Create TwitterOAuth instance
            $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
            $twitterOAuth->setApiVersion(1.1);

            
            $content = $request->input('content');
            // $image =  $request->file('image')->path();
            // dd($image);
            $images = $request->file('image');
            // dd($images);


            $mediaIds = []; // Array to store media IDs

            foreach ($images as $image) {
                // Prepare image data for upload
                $imagePath = $image->path();
                dd($imagePath);
    
                // Upload image using POST media/upload
                $media = $twitterOAuth->upload('media/upload', ['media' => $imagePath,'media_type' => 'video/mp4'],true);
                // dd($media);
                
                
    
                // Store media ID in the array
                $mediaIds[] = $media->media_id_string;
            }

            
    
            // Prepare image data for upload
    
            // dd("hii");
    
            // Upload image using POST media/upload
            // $media1 = $twitterOAuth->upload('media/upload', ['media' => $image]);
            // $media2 = $twitterOAuth->upload('media/upload', ['media' => 'C:/Users/Fouzia/Pictures/wreck_facebook.jpg']);
            $twitterOAuth->setApiVersion(2);
            $parameters = [
                'text' => $content,
                'media' => ['media_ids' =>$mediaIds],
            ];
            $result = $twitterOAuth->post('tweets', $parameters, true);
            if ($twitterOAuth->getLastHttpCode() >= 200 && $twitterOAuth->getLastHttpCode() < 300) {
                // Successfully posted on Twitter
                return redirect()->back()->with('success', 'Tweet successfully posted on Twitter!');
            } else {
                // Handle errors
                return redirect()->back()->with('error', 'Failed to post on Twitter. Check the Twitter API response for details.');
            }


        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function showTwitterForm()
    {
        return view('twitterpostform');
    }
}
