<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Linkedin;
use App\Models\Twitter;
use App\Models\TwitterFollower;
use App\Models\User;

use App\Models\LinkedinConnections;
use Carbon\Carbon;


class Analytics extends Controller
{
    public function show()
{
    $user = Auth::user();

    $userId = $user->id;
    $linkedin = LinkedIn::where('user_id', $userId)->first();
    $linkedin_id= $linkedin->id;
    

    $twitter = Twitter::where('user_id', $userId)->first();
    
    $twitter_id= $twitter->id;


    // Get Twitter followers count
    $twitterFollowersCount = TwitterFollower::where('twitter_id', $twitter_id)
        ->orderBy('record_date', 'desc')
        ->first('followers_count')
        ->followers_count ?? 0;

    // Get LinkedIn connections count
    $linkedinConnectionsCount = LinkedinConnections::where('linkedin_id', $linkedin_id)
        ->orderBy('record_date', 'desc')
        ->first('connections_count')
        ->connections_count ?? 0;


     $chartData =  $this->dailyComparison();

    return view('analytics', [
        // 'twitterFollowersCount' => $twitterFollowersCount,
        'linkedinConnectionsCount' => $linkedinConnectionsCount,
        'linkedinConnectionsGrowth' =>0,
        'twitterFollowersCount' => $twitterFollowersCount,
        'twitterFollowersGrowth' =>0,
	'chartData'=>$chartData,
    ]);
}




// Helper method to get LinkedIn connections count for the last 7 days
protected function getLinkedinConnectionsCountLast7Days($linkedin_id)
{
    $startDate = now()->subDays(7);

    $connectionsLast7Days = LinkedinConnections::where('linkedin_id', $linkedin_id)
        ->where('record_date', '>=', $startDate)
        ->sum('connections_count');

    // Fetch the connections count from the previous period (e.g., the previous 7 days)
    $previousStartDate = now()->subDays(14);
    $connectionsPrevious7Days = LinkedinConnections::where('linkedin_id', $linkedin_id)
        ->where('record_date', '>=', $previousStartDate)
        ->where('record_date', '<', $startDate)
        ->sum('connections_count');

    // Calculate the growth percentage
    $linkedinConnectionsGrowth = 0;
    if ($connectionsPrevious7Days > 0) {
        $linkedinConnectionsGrowth = round((($connectionsLast7Days - $connectionsPrevious7Days) / $connectionsPrevious7Days) * 100, 2);
    }


    return compact('connectionsLast7Days', 'linkedinConnectionsGrowth');
}



// Helper method to get Twitter followers count for the last 7 days
protected function getTwitterFollowersCountLast7Days($twitter_id)
{
    $startDate = now()->subDays(7);

    $followersLast7Days = TwitterFollower::where('twitter_id', $twitter_id)
        ->where('record_date', '>=', $startDate)
        ->sum('followers_count');

    // Fetch the followers count from the previous period (e.g., the previous 7 days)
    $previousStartDate = now()->subDays(14);
    $followersPrevious7Days = TwitterFollower::where('twitter_id', $twitter_id)
        ->where('record_date', '>=', $previousStartDate)
        ->where('record_date', '<', $startDate)
        ->sum('followers_count');

    // Calculate the growth percentage
    $twitterFollowersGrowth = 0;
    if ($followersPrevious7Days > 0) {
        $twitterFollowersGrowth = round((($followersLast7Days - $followersPrevious7Days) / $followersPrevious7Days) * 100, 2);
    }

    return compact('followersLast7Days', 'twitterFollowersGrowth');
}




private function getLinkedinConnectionsCountLastMonth($linkedinId)
{
    $startDate = now()->subMonth()->startOfMonth();
    $endDate = now()->subMonth()->endOfMonth();

    $connectionsLastMonth = LinkedinConnections::where('linkedin_id', $linkedinId)
        ->whereBetween('record_date', [$startDate, $endDate])
        ->sum('connections_count');

    $previousStartDate = now()->subMonths(2)->startOfMonth();
    $previousEndDate = now()->subMonths(2)->endOfMonth();

    $connectionsPreviousMonth = LinkedinConnections::where('linkedin_id', $linkedinId)
        ->whereBetween('record_date', [$previousStartDate, $previousEndDate])
        ->sum('connections_count');

    $linkedinConnectionsGrowth = 0;
    if ($connectionsPreviousMonth > 0) {
        $linkedinConnectionsGrowth = round((($connectionsLastMonth - $connectionsPreviousMonth) / $connectionsPreviousMonth) * 100, 2);
    }

    return [
        'connectionsLastMonth' => $connectionsLastMonth,
        'linkedinConnectionsGrowth' => $linkedinConnectionsGrowth,
    ];
}



private function getTwitterFollowersCountLastMonth($twitterId)
{
    $startDate = now()->subMonth()->startOfMonth();
    $endDate = now()->subMonth()->endOfMonth();

    $followersLastMonth = TwitterFollower::where('twitter_id', $twitterId)
        ->whereBetween('record_date', [$startDate, $endDate])
        ->sum('followers_count');

    $previousStartDate = now()->subMonths(2)->startOfMonth();
    $previousEndDate = now()->subMonths(2)->endOfMonth();

    $followersPreviousMonth = TwitterFollower::where('twitter_id', $twitterId)
        ->whereBetween('record_date', [$previousStartDate, $previousEndDate])
        ->sum('followers_count');

    $twitterFollowersGrowth = 0;
    if ($followersPreviousMonth > 0) {
        $twitterFollowersGrowth = round((($followersLastMonth - $followersPreviousMonth) / $followersPreviousMonth) * 100, 2);
    }

    return [
        'followersLastMonth' => $followersLastMonth,
        'twitterFollowersGrowth' => $twitterFollowersGrowth,
    ];
}




    public function weeklyComparison()
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();
    
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
    
            return compact('chartData');    
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

        return compact('chartData');
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
        dd($user->image_path);



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

        return compact('chartData');
    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error view
        return view('error')->with('error', $e->getMessage());
    }
}





// Controller method
public function analytics(Request $request)
{
    $user = Auth::user();
    $userId = $user->id;
    $linkedin = LinkedIn::where('user_id', $userId)->first();
    $linkedin_id = $linkedin->id;

    $twitter = Twitter::where('user_id', $userId)->first();
    $twitter_id = $twitter->id;

    $linkedinConnectionsCount = 0;
    $linkedinConnectionsGrowth = 0;
    $twitterFollowersCount = 0;
    $twitterFollowersGrowth = 0;

    if ($request->has('filter') && $request->filter == 'last_7_days') {
        $linkedinData = $this->getLinkedinConnectionsCountLast7Days($linkedin_id);
        $linkedinConnectionsCount = $linkedinData['connectionsLast7Days'];
        $linkedinConnectionsGrowth = $linkedinData['linkedinConnectionsGrowth'];

        $twitterData = $this->getTwitterFollowersCountLast7Days($twitter_id);
        $twitterFollowersCount = $twitterData['followersLast7Days'];
        $twitterFollowersGrowth = $twitterData['twitterFollowersGrowth'];


        $timeRange = 'Since last 7 days';
	$chartData =  $this->weeklyComparison();
    }

    elseif ($request->has('filter') && $request->filter == 'last_month') {
        $linkedinData = $this->getLinkedinConnectionsCountLastMonth($linkedin_id);
        $linkedinConnectionsCount = $linkedinData['connectionsLastMonth'];
        $linkedinConnectionsGrowth = $linkedinData['linkedinConnectionsGrowth'];

        // Fetch Twitter data for the last month if needed
        $twitterData = $this->getTwitterFollowersCountLastMonth($twitter_id);
        $twitterFollowersCount = $twitterData['followersLastMonth'];
        $twitterFollowersGrowth = $twitterData['twitterFollowersGrowth'];

        
        $timeRange = 'Since last Month';
	$chartData =  $this->monthlyComparison();
    }

    return view('analytics', compact('chartData','linkedinConnectionsCount', 'linkedinConnectionsGrowth','twitterFollowersCount', 'twitterFollowersGrowth', 'timeRange'));

}


public function adminAnalytics(){

    $chartData =  $this->dailyUserComparison();
    $totalUsers = User::count();

        return view('analytics_adm', ['totalUsers' => $totalUsers,'chartData'=>$chartData]);
}


public function dailyUserComparison()
{
    try {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch user data for today and yesterday
        $userDataToday = $user->whereDate('created_at', Carbon::today())->get();
        $userDataYesterday = $user->whereDate('created_at', Carbon::yesterday())->get();
       

        // Combine data into a format suitable for passing to the Blade view
        $chartData = [
            'labels' => ['Today', 'Yesterday'],

            'datasets' => [
                [
                    'data' => [$userDataToday->count(), $userDataYesterday->count()],
                    'borderColor' => '#87CEFA', // Adjust the color as needed
                    'fill' => false,
                    'label' => 'User Count',
                ],
            ],
          
        ];

       

        return compact('chartData');
    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error view
        return ;
    }
}


}
