<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\File;
use App\Models\Linkedin;
use App\Models\LinkedinPost;
use App\Http\Controllers\TwitterController;
use Abraham\TwitterOAuth\TwitterOAuth;
use \Abraham\TwitterOAuth\TwitterOAuthMediaTrait;
use Atymic\Twitter\Twitter as TwitterClient;
use App\Models\TwitterPost;




class PostController extends Controller
{
    private $linkedinApiUrl = 'https://api.linkedin.com/v2/';

        private function storeMediaPaths($mediaFiles)
    {
        $mediaPaths = [];

        // Loop through each media file and store its path
        foreach ($mediaFiles as $mediaFile) {
            $mediaPaths[] = $mediaFile->store('uploads', 'public');
        }

        return $mediaPaths;
    }

    public function createImageShare(Request $request)
    {   

    try {
        $client = new Client();
    
        $user = Auth::user();

        $userId = $user->id;
        $linkedin = LinkedIn::where('user_id', $userId)->first();
        $accessToken= $linkedin->linkedin_access_token;
    
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ];
    
        // Handle file uploads
        $mediaAssets = [];
    
        // Determine whether it's an image or video upload
        $mediaType = $request->has('images') ? 'image' : 'video';
    
        $mediaFiles = $request->file($mediaType . 's');

           // Store the content and media paths in the database

   
        // Register the media and get the upload URL
        foreach ($mediaFiles as $mediaFile) {
            $mediaPath = $mediaFile->path();
            $mediaBinary = file_get_contents($mediaPath);
    
            $recipe = ($mediaType === 'image') ? 'feedshare-image' : 'feedshare-video';

            $registerUploadResponse = $client->post($this->linkedinApiUrl . 'assets?action=registerUpload', [
                'headers' => $headers,
                'json' => [
                    'registerUploadRequest' => [
                        'recipes' => ["urn:li:digitalmediaRecipe:$recipe"],
                        'owner' => 'urn:li:person:' . $linkedin->linkedin_id,
                        'serviceRelationships' => [
                            [
                                'relationshipType' => 'OWNER',
                                'identifier' => 'urn:li:userGeneratedContent',
                            ],
                        ],
                    ],
                ],
            ]);
    
            $uploadData = json_decode($registerUploadResponse->getBody(), true);
            $assetId = $uploadData['value']['asset'];
    
            // Upload the media binary file
            $client->post($uploadData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => $mediaBinary,
            ]);
    
            $mediaAssets[] = $assetId;
        }
    
        // Create the media share
        $postContent = $request->input('content');
    
        $mediaArray = [];
        foreach ($mediaAssets as $assetId) {
            $mediaArray[] = [
                'status' => 'READY',
                'media' => $assetId,
            ];
        }
    
        $body = [
            'author' => 'urn:li:person:' . $linkedin->linkedin_id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $postContent,
                    ],
                    'shareMediaCategory' => strtoupper($mediaType),
                    'media' => $mediaArray,
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];
    
        $createMediaShareResponse = $client->post($this->linkedinApiUrl . 'ugcPosts', [
            'headers' => $headers,
            'json' => $body,
        ]);



        $images = $this->storeMediaPaths($mediaFiles);

        foreach ($images as $path) {
               $newPath = substr($path, strlen('uploads/'));
               $newImagePaths[] = $newPath;
           }
        $post = new LinkedinPost([
            'user_id' => $userId,
            'content' => $request->input('content'),
            'images' => $newImagePaths,
        ]);

        $post->save(); 
        return Redirect::back()->with('success', 'Post successfully shared on LinkedIn!');
    } catch (\Exception $e) {
        // Handle the exception and redirect with an error message
        return Redirect::back()->with('error', 'Error sharing post on LinkedIn: ' . $e->getMessage());
    }
    
    }



    public function postToLinkedIn(Request $request)
    {

                // Validate the request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // Extract data from the request
        $content = $request->input('content');

        

        // Get the authenticated user
        $user = Auth::user();
        $userId = $user->id;
        $post = new LinkedinPost([
            'user_id' => $userId,
            'content' => $content ,
         
        ]);

        $post->save();
        $linkedin = LinkedIn::where('user_id', $userId)->first();
        $accessToken= $linkedin->linkedin_access_token;

        // Prepare the post data
        $postData = [
            'author' => 'urn:li:person:' . $linkedin->linkedin_id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $content,
                    ],
                    'shareMediaCategory' => 'NONE',
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];

        

        // Make a POST request to the LinkedIn API
        $client = new Client();
        $response = $client->post('https://api.linkedin.com/v2/ugcPosts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            
            'json' => $postData,
        ]);

        // Handle the response as needed
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);

        

        if ($statusCode == 201) {
            // Successfully posted to LinkedIn
            return redirect()->back()->with('success', 'Post successfully shared on LinkedIn!');
        } else {
            // Handle errors
            return redirect()->back()->with('error', 'Failed to post on LinkedIn. Check the LinkedIn API response for details.');
        }
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

            $images = $this->storeMediaPaths($mediaFiles);


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
            // dd($result);
            if ($result) {

                $post = new TwitterPost([
                    'user_id' => Auth::user()->id,
                    'content' => $request->input('content'),
                    'images' => implode(',', $images),
                ]);
                $post->save();
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
    
                // Redirect back after a successful tweet and post
                return redirect()->back();
            } else {
                // If the response status code is not 200, handle the error
                return redirect()->back()->with('error', 'Tweet posting failed with status code: ' . $twitterOAuth->getLastHttpCode());
            }
        
            // Get the tweet details using the tweet ID
            // $tweetDetails = $twitterOAuth->get('statuses/show', ['id' => $tweet->id_str]);
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function simplePost(Request $request){


        $this->postToLinkedIn($request);
        $this->postTweet($request);

        // You can return a response or redirect as needed
        return redirect()->back();

    }

    public function mediaPost(Request $request){

        $this->createImageShare($request);
        $this->postTweetWithMedia($request);


        // You can return a response or redirect as needed
        return redirect()->back();

    }
}