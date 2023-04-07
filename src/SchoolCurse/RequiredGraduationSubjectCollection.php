<?php

namespace Hekia\SimplifiedScoreCalculator\SchoolCurse;

use Hekia\SimplifiedScoreCalculator\AbstractCollection;

class RequiredGraduationSubjectCollection extends AbstractCollection
{
    protected function isValidItem($item): bool
    {
        return $item instanceof RequiredGraduationSubject;
    }
}
