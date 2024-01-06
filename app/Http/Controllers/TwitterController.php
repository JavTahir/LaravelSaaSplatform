<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Abraham\TwitterOAuth\TwitterOAuth;
use \Abraham\TwitterOAuth\TwitterOAuthMediaTrait;
use Atymic\Twitter\Twitter as TwitterClient;
use GuzzleHttp\Client;
use App\Models\TwitterPost;

class TwitterController extends Controller

{



    private function storeMediaPaths($mediaFiles)
    {
        $mediaPaths = [];

        // Loop through each media file and store its path
        foreach ($mediaFiles as $mediaFile) {
            $mediaPaths[] = $mediaFile->store('uploads', 'public');
        }

        return $mediaPaths;
    }


    public function postTweetWithMedia(Request $request)
    {
        try {

            
            $accessToken = Auth::user()->twitter->twitter_access_token;
            $accessTokenSecret = Auth::user()->twitter->twitter_token_secret;


    
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
            $images = $request->file('images');
            $videos = $request->file('videos');


            $mediaType = $request->has('images') ? 'image' : 'video';
    
            $mediaFiles = $request->file($mediaType . 's');
            
            $mediaIds = [];

            if($images){
                foreach ($images as $image) {
                    // Prepare image data for upload
                    $imagePath = $image->path();
        
                    // Upload image using POST media/upload
                    $media = $twitterOAuth->upload('media/upload', ['media' => $imagePath]);
                    // dd($media);
    
                    // Store media ID in the array
                    $mediaIds[] = $media->media_id_string;
                }

            }

            if($videos){
                foreach ($videos as $video) {
                    // Prepare image data for upload
                    $videoPath = $video->path();
                    // dd($imagePath);
                    // Upload image using POST media/upload
                    $media = $twitterOAuth->upload('media/upload', ['media' => $videoPath,'media_type' => 'video/mp4'],true);
                    // dd($media);
        
                    // Store media ID in the array
                    $mediaIds[] = $media->media_id_string;
                }
            }



            



            // dd($mediaIds);
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

            // $profilePicpathstr = substr($profilePicPath, strlen('uploads/'));


            // dd($result);
            if ($result) {
                $images = $this->storeMediaPaths($mediaFiles);

                foreach ($images as $path) {
                    $newPath = substr($path, strlen('uploads/'));
                    $newImagePaths[] = $newPath;
                }
                

                $post = new TwitterPost([
                    'user_id' => Auth::user()->id,
                    'content' => $request->input('content'),
                    'images' => $newImagePaths,
                ]);
                
                $post->save();
                
                alert()->success('Posted Successfully!','Tweet Created Successfully!')->animation('tada faster','fadeInUp faster');;

                return redirect()->back();
              } else {
                // Handle errors
                
                alert()->error('Tweet Failed','Tweet posting failed: ' . $twitterOAuth->getLastHttpCode());
                return redirect()->back();
            }


        } catch (\Exception $e) {
            alert()->error('Tweet Failed','An error occurred');
            return redirect()->back();
        }
    }

    public function postTweet(Request $request)
    {
        $accessToken = Auth::user()->twitter->twitter_access_token;
        $accessTokenSecret = Auth::user()->twitter->twitter_token_secret;
        $consumerKey = '8n2kX7hxigWxuh9Dc01e7MFXj';
        $consumerSecret = 'hiYS0ddgkrOLPKphPGelS2Iuh5iUbjM3e24P3txkCQ7hXzdxSG';

        // Create a TwitterOAuth instance
        $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        // $twitterOAuth->setApiVersion('1.1');
        try {

            $tweet = $twitterOAuth->post(
                'tweets',
                [
                    'text' => $request->input('content'),
                ]
                

            );

            if ($tweet) {
                // If the tweet is posted successfully, save the post
                $post = new TwitterPost([
                    'user_id' => Auth::user()->id,
                    'content' => $request->input('content'),
                ]);
    
                $post->save();
                alert()->success('Posted Successfully!','Tweet Created Successfully!')->animation('tada faster','fadeInUp faster');;

                return redirect()->back();


            } else {
                // If the response status code is not 200, handle the error
                
                alert()->error('Tweet Failed','Tweet posting failed: ' . $twitterOAuth->getLastHttpCode());
                return redirect()->back();
            }
        
            // Get the tweet details using the tweet ID
            // $tweetDetails = $twitterOAuth->get('statuses/show', ['id' => $tweet->id_str]);
        
        } catch (\Exception $e) {
            
            alert()->error('Tweet Failed','An error occurred!' );
            return redirect()->back();

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
                alert()->success('Posted Successfully!','Tweet Created Successfully!')->animation('tada faster','fadeInUp faster');;

                return redirect()->back();
            } else {
                // Handle errors
               alert()->error('Tweet Failed','Tweet posting failed with status code: ' . $twitterOAuth->getLastHttpCode());
               return redirect()->back();
            }


        } catch (\Exception $e) {
            
            alert()->error('Tweet Failed','An error occurred: ' . $e->getMessage());
            return redirect()->back();

        }
    }


    public function showTwitterForm()
    {
        return view('twitterpostform');
    }
}
