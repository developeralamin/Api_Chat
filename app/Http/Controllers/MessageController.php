<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
     {
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->recipient_id = $request->recipient_id;
        $message->content = $request->content;
        $message->status = 'sent';
        $message->save();

        $updatedMessage = Message::with(['sender', 'receiver'])->find($message->id);

        return response()->json(data: ['status' => true, 'message' => $updatedMessage], status: 201);
    }

}
