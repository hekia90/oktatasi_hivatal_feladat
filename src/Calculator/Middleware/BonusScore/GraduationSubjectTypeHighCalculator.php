<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BonusScore;

use Hekia\SimplifiedScoreCalculator\Calculator\AbstractMiddleware;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;
use Hekia\SimplifiedScoreCalculator\Student;

final class GraduationSubjectTypeHighCalculator extends AbstractMiddleware
{
    private const GRADUATION_SUBJECT_TYPE_HIGH_SCORE = 50;

    protected function doCalculate(Student $student, CalculatorResult $calculatorResult): CalculatorResult
    {
        $graduationResultCollection = $student->getGraduationResultCollection();

        $bonusScore = 0;
        foreach ($graduationResultCollection as $graduationResult) {
            $graduationSubjectType = $graduationResult->getGraduationSubjectType();

            if ($graduationSubjectType->isHigh()) {
                $bonusScore += self::GRADUATION_SUBJECT_TYPE_HIGH_SCORE;
            }
        }

        $calculatorResult->addBonusScore($bonusScore);

        return $calculatorResult;
    }
}
