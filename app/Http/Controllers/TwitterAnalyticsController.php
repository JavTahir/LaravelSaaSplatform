<?php

namespace App\Http\Controllers;

use App\Models\TwitterFollower;
use App\Models\LinkedInConnection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitterAnalyticsController extends Controller
{
    public function weeklycomparison()
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();

            $twitter_followers = $user->twitter->followers()
            ->where('record_date', now()->toDateString())
            ->first();

            $linkedin_connections = $user->linkedin->connections()
            ->where('record_date', now()->toDateString())
            ->first();
    
            // Fetch Twitter follower data for the last 7 days for the logged-in user
            $twitterData = $user->twitter->followers()
                ->where('record_date', '>=', Carbon::now()->subDays(7))
                ->orderBy('record_date')
                ->get();
    
            // Fetch LinkedIn connection data for the last 7 days for the logged-in user
            $linkedinData = $user->linkedin->connections()
                ->where('record_date', '>=', Carbon::now()->subDays(7))
                ->orderBy('record_date')
                ->get();

            
    
            // Merge Twitter and LinkedIn data to get a combined dataset with zero values for missing dates
            $mergedData = $this->mergeData($twitterData, $linkedinData);
    
            // Sort merged data by 'record_date'
            $mergedData = $mergedData->sortBy('record_date');
    
            // Combine merged data into a format suitable for passing to the Blade view
            $chartData = [
                'labels' => $mergedData->pluck('record_date')->map(function ($date) {
                    return Carbon::parse($date)->format('F d');
                })->toArray(),
                'datasets' => [
                    [
                        'data' => $mergedData->pluck('followers_count')->toArray(),
                        'borderColor' => '#87CEFA',
                        'fill' => false,
                        'label' => 'Twitter Followers',
                    ],
                    [
                        'data' => $mergedData->pluck('connections_count')->toArray(),
                        'borderColor' => '#0A66C2', // LinkedIn color (adjust as needed)
                        'fill' => false,
                        'label' => 'LinkedIn Connections',
                    ],
                ],
            ];
    
            return view('analytics', compact('chartData', 'twitter_followers', 'linkedin_connections'));
    
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error view
            return view('error')->with('error', $e->getMessage());
        }
    }
    
    // Function to merge Twitter and LinkedIn data with zero values for missing dates
    private function mergeData($twitterData, $linkedinData)
    {
        $mergedData = collect([]);
    
        $allDates = $twitterData->pluck('record_date')
            ->merge($linkedinData->pluck('record_date'))
            ->unique();
    
        foreach ($allDates as $date) {
            $twitterEntry = $twitterData->where('record_date', $date)->first();
            $linkedinEntry = $linkedinData->where('record_date', $date)->first();
    
            $mergedData->push([
                'record_date' => $date,
                'followers_count' => $twitterEntry ? $twitterEntry->followers_count : 0,
                'connections_count' => $linkedinEntry ? $linkedinEntry->connections_count : 0,
            ]);
        }
    
        return $mergedData;
    }


    public function dailyComparison()
{
    try {
        // Get the currently authenticated user
        $user = Auth::user();

        $twitter_followers = $user->twitter->followers()
        ->where('record_date', now()->toDateString())
        ->first();

        $linkedin_connections = $user->linkedin->connections()
        ->where('record_date', now()->toDateString())
        ->first();

        // Fetch Twitter follower data for the last 2 days for the logged-in user
        $twitterData = $user->twitter->followers()
            ->where('record_date', '>=', Carbon::now()->subDays(2))
            ->orderBy('record_date')
            ->get();

        // Fetch LinkedIn connection data for the last 2 days for the logged-in user
        $linkedinData = $user->linkedin->connections()
            ->where('record_date', '>=', Carbon::now()->subDays(2))
            ->orderBy('record_date')
            ->get();

        // Merge Twitter and LinkedIn data to get a combined dataset with zero values for missing dates
        $mergedData = $this->mergeData($twitterData, $linkedinData);

        // Sort merged data by 'record_date'
        $mergedData = $mergedData->sortBy('record_date');

        // Combine merged data into a format suitable for passing to the Blade view
        $chartData = [
            'labels' => $mergedData->pluck('record_date')->map(function ($date) {
                return Carbon::parse($date)->format('F d');
            })->toArray(),
            'datasets' => [
                [
                    'data' => $mergedData->pluck('followers_count')->toArray(),
                    'borderColor' => '#87CEFA',
                    'fill' => false,
                    'label' => 'Twitter Followers',
                ],
                [
                    'data' => $mergedData->pluck('connections_count')->toArray(),
                    'borderColor' => '#0A66C2', // LinkedIn color (adjust as needed)
                    'fill' => false,
                    'label' => 'LinkedIn Connections',
                ],
            ],
        ];

        return view('analytics', compact('chartData', 'twitter_followers', 'linkedin_connections'));

    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error view
        return view('error')->with('error', $e->getMessage());
    }
}


public function monthlyComparison()
{
    try {
        // Get the currently authenticated user
        $user = Auth::user();

        $twitter_followers = $user->twitter->followers()
        ->where('record_date', now()->toDateString())
        ->first();

        $linkedin_connections = $user->linkedin->connections()
        ->where('record_date', now()->toDateString())
        ->first();

        // Fetch Twitter follower data for the last 30 days for the logged-in user
        $twitterData = $user->twitter->followers()
            ->where('record_date', '>=', Carbon::now()->subDays(30))
            ->orderBy('record_date')
            ->get();

        // Fetch LinkedIn connection data for the last 30 days for the logged-in user
        $linkedinData = $user->linkedin->connections()
            ->where('record_date', '>=', Carbon::now()->subDays(30))
            ->orderBy('record_date')
            ->get();

        // Merge Twitter and LinkedIn data to get a combined dataset with zero values for missing dates
        $mergedData = $this->mergeData($twitterData, $linkedinData);

        // Sort merged data by 'record_date'
        $mergedData = $mergedData->sortBy('record_date');

        // Combine merged data into a format suitable for passing to the Blade view
        $chartData = [
            'labels' => $mergedData->pluck('record_date')->map(function ($date) {
                return Carbon::parse($date)->format('F d');
            })->toArray(),
            'datasets' => [
                [
                    'data' => $mergedData->pluck('followers_count')->toArray(),
                    'borderColor' => '#87CEFA',
                    'fill' => false,
                    'label' => 'Twitter Followers',
                ],
                [
                    'data' => $mergedData->pluck('connections_count')->toArray(),
                    'borderColor' => '#0A66C2', // LinkedIn color (adjust as needed)
                    'fill' => false,
                    'label' => 'LinkedIn Connections',
                ],
            ],
        ];

        return view('analytics', compact('chartData', 'twitter_followers', 'linkedin_connections'));

    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error view
        return view('error')->with('error', $e->getMessage());
    }
}

    
    
}
