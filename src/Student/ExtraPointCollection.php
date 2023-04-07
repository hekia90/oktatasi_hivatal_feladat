<?php

namespace Hekia\SimplifiedScoreCalculator\Student;

use Hekia\SimplifiedScoreCalculator\AbstractCollection;

class ExtraPointCollection extends AbstractCollection
{
    protected function isValidItem($item): bool
    {
        return $item instanceof ExtraPoint;
    }
}
