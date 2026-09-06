<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Service\ConversationService;

class ConversationController extends Controller
{
    public function __construct(private ConversationService $conversationService)
    {
    }

    public function index()
    {
        $user = auth()->user();

        return ConversationResource::collection($user->conversations()->paginate());
    }

    public function store(StoreConversationRequest $request)
    {
        $user = auth()->user();

        $conversation = $this->conversationService->createConversation(
            $user,
            $request->validated('name'),
            $request->validated('description')
        );

        return (new ConversationResource($conversation))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        return new ConversationResource($conversation);
    }

    public function update(UpdateConversationRequest $request, Conversation $conversation)
    {
        $this->authorize('update', $conversation);

        $conversation = $this->conversationService->updateConversation(
            $conversation,
            $request->validated()
        );

        return new ConversationResource($conversation);
    }

    public function destroy(Conversation $conversation)
    {
        $this->authorize('delete', $conversation);

        $this->conversationService->deleteConversation($conversation);

        return response()->noContent();
    }
}
