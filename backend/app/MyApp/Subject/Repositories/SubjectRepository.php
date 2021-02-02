<?php

declare(strict_types=1);

namespace App\MyApp\Subject\Repositories;

use App\Models\Subject;


class SubjectRepository
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function getAll()
    {
        return $this->subject->get();
    }

}
