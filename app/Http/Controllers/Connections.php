<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Connection;
use Illuminate\Support\Facades\Http;
use App\Models\Lix;


class Connections extends Controller
{

    public function lixaccount(){
        return view('lix');
    }


    public static function getConnections($apiKey,$viewerId)
    {
        try {    


            // Make a request to the Lix API endpoint with the Authorization header
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->get("https://api.lix-it.com/v1/connections", [
                'viewer_id' => $viewerId,
                'count' => 1000,
                'start' => 0,
            ]);
    
            // Check for a successful response
            $response->throw();
    
            // Decode the JSON response
            $data = $response->json();
    
            // Get the elements array from the response
            $elements = $data['elements'];
    
            // Count the total number of elements
            $totalElements = count($elements);


    
            return $totalElements;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('API Request Error: ' . $e->getMessage());
    
            // Return an error response
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }


    public function lixform(Request $request)
    {
        $request->validate([
            'lixApiKey' => 'required|string',
            'linkedinViewerId' => 'required|string',
        ]);

        $apiKey = $request->lixApiKey;
        $viewerId = $request->linkedinViewerId;


        // Save the form data to the LixAccount table
        $lixAccount = Lix::where('user_id', Auth::user()->id)->first();

        // Check if the record exists
        if ($lixAccount) {
            // Update the existing record
            $lixAccount->update([
                'lix_api_key' =>  $apiKey,
                'linkedin_viewer_id' =>$viewerId,
                
            ]);
        } else {
            // Create a new record
            Lix::create([
                'user_id' => Auth::user()->id,
                'linkedin_viewer_id' =>$viewerId ,
                'lix_api_key' => $apiKey,
                
            ]);
        }

        $linkedin_connections = $this->getConnections($apiKey,$viewerId);
        $existingRecord = Auth::user()->linkedin->connections()
        ->where('record_date', now()->toDateString())
        ->first();

        if ($existingRecord) {
            // Update the existing record
            $existingRecord->update([
                'connections_count' => $linkedin_connections,
            ]);
        } else {
            // Create a new record
            Auth::user()->linkedin->connections()->create([
                'connections_count' => $linkedin_connections,
                'record_date' => now()->toDateString(),
            ]);
        }

        $linkedinAccount = Auth::user()->linkedin;
        $twitterAccount = Auth::user()->twitter;

        return view('addaccounts', [
            'linkedinAccount' => $linkedinAccount,
            'twitterAccount' => $twitterAccount,
        ]);

    }



    
    
}
