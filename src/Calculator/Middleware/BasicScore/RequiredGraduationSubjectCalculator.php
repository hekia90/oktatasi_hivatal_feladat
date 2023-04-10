<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BasicScore;

use Hekia\SimplifiedScoreCalculator\Calculator\AbstractMiddleware;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;
use Hekia\SimplifiedScoreCalculator\Student;

final class RequiredGraduationSubjectCalculator extends AbstractMiddleware
{
    protected function doCalculate(Student $student, CalculatorResult $calculatorResult): CalculatorResult
    {
        $graduationResultCollection = $student->getGraduationResultCollection();

        $school = $student->getSelectedSchool();
        $schoolCurse = $school->getCurse();

        $requiredGraduationSubject = $schoolCurse->getRequiredGraduationSubject();

        $requiredGraduationSubjectResult = $graduationResultCollection->findRequiredGraduationSubjectResult(
            $requiredGraduationSubject
        );

        $basicScore = $requiredGraduationSubjectResult->getResult() * 2;

        $calculatorResult->addBasicScore($basicScore);

        return $calculatorResult;
    }
}
