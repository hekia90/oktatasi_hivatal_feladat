<?php

namespace Hekia\SimplifiedScoreCalculator\Student;

use Hekia\SimplifiedScoreCalculator\AbstractCollection;
use Hekia\SimplifiedScoreCalculator\Student\ExtraPoint\LanguageExamExtraPoint;

class LanguageExamExtraPointCollection extends AbstractCollection
{
    protected function isValidItem($item): bool
    {
        return $item instanceof LanguageExamExtraPoint;
    }
}
