<?php 

namespace App\Repository;

use App\Models\Message;

class MessageRepository
{
    /**
     * Store message
     */
    public function store(array $data)  
    {
        $data['sender_id'] = auth()->user()->id;
        $data['status']    = 'sent';

        return Message::create($data);
    }
}