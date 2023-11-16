<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $currentUser = $request->user();
        $messages = Message::with('chat')->get();
        return Inertia::render('Dashboard', compact('currentUser', 'messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'sent' => 'date'
        ]);

        $message = Message::create([
            'text' => $validated['text'],
            'sent' => $validated['sent'],
            'type' => 'user',
            'chat_id' => 1
        ]);
        return back();
    }
}
