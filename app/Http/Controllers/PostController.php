<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        // Handle file upload
        $imagePath = $request->file('image')->path();
        $imageBinary = file_get_contents($imagePath);

        // Register the image and get the upload URL
        $registerUploadResponse = $client->post($this->linkedinApiUrl . 'assets?action=registerUpload', [
            'headers' => $headers,
            'json' => [
                'registerUploadRequest' => [
                    'recipes' => ['urn:li:digitalmediaRecipe:feedshare-image'],
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

        // Upload the image binary file
        $uploadImageResponse = $client->post($uploadData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/octet-stream',
            ],
            'body' => $imageBinary,
        ]);

        // Create the image share
        $postContent = $request->input('content');
        
        $body = [
            'author' => 'urn:li:person:' . $user->linkedin_id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $postContent,
                    ],
                    'shareMediaCategory' => 'IMAGE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => 'Image Description',
                            ],
                            'media' => $assetId,
                            'title' => [
                                'text' => 'Image Title',
                            ],
                        ],
                    ],
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];

        $createImageShareResponse = $client->post($this->linkedinApiUrl . 'ugcPosts', [
            'headers' => $headers,
            'json' => $body,
        ]);

        // Handle the response as needed
        return $createImageShareResponse->getBody()->getContents();
    }
}
