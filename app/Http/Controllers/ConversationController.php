<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        return Conversation::all();
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string'],
        ]);

        $conversation = Conversation::create($data);

        return response()->json($conversation, 201);
    }

    public function show(Conversation $conversation)
    {
        return response()->json($conversation);
    }
}