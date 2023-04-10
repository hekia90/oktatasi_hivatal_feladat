<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Validator;

use Hekia\SimplifiedScoreCalculator\Calculator\AbstractValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\ValidatorResult;
use Hekia\SimplifiedScoreCalculator\Student;

final class RequiredGraduationSubjectValidator extends AbstractValidator
{
    protected function doCheck(Student $student): ValidatorResult
    {
        $graduationResultCollection = $student->getGraduationResultCollection();

        $school = $student->getSelectedSchool();
        $schoolCurse = $school->getCurse();
        $requiredGraduationSubject = $schoolCurse->getRequiredGraduationSubject();

        $graduationSubjectResult = $graduationResultCollection
            ->findRequiredGraduationSubjectResult($requiredGraduationSubject);

        if (!$graduationSubjectResult) {
            $requiredGraduationSubjectTitle = $requiredGraduationSubject->getTitle();
            $schoolTitle = $school->getTitle();

            return new ValidatorResult(
                false,
                'A(z) ' . $schoolTitle . ' szakon kötelező érettségi tantárgy' .
                ' egyiket sem végezte el: ' . $requiredGraduationSubjectTitle
            );
        }

        return new ValidatorResult();
    }
}
