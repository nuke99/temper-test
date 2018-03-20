<?php

namespace App\Http\Controllers;


use App\UsersOnboarding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function weeklyCohorts(Request $request)
    {
        $onboarding = new UsersOnboarding();
        return response()->json(['status' => true, 'data' => $onboarding->weeklyCohorts()]);
    }
}
