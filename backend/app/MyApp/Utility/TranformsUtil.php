<?php

namespace App\MyApp\Utility;


use App\MyApp\Grade\Transforms\FinalGradeStudentTransformer;
use App\MyApp\Grade\Transforms\PartialGradeStudentTransformer;
use App\MyApp\Plan\Transforms\CurrentDayStudentTransformer;
use App\MyApp\Subject\Transforms\SubjectWithGradesTransform;
use App\MyApp\User\Transforms\StudentDataTransformer;

class TranformsUtil
{
    const STUDENT_DATA = 0;
    const CURRENT_DAY = 1;
    const PARTIAL_GRADE = 2;
    const FINAL_GRADE = 3;
    const SUBJECTS_WITH_PARTIAL_GRADES = 4;

    public function getTransformer(int $transformerId)
    {
        switch($transformerId)
        {
            case self::STUDENT_DATA:
                return new StudentDataTransformer;
            case self::CURRENT_DAY:
                return new CurrentDayStudentTransformer;
            case self::PARTIAL_GRADE:
                return new PartialGradeStudentTransformer;
            case self::FINAL_GRADE:
                return new FinalGradeStudentTransformer;
            case self::SUBJECTS_WITH_PARTIAL_GRADES:
                return new SubjectWithGradesTransform;
            default:
                return false;
        }
    }

}
