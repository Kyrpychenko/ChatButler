<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $currentUser = $request->user();

        return Inertia::render('Dashboard', compact('currentUser'));
    }
}
