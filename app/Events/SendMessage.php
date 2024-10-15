<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender, $message, $receiver, $conversation;

    public function __construct(Patient $sender, Message $message, Conversation $conversation, Doctor $receiver)
    {
        $this->sender = $sender;
        $this->message = $message;
        $this->receiver = $receiver;
        $this->conversation = $conversation;

    }

    public function broadcastWith(){
        return[
            'sender_email'=>$this->sender->email,
            'receiver_email'=>$this->receiver->email,
            'message'=>$this->message->id,
            'conversation_id'=>$this->conversation->id,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->receiver->id);
    }
}
