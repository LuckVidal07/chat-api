<?php

namespace App\Service;

use App\Models\Conversation;
use App\Models\User;

class ConversationService
{
    public function createConversation (User $user, string $name, ?string $description = null): Conversation
    {
        return Conversation::create([
            'name' => $name,
            'description' => $description,
            'created_by' => $user->id,
        ]);
    }

    public function updateConversation(Conversation $conversation, array $data): Conversation
    {
        $conversation->update($data);

        return $conversation->fresh();
    }

    public function deleteConversation (Conversation $conversation): void
    {
        $conversation->delete();
    }
}
