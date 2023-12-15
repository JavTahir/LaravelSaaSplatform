<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createLinkedInPost(Request $request)
    {
        try {
            // Step 1: Register Image Upload
            $registerResponse = $this->registerImageUpload();
            $uploadUrl = $registerResponse['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
            $asset = $registerResponse['value']['asset'];

            // Step 2: Upload Image
            $uploadResponse = $this->uploadImage($uploadUrl, $request->file('uploadedImages'));

            // Handle the upload response as needed
            // You can add validation, error handling, and save the asset ID if needed

            // Step 3: Create LinkedIn Post
            $postResponse = $this->createImageShare($asset, $request->input('content'));

            // Handle the post response as needed
            // You can add validation, error handling, and return a response to the user

            return response()->json([
                'register_response' => $registerResponse,
                'upload_response' => $uploadResponse,
                'post_response' => $postResponse,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function registerImageUpload()
    {
        $user = Auth::user();
        $accessToken = request()->session()->get('linkedin_token');
        $url = 'https://api.linkedin.com/v2/assets?action=registerUpload';

        $data = [
            'registerUploadRequest' => [
                'recipes' => ['urn:li:digitalmediaRecipe:feedshare-image'],
                'owner' => 'urn:li:person:' . $user->id,
                'serviceRelationships' => [
                    [
                        'relationshipType' => 'OWNER',
                        'identifier' => 'urn:li:userGeneratedContent',
                    ],
                ],
            ],
        ];

        return Http::withToken($accessToken)->post($url, $data)->json();
    }

    private function uploadImage($uploadUrl, $image)
    {
        $accessToken = request()->session()->get('linkedin_token');
        $response = Http::withToken($accessToken)
            ->attach('upload-file', file_get_contents($image), $image->getClientOriginalName())
            ->post($uploadUrl);

        // Check if the upload was successful
        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('Image upload failed: ' . $response->body());
        }
    }

    private function createImageShare($asset, $content)
    {
        $user = Auth::user();
        $accessToken = request()->session()->get('linkedin_token');
        $url = 'https://api.linkedin.com/v2/ugcPosts';

        $data = [
            'author' => 'urn:li:person:' . $user->id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $content,
                    ],
                    'shareMediaCategory' => 'IMAGE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => 'Center stage!',
                            ],
                            'media' => $asset,
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

        return Http::withToken($accessToken)->post($url, $data)->json();
    }
}
