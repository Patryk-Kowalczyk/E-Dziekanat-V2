<?php


namespace App\MyApp\User\Transforms;


use App\Models\Educator;
use League\Fractal\TransformerAbstract;

class EducatorDataTransformer extends TransformerAbstract
{
    public function transform(Educator $educator): array
    {
        return [
            'first_name'=> (string) $educator->user->first_name,
            'last_name'=> (string) $educator->user->last_name,
            'title'=> (string) $educator->title,
            'profile_picture'=> (string) $educator->user->profile_picture,
            'address'=> (string) $educator->user->address,
            'phone'=> (string) $educator->user->phone,
            'email'=> (string) $educator->user->email,
        ];
    }

}
