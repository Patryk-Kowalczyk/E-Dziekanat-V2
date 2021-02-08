<?php

namespace App\MyApp\Message\Repositories;

use App\Models\Message;

class MessageRepository
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getAll()
    {
        return $this->message->get();
    }

    public function showMessage($id)
    {
        return $this->message->find($id);
    }


}
