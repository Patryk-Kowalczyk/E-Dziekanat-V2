<?php

namespace App\MyApp\User\Repositories;

use App\Models\Educator;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $student;
    protected $educator;
    protected $user;

    public function __construct(Student $student, Educator $educator, User $user)
    {
        $this->user = $user;
        $this->student = $student;
        $this->educator = $educator;
    }

    public function getUserId(): int
    {
        return $this->user->where('id', Auth::id())->select('id')->first();
    }

    public function getUserData(): Model
    {
        return $this->user->find(Auth::id());
    }

    public function getUserStatus(): object
    {
        return $this->user->where('id', Auth::id())->select('status')->first();
    }

    public function updateData($data): bool
    {
        $user = $this->getUserData();
        $user->phone = $data['phone'] ?? $user->phone;;
        $user->email = $data['email'] ?? $user->email;
        return $user->save();
    }

    public function findOrFailUser(): object
    {
        return $this->user->findOrFail(Auth::id());
    }

    #============================ STUDENT ============================#

    public function getStudentData(): object
    {
        return $this->student->where('id', $this->getStudentId())->first();
    }

    public function getStudentId(): int
    {
        return $this->student->where('user_id', Auth::id())->first()->id;
    }

    public function getStudentIdByAlbum($album): int
    {
        return $this->student->where('album', $album)->first()->id;
    }

    #============================ EDUCATOR ============================#

    public function getEducatorData(): object
    {
        return $this->educator->where('id', $this->getEducatorId())->first();
    }

    public function getEducatorId(): int
    {
        return $this->educator->where('user_id', Auth::id())->first()->id;
    }
}
