<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    private $linkedinApiUrl = 'https://api.linkedin.com/v2/';

    public function createImageShare()
    {
        $client = new Client();

        $accessToken = request()->session()->get('linkedin_token');
        $user = Auth::user();

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ];

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

        // Get the upload URL and asset ID
        $uploadUrl = $uploadData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
        $assetId = $uploadData['value']['asset'];

        // Upload the image binary file
        $imageFilePath = 'E:/CUI/5th SEMESTER/probiz/probiz-main/public/images/arrow.png';
        $imageBinary = file_get_contents($imageFilePath);

        $uploadImageResponse = $client->post($uploadUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/octet-stream',
            ],
            'body' => $imageBinary,
        ]);

        // Create the image share
        $body = [
            'author' => 'urn:li:person:' . $user->linkedin_id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => 'Feeling inspired after meeting so many talented individuals at this year\'s conference. #talentconnect',
                    ],
                    'shareMediaCategory' => 'IMAGE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => 'Center stage!',
                            ],
                            'media' => $assetId,
                            'title' => [
                                'text' => 'LinkedIn Talent Connect 2021',
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
