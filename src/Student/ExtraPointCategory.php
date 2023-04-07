<?php

namespace Hekia\SimplifiedScoreCalculator\Student;

enum ExtraPointCategory: string
{
    case LANGUAGE_EXAM = 'Nyelvvizsga';

    public function isLanguageExam(): bool
    {
        return $this === self::LANGUAGE_EXAM;
    }
}
