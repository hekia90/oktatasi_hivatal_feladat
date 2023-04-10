<?php

namespace Hekia\SimplifiedScoreCalculator;

use Hekia\SimplifiedScoreCalculator\Student\LanguageExamExtraPointCollection;
use Hekia\SimplifiedScoreCalculator\Student\GraduationResultCollection;

final class Student
{
    private School $selectedSchool;
    private GraduationResultCollection $graduationResults;
    private LanguageExamExtraPointCollection $languageExamExtraPointCollection;

    public function __construct(
        School $selectedSchool,
        GraduationResultCollection $graduationResults,
        LanguageExamExtraPointCollection $languageExamExtraPointCollection
    ) {
        $this->selectedSchool = $selectedSchool;
        $this->graduationResults = $graduationResults;
        $this->languageExamExtraPointCollection = $languageExamExtraPointCollection;
    }

    public function getSelectedSchool(): School
    {
        return $this->selectedSchool;
    }

    public function getGraduationResultCollection(): GraduationResultCollection
    {
        return $this->graduationResults;
    }

    public function getLanguageExamCollection(): LanguageExamExtraPointCollection
    {
        return $this->languageExamExtraPointCollection;
    }

    public static function builder(SchoolCollection $schools): StudentBuilder
    {
        return new StudentBuilder($schools);
    }
}
