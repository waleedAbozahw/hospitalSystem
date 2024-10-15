<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    protected $listeners=['refresh'=>'$refresh','chatUserSelected'];
    public $conversations;
    public $auth_email, $receiverUser, $selected_conversation;

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function chatUserSelected(Conversation $conversation, $receiver_id)
    {
        $this->selected_conversation = $conversation;
        $this->receiverUser = Doctor::find($receiver_id);
        if (Auth::guard('patient')->check()) {
            $this->emitTo(
                'chat.chat-box',
                'load_conversationDoctor',
                $this->selected_conversation,
                $this->receiverUser
            );
            $this->emitTo(
                'chat.send-message',
                'updateMessage',
                $this->selected_conversation,
                $this->receiverUser
            );
        } else {
            $this->emitTo(
                'chat.chat-box',
                'load_conversationPatient',
                $this->selected_conversation,
                $this->receiverUser
            );
            $this->emitTo(
                'chat.send-message',
                'updateMessage2',
                $this->selected_conversation,
                $this->receiverUser
            );
        }


    }


    public function getUsers(Conversation $conversation, $request)
    {
        if ($conversation->sender_email == $this->auth_email) {
            $this->receiverUser = Doctor::firstwhere('email', $conversation->receiver_email);
        } else {
            $this->receiverUser = Patient::firstwhere('email', $conversation->sender_email);
        }

        if (isset($request)) {
            return $this->receiverUser->$request;
        }
    }

    public function render()
    {
        $this->conversations = Conversation::where('sender_email', $this->auth_email)
            ->orwhere('receiver_email', $this->auth_email)->orderBy('created_at', 'DESC')->get();
        return view('livewire.chat.chat-list');
    }
}
