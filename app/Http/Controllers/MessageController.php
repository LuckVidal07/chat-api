<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Service\MessageService;

class MessageController extends Controller
{
    public function __construct(private MessageService $messageService) {}

    public function index(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        return response()->json($conversation->messages);
    }

    public function store(StoreMessageRequest $request, Conversation $conversation)
    {
        $user = auth()->user();

        $this->authorize('create', [Message::class, $conversation]);

        $message = $this->messageService->createMessage(
            $conversation,
            $user,
            $request->validated('message')
        );

        return response()->json($message, 201);
    }

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $this->authorize('update', $message);

        $message = $this->messageService->update(
            $message,
            $request->validated()
        );

        return response()->json($message);
    }
}
