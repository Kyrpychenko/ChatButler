<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $message = Message::create([
            'text' => $validated['text'],
            'sent' => Carbon::now(),
            'type' => 'user',
            'chat_id' => 1
        ]);

        $prompt = collect(Message::latest()->limit(6)->get())->map(function ($message) {
            return $message["type"] . ': ' . str_replace("\n", " ", $message["text"]);
        })->join("\n");
        $result = shell_exec("/usr/local/python/current/bin/python /workspaces/ChatButler/main.py " . escapeshellarg($prompt));

        $message = Message::create([
            'text' => $result,
            'sent' => Carbon::now(),
            'type' => 'assistant',
            'chat_id' => 1
        ]);
        return back();
    }
}
