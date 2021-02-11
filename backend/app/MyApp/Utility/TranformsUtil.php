<?php

namespace App\MyApp\Utility;


use App\MyApp\Grade\Transforms\DashboardPartialGradeStudentTransformer;
use App\MyApp\Subject\Transforms\EducatorPanelSubjectsWithFinalGradesTransformer;
use App\MyApp\Grade\Transforms\FinalGradeEducatorPanelTransformer;
use App\MyApp\Grade\Transforms\FinalGradeStudentTransformer;
use App\MyApp\Message\Transforms\AllMessagesTransformer;
use App\MyApp\Message\Transforms\MessageDetailsTransformer;
use App\MyApp\Plan\Transforms\SelectedDayPlanTransformer;
use App\MyApp\Poll\Transforms\PollListTransformer;
use App\MyApp\Subject\Transforms\EducatorPanelSubjectsWithPartialGradesTransformer;
use App\MyApp\Subject\Transforms\SubjectChoiceQuestionDetailsTransform;
use App\MyApp\Subject\Transforms\SubjectWithGradesTransform;
use App\MyApp\User\Transforms\EducatorDataTransformer;
use App\MyApp\User\Transforms\StudentDataTransformer;

class TranformsUtil
{

    const SELECTED_DAY = 1;
    const DASHBOARD_PARTIAL_GRADE = 2;
    const FINAL_GRADE = 3;
    const SUBJECTS_WITH_PARTIAL_GRADES = 4;
    const POLL_LIST = 5;
    const CHOICE_OPTION = 6;
    const MESSAGES_LIST = 7;
    const MESSAGE_DETAILS = 8;
    const STUDENT_DATA = 9;
    const EDUCATOR_DATA = 10;
    const EDUCATOR_PANEL_SUBJECTS_FINAL_GRADES = 11;
    const EDUCATOR_PANEL_SUBJECTS_PARTIAL_GRADES = 12;

    public function getTransformer(int $transformerId)
    {
        switch ($transformerId) {

            case self::SELECTED_DAY:
                return new SelectedDayPlanTransformer();
            case self::DASHBOARD_PARTIAL_GRADE:
                return new DashboardPartialGradeStudentTransformer;
            case self::FINAL_GRADE:
                return new FinalGradeStudentTransformer;
            case self::SUBJECTS_WITH_PARTIAL_GRADES:
                return new SubjectWithGradesTransform;
            case self::POLL_LIST:
                return new PollListTransformer;
            case self::CHOICE_OPTION:
                return new SubjectChoiceQuestionDetailsTransform;
            case self::MESSAGES_LIST:
                return new AllMessagesTransformer;
            case self::MESSAGE_DETAILS:
                return new MessageDetailsTransformer;
            case self::STUDENT_DATA:
                return new StudentDataTransformer;
            case self::EDUCATOR_DATA:
                return new EducatorDataTransformer;
            case self::EDUCATOR_PANEL_SUBJECTS_FINAL_GRADES:
                return new EducatorPanelSubjectsWithFinalGradesTransformer;
            case self::EDUCATOR_PANEL_SUBJECTS_PARTIAL_GRADES:
                return new EducatorPanelSubjectsWithPartialGradesTransformer;
            default:
                return false;
        }
    }

}
