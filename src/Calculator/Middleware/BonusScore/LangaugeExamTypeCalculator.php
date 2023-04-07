<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BonusScore;

use Hekia\SimplifiedScoreCalculator\Student\ExtraPointParameterName;
use Hekia\SimplifiedScoreCalculator\Calculator\AbstractMiddleware;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;
use Hekia\SimplifiedScoreCalculator\Student;
use Hekia\SimplifiedScoreCalculator\Student\ExtraPointParameter\LanguageExamSubject;
use Hekia\SimplifiedScoreCalculator\Student\ExtraPointParameter\LanguageExamType;

final class LangaugeExamTypeCalculator extends AbstractMiddleware
{
    private const LANGAUGE_EXAM_TYPE_SCORE_C1 = 40;

    private const LANGAUGE_EXAM_TYPE_SCORE_B2 = 28;

    protected function doCalculate(Student $student, CalculatorResult $defaultCalculatorResult): CalculatorResult
    {
        $extraPointCollection = $student->getExtraPointCollection();

        $bonusScores = [];
        foreach ($extraPointCollection as $extraPoint) {
            if ($extraPoint->getCategory()->isLanguageExam()) {
                /**
                 * @var LanguageExamSubject $languageExamSubject
                 * @var LanguageExamType $languageExamType
                 */
                $languageExamSubject = $extraPoint->getParameter(ExtraPointParameterName::LANGUAGE_EXAM_SUBJECT);
                $languageExamType = $extraPoint->getParameter(ExtraPointParameterName::LANGUAGE_EXAM_TYPE);
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
        }

        $bonusScore = array_sum($bonusScores);

        $defaultCalculatorResult->addBonusScore($bonusScore);

        return $defaultCalculatorResult;
    }
}
