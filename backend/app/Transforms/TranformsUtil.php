<?php

namespace App\Transforms;

use App\Transforms\Plan\CurrentDayStudentTransformer;

class TranformsUtil
{
    const STUDENT_DATA = 0;
    const CURRENT_DAY = 1;
    const PARTIAL_GRADE = 2;
    const FINAL_GRADE = 3;

    public function getTransformer(int $transformerId)
    {
        switch($transformerId)
        {
            case self::STUDENT_DATA:
                return new StudentDataTransformer();
            case self::CURRENT_DAY:
                return new CurrentDayStudentTransformer();
            case self::PARTIAL_GRADE:
                return new PartialGradeStudentTransformer();
            case self::FINAL_GRADE:
                return new FinalGradeStudentTransformer();
            default:
                return false;
        }
    }

}
