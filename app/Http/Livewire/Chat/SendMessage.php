<?php

namespace App\Http\Livewire\Chat;

use App\Events\SendMessage as EventsSendMessage;
use App\Events\SendMessage2;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Livewire\Component;

class SendMessage extends Component
{

    public $body, $createMessage;
    public $receiverUser, $selected_conversation, $auth_email, $sender;
    protected $listeners = ['updateMessage','updateMessage2', 'dispatchSendMessage'];
    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->sender = Auth::guard('patient')->user();
        } else {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->sender = Auth::guard('doctor')->user();
        }
    }
    public function updateMessage(Conversation $conversation, Doctor $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
    }
    public function updateMessage2(Conversation $conversation, Patient $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
    }
    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }
        $this->createMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_email' =>  $this->auth_email,
            'receiver_email' =>  $this->receiverUser->email,
            'body' => $this->body,
        ]);
        $this->selected_conversation->last_time_message = $this->createMessage->created_at;
        $this->selected_conversation->save();
        $this->reset('body');
        $this->emitTo('chat.chat-box', 'pushMessage', $this->createMessage->id);
        $this->emitTo('chat.chat-list', 'refresh');
        $this->emitSelf('dispatchSendMessage');
    }
    public function dispatchSendMessage()
    {
        if (Auth::guard('patient')->check()) {
            broadcast(new EventsSendMessage(
                $this->sender,
                $this->createMessage,
                $this->selected_conversation,
                $this->receiverUser,
            ));
        } else {
            broadcast(new SendMessage2(
                $this->sender,
                $this->createMessage,
                $this->selected_conversation,
                $this->receiverUser,
            ));
        }
    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
