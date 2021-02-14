<?php

namespace App\MyApp\Meeting\Repositories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Collection;

class MeetingRepository
{
    protected $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function getAll(): Collection
    {
        return $this->meeting->get();
    }

    public function getEducatorMeetings($id): Collection
    {
        return $this->getAll()->where('educator_id', $id);
    }
}
