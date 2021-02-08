<?php


namespace App\MyApp\Message\Transforms;

use App\Models\Message;
use League\Fractal\TransformerAbstract;


class MessageDetailsTransformer extends TransformerAbstract
{
    public function transform(Message $message): array
    {
        return [
            'id'=> (int) $message->id,
            'title'=> (string) $message->title,
            'date'=>  $message->date,
            'text'=> $message->text,
            'added_by'=>$message->educator->getFullName()
        ];
    }

}
