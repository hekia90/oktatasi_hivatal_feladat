<?php

namespace Hekia\SimplifiedScoreCalculator;

use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubject;
use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubjectCollection;

final class SchoolCurse
{
    private string $name;
    private RequiredGraduationSubject $requiredSubject;
    private RequiredGraduationSubjectCollection $requiredSelectableSubjects;

    public function __construct(
        string $name,
        RequiredGraduationSubject $requiredSubject,
        RequiredGraduationSubjectCollection $requiredSelectableSubjects
    ) {
        $this->name = $name;
        $this->requiredSubject = $requiredSubject;
        $this->requiredSelectableSubjects = $requiredSelectableSubjects;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRequiredGraduationSubject(): RequiredGraduationSubject
    {
        return $this->requiredSubject;
    }

    public function getRequiredSelectableGraduationSubjects(): RequiredGraduationSubjectCollection
    {
        return $this->requiredSelectableSubjects;
    }
}
