<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BasicScore;

use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubjectCollection;
use Hekia\SimplifiedScoreCalculator\Calculator\AbstractMiddleware;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;
use Hekia\SimplifiedScoreCalculator\Student;
use Hekia\SimplifiedScoreCalculator\Student\GraduationResult;
use Hekia\SimplifiedScoreCalculator\Student\GraduationResultCollection;

final class BestRequiredSelectableGraduationSubjectCalculator extends AbstractMiddleware
{
    private function findBestRequiredSelectableGraduationSubjectResult(
        RequiredGraduationSubjectCollection $requiredSelectableSubjects,
        GraduationResultCollection $graduationResultCollection
    ): ?GraduationResult {
        $filteredGraduationResults = $graduationResultCollection->filterRequiredSelectableGraduationSubjectResults(
            $requiredSelectableSubjects
        );

        $maxScore = 0;
        $selectedRequiredGraduationSubject = null;

        foreach ($filteredGraduationResults as $filteredGraduationResult) {
            $graduationResult = $filteredGraduationResult->getResult();
            if ($graduationResult > $maxScore) {
                $maxScore = $graduationResult;
                $selectedRequiredGraduationSubject = $filteredGraduationResult;
            }
        }

        return $selectedRequiredGraduationSubject;
    }

    protected function doCalculate(Student $student, CalculatorResult $calculatorResult): CalculatorResult
    {
        $graduationResultCollection = $student->getGraduationResultCollection();

        $school = $student->getSelectedSchool();
        $schoolCurse = $school->getCurse();

        $requiredSelectableSubjects = $schoolCurse->getRequiredSelectableGraduationSubjects();

        $bestRequiredSelectableGraduationSubjectResults = $this->findBestRequiredSelectableGraduationSubjectResult(
            $requiredSelectableSubjects,
            $graduationResultCollection
        );

        $basicScore = $bestRequiredSelectableGraduationSubjectResults->getResult() * 2;

        $calculatorResult->addBasicScore($basicScore);

        return $calculatorResult;
    }
}
