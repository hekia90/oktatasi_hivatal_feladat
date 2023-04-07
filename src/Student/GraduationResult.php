<?php

namespace Hekia\SimplifiedScoreCalculator\Student;

use Hekia\SimplifiedScoreCalculator\GraduationSubject;
use Hekia\SimplifiedScoreCalculator\GraduationSubjectType;

class GraduationResult
{
    private GraduationSubject $graduationSubject;
    private GraduationSubjectType $graduationSubjectType;
    private int $result;

    public function __construct(
        GraduationSubject $graduationSubject,
        GraduationSubjectType $graduationSubjectType,
        int $result
    ) {
        $this->result = $result;
        $this->graduationSubject = $graduationSubject;
        $this->graduationSubjectType = $graduationSubjectType;
    }

    public function getResult(): int
    {
        return $this->result;
    }

    public function getGraduationSubject(): GraduationSubject
    {
        return $this->graduationSubject;
    }

    public function getGraduationSubjectType(): GraduationSubjectType
    {
        return $this->graduationSubjectType;
    }
}
