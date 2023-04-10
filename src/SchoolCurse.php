<?php

namespace Hekia\SimplifiedScoreCalculator;

use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubject;
use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubjectCollection;

final class SchoolCurse
{
    private string $name;
    private RequiredGraduationSubject $requiredGraduationSubject;
    private RequiredGraduationSubjectCollection $requiredSelectableGraduationSubjects;

    public function __construct(
        string $name,
        RequiredGraduationSubject $requiredGraduationSubject,
        RequiredGraduationSubjectCollection $requiredSelectableGraduationSubjects
    ) {
        $this->name = $name;
        $this->requiredGraduationSubject = $requiredGraduationSubject;
        $this->requiredSelectableGraduationSubjects = $requiredSelectableGraduationSubjects;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRequiredGraduationSubject(): RequiredGraduationSubject
    {
        return $this->requiredGraduationSubject;
    }

    public function getRequiredSelectableGraduationSubjects(): RequiredGraduationSubjectCollection
    {
        return $this->requiredSelectableGraduationSubjects;
    }
}
