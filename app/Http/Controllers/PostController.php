<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;

class PostController extends Controller
{
    private $linkedinApiUrl = 'https://api.linkedin.com/v2/';

    public function createImageShare(Request $request)
    {
        $client = new Client();
    
        $accessToken = $request->session()->get('linkedin_token');
        $user = Auth::user();
    
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ];
    
        // Handle file uploads
        $mediaAssets = [];
    
        // Determine whether it's an image or video upload
        $mediaType = $request->has('images') ? 'image' : 'video';
    
        $mediaFiles = $request->file($mediaType . 's');
    
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
                        'owner' => 'urn:li:person:' . $user->linkedin_id,
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
            'author' => 'urn:li:person:' . $user->linkedin_id,
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
    
        // Handle the response as needed
        return $createMediaShareResponse->getBody()->getContents();
    }
}
