<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementsController extends Controller
{
    public function show_achievements()
    {
        $user = User::findOrFail(Auth::id());
        $logros = $user->achievements()->withPivot('created_at')->get();
        return view('achievements', @compact('logros'));
    }
}
