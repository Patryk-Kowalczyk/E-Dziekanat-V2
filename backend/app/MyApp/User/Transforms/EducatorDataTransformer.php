<?php

namespace App\MyApp\User\Transforms;

use App\Models\Educator;
use League\Fractal\TransformerAbstract;

class EducatorDataTransformer extends TransformerAbstract
{
    public function transform(Educator $educator): array
    {
        return [
            'full_name'=> (string) $educator->getFullName(),
            'profile_picture'=> (string) $educator->user->profile_picture,
            'address'=> (string) $educator->user->address,
            'phone'=> (string) $educator->user->phone,
            'email'=> (string) $educator->user->email,
        ];
    }

}
