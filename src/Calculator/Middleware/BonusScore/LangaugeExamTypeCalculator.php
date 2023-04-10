<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BonusScore;

use Hekia\SimplifiedScoreCalculator\Calculator\AbstractMiddleware;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;
use Hekia\SimplifiedScoreCalculator\Student;

final class LangaugeExamTypeCalculator extends AbstractMiddleware
{
    private const LANGAUGE_EXAM_TYPE_SCORE_C1 = 40;

    private const LANGAUGE_EXAM_TYPE_SCORE_B2 = 28;

    protected function doCalculate(Student $student, CalculatorResult $calculatorResult): CalculatorResult
    {
        $languageExamCollection = $student->getLanguageExamCollection();

        $bonusScores = [];
        foreach ($languageExamCollection as $extraPoint) {
            $languageExamSubject = $extraPoint->getSubject();
            $languageExamType = $extraPoint->getType();
            $languageExamName = $languageExamSubject->value;

            $score = 0;

            if ($languageExamType->isC1()) {
                $score = self::LANGAUGE_EXAM_TYPE_SCORE_C1;
            } elseif ($languageExamType->isB2()) {
                $score = self::LANGAUGE_EXAM_TYPE_SCORE_B2;
            }

            if (
                !isset($bonusScores[$languageExamName])
                || $bonusScores[$languageExamName] < $score
            ) {
                $bonusScores[$languageExamName] = $score;
            }
        }

        $bonusScore = array_sum($bonusScores);

        $calculatorResult->addBonusScore($bonusScore);

        return $calculatorResult;
    }
}
