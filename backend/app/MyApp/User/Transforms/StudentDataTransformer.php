<?php


namespace App\MyApp\User\Transforms;


use App\Models\Student;
use League\Fractal\TransformerAbstract;

class StudentDataTransformer extends TransformerAbstract
{
    public function transform(Student $student): array
    {
        return [
            'first_name'=> (string) $student->user->first_name,
            'last_name'=> (string) $student->user->last_name,
            'album'=> (string) $student->album,
            'profile_picture'=> (string) $student->user->profile_picture,
            'group'=> (string) $student->group->name,
        ];
    }

}
