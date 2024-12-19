<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Repository\MessageRepository;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{

    private MessageRepository $message;

    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    public function store(MessageRequest $request)
     {
        $data = $request->only(['recipient_id','content']);

        $message =  $this->message->store($data);
        $messageInfo = Message::with(['sender', 'receiver'])->find($message->id);

        return $this->success($messageInfo,201);
    }

}
