<?php

namespace App\MyApp\Utility;


use App\MyApp\Grade\Transforms\DashboardPartialGradeStudentTransformer;
use App\MyApp\Grade\Transforms\FinalGradeStudentTransformer;
use App\MyApp\Poll\Transforms\PollListTransformer;
use App\MyApp\Plan\Transforms\CurrentDayStudentTransformer;
use App\MyApp\Subject\Transforms\SubjectWithGradesTransform;
use App\MyApp\User\Transforms\StudentDataTransformer;

class TranformsUtil
{
    const STUDENT_DATA = 0;
    const CURRENT_DAY = 1;
    const DASHBOARD_PARTIAL_GRADE = 2;
    const FINAL_GRADE = 3;
    const SUBJECTS_WITH_PARTIAL_GRADES = 4;
    const POLL_LIST = 5;

    public function getTransformer(int $transformerId)
    {
        switch($transformerId)
        {
            case self::STUDENT_DATA:
                return new StudentDataTransformer;
            case self::CURRENT_DAY:
                return new CurrentDayStudentTransformer;
            case self::DASHBOARD_PARTIAL_GRADE:
                return new DashboardPartialGradeStudentTransformer;
            case self::FINAL_GRADE:
                return new FinalGradeStudentTransformer;
            case self::SUBJECTS_WITH_PARTIAL_GRADES:
                return new SubjectWithGradesTransform;
            case self::POLL_LIST:
                return new PollListTransformer;
            default:
                return false;
        }
    }

}
