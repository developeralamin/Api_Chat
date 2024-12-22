<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Repository\MessageRepository;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    private MessageRepository $message;

    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\MessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MessageRequest $request)
     {
        $data = $request->only(['recipient_id','content']);

        $message =  $this->message->store($data);
        $messageInfo = Message::with(['sender', 'receiver'])->find($message->id);

        return $this->success($messageInfo,201);
    }

    /**
     * Summary of deleiverd message
     * @param mixed $id
     * @return void
     */
    public function markAsDelivered($id)
    {
        $message = Message::find($id);

        if($message->status == 'sent'){
            $message->status = "delivered";
            $message->save();
        }

        return $this->success($message,200);
    }

     /**
     * Summary of markAsRead message
     * @param mixed $id
     * @return void
     */
    public function markAsRead($id)
    {
        $message = Message::find($id);

        if($message->status !== 'read'){
            $message->status = "read";
            $message->save();
        }

        return $this->success($message,200);
    }

}
