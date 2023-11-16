<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $currentUser = $request->user();
        $messages = Message::with('chat')->get();
        return Inertia::render('Dashboard', compact('currentUser', 'messages'));
    }
}
