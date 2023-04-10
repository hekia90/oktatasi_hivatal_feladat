<?php

namespace Hekia\SimplifiedScoreCalculator\Student\ExtraPoint;

use Hekia\SimplifiedScoreCalculator\Student\ExtraPointInterface;
use Hekia\SimplifiedScoreCalculator\Student\ExtraPointCategory;
use Hekia\SimplifiedScoreCalculator\Student\ExtraPointParameter\LanguageExamType;
use Hekia\SimplifiedScoreCalculator\Student\ExtraPointParameter\LanguageExamSubject;

final class LanguageExamExtraPoint implements ExtraPointInterface
{
    private ExtraPointCategory $category;
    private LanguageExamSubject $subject;
    private LanguageExamType $type;

    public function __construct(
        ExtraPointCategory $category,
        LanguageExamSubject $subject,
        LanguageExamType $type
    ) {
        $this->category = $category;
        $this->subject = $subject;
        $this->type = $type;
    }

    public function getCategory(): ExtraPointCategory
    {
        return $this->category;
    }

    public function getSubject(): LanguageExamSubject
    {
        return $this->subject;
    }

    public function getType(): LanguageExamType
    {
        return $this->type;
    }
}
