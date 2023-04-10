<?php

namespace Hekia\SimplifiedScoreCalculator\Student;

use Hekia\SimplifiedScoreCalculator\Student\ExtraPointCategory;

interface ExtraPointInterface
{
    public function getCategory(): ExtraPointCategory;
}
