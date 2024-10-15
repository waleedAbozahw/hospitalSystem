<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreatChat extends Component
{
    public $users, $auth_email;

    public function mount()
    {

        $this->auth_email = auth()->user()->email;
    }
    public function creatConversation($receiver_email)
    {
        $check_conversation = Conversation::where('sender_email', $this->auth_email)
            ->where('receiver_email', $receiver_email)->orwhere('receiver_email', $this->auth_email)
            ->where('sender_email', $receiver_email)->get();
        if ($check_conversation->isEmpty()) {
            DB::beginTransaction();
            try {
                // creatConversation
                $creatConversation = Conversation::create([
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'last_time_message' => null,
                ]);
                // createMessage
                $creatMessage = Message::create([
                    'conversation_id' => $creatConversation->id,
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => 'السلام عليكم',
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['errors' => $e->getMessage()]);
            }
        } else {
            dd('this conversation exists');
        }
    }

    public function render()
    {
        if (Auth::guard('patient')->check()) {
            $this->users = Doctor::all();
        } else {
            $this->users = Patient::all();
        }
        return view('livewire.chat.creat-chat')->extends('dashboard.layouts.master');
    }
}
