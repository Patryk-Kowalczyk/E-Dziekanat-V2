<?php

namespace App\MyApp\Meeting\Repositories;

use App\Models\Meeting;


class MeetingRepository
{
    protected $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function getAll()
    {
        return $this->meeting->get();
    }

    public function getEducatorMeetings($id)
    {
        return $this->getAll()->where('educator_id', $id);
    }


}
