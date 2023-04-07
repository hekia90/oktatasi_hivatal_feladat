<?php

namespace Hekia\SimplifiedScoreCalculator\Student;

use Hekia\SimplifiedScoreCalculator\AbstractCollection;
use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubject;
use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubjectCollection;
use Hekia\SimplifiedScoreCalculator\Student\GraduationResult;

class GraduationResultCollection extends AbstractCollection
{
    protected function isValidItem($item): bool
    {
        return $item instanceof GraduationResult;
    }

    public function findRequiredGraduationSubjectResult(RequiredGraduationSubject $requiredSubject): ?GraduationResult
    {
        $graduationSubject = $this->findWithCallback(
            function (GraduationResult $item) use ($requiredSubject) {
                $graduationSubject = $item->getGraduationSubject();
                $graduationSubjectType = $item->getGraduationSubjectType();

                return $requiredSubject->isAvailable(
                    $graduationSubject,
                    $graduationSubjectType
                );
            }
        );

        return $graduationSubject;
    }

    public function filterRequiredSelectableGraduationSubjectResults(
        RequiredGraduationSubjectCollection $requiredSelectableSubjects
    ): array {
        $filteredCollection = [];
        foreach ($requiredSelectableSubjects as $requiredGraduationSubject) {
            $graduationSubjectResult = $this->findWithCallback(
                function (GraduationResult $item) use ($requiredGraduationSubject) {
                    $graduationSubject = $item->getGraduationSubject();
                    $graduationSubjectType = $item->getGraduationSubjectType();

                    return $requiredGraduationSubject->isAvailable($graduationSubject, $graduationSubjectType);
                }
            );

            if ($graduationSubjectResult) {
                $filteredCollection[] = $graduationSubjectResult;
            }
        }

        return $filteredCollection;
    }
}
