<?php

namespace App\MyApp\Message\Repositories;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getAll(): Collection
    {
        return $this->message->get();
    }

    public function showMessage($id):Object
    {
        return $this->message->find($id);
    }


}
