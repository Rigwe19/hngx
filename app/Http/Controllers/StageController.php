<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $slack_name = request()->slack_name;
        $track = request()->track;
        return response()->json([
            'slack_name' => $slack_name,
            'current_day' => Carbon::now()->format('l'),
            'utc_time' => Carbon::now()->format("Y-m-d\TH:i:s\Z"),
            'track' => $track,
            'github_file_url' => 'https://github/Rigwe19/hngx/blob/master/app/Http/Controllers/StageController.php',
            'github_repo_url' => 'https://github/Rigwe19/hngx',
            'status_code' => 200
        ]);
    }
}
