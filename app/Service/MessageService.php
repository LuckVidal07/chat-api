<?php

namespace App\Service;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class MessageService
{
    public function createMessage(Conversation $conversation, User $user, string $message): Message
    {
        return $conversation->messages()->create([
            'sender_id' => $user->id,
            'message' => $message
        ]);
    }

    public function update(Message $message, array $data): Message
    {
        $message->update($data);

        return $message;
    }
}
