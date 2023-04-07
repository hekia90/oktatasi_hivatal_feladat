<?php

namespace Hekia\SimplifiedScoreCalculator;

use Hekia\SimplifiedScoreCalculator\AbstractCollection;

final class SchoolCollection extends AbstractCollection
{
    protected function isValidItem($value): bool
    {
        return $value instanceof School;
    }
}
