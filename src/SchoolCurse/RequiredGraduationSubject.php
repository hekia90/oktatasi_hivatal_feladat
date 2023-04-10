<?php

namespace Hekia\SimplifiedScoreCalculator\SchoolCurse;

use Hekia\SimplifiedScoreCalculator\GraduationSubject;
use Hekia\SimplifiedScoreCalculator\GraduationSubjectType;

class RequiredGraduationSubject
{
    private GraduationSubject $subject;
    private GraduationSubjectType $subjectType;

    public function __construct(
        GraduationSubject $subject,
        GraduationSubjectType $subjectType = GraduationSubjectType::MEDIUM
    ) {
        $this->subject = $subject;
        $this->subjectType = $subjectType;
    }

    public function getTitle(): string
    {
        $subjectTypeIsHigh = $this->subjectType->isHigh();
        $subjectTypeValue = $this->subjectType->value;
        $subjectValue = $this->subject->value;

        return $subjectValue . ($subjectTypeIsHigh ? '(' . $subjectTypeValue . ')' : '');
    }

    public function isAvailable(
        GraduationSubject $actualSubject,
        GraduationSubjectType $actualSubjectType
    ): bool {
        return $actualSubject === $this->subject
               && (
                    $this->subjectType !== GraduationSubjectType::HIGH
                    || $actualSubjectType === $this->subjectType
               );
    }
}
