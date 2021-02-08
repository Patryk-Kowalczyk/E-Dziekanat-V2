<?php


namespace App\MyApp\Message\Transforms;

use App\Models\Message;
use League\Fractal\TransformerAbstract;


class AllMessagesTransformer extends TransformerAbstract
{
    public function transform(Message $message): array
    {
        return [
            'id'=> (int) $message->id,
            'title'=> (string) $message->title,
            'date'=>  $message->date,
            'text'=> (string) substr($message->text,0,
                    strpos($message->text, ' ', 200) ).'..'
        ];
    }

}
