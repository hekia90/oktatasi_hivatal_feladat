<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Validator;

use Hekia\SimplifiedScoreCalculator\Calculator\AbstractValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\ValidatorResult;
use Hekia\SimplifiedScoreCalculator\GraduationSubject;
use Hekia\SimplifiedScoreCalculator\Student;
use Hekia\SimplifiedScoreCalculator\Student\GraduationResult;

final class RequiredDefaultGraduationSubjectsValidator extends AbstractValidator
{
    private const REQUIRED_GRADUATION_SUBJECTS = [
        GraduationSubject::HUNGARIAN_GRAMMAR_AND_LITERATURE,
        GraduationSubject::HISTORY,
        GraduationSubject::MATHEMATICS
    ];

    protected function doCheck(Student $student): ValidatorResult
    {
        $graduationResultCollection = $student->getGraduationResultCollection();

        $hasNotRequiredGraduationSubjectValues = [];
        foreach (self::REQUIRED_GRADUATION_SUBJECTS as $requiredGraduationSubject) {
            $hasRequiredGraduationSubject = $graduationResultCollection
                ->containsWithConditionCallback(
                    function (GraduationResult $item) use ($requiredGraduationSubject) {
                        return $requiredGraduationSubject === $item->getGraduationSubject();
                    }
                );

            if (!$hasRequiredGraduationSubject) {
                $hasNotRequiredGraduationSubjectValues[] = $requiredGraduationSubject->value;
            }
        }

        if (!empty($hasNotRequiredGraduationSubjectValues)) {
            $graduationSubjectValues = implode(', ', $hasNotRequiredGraduationSubjectValues);

            return new ValidatorResult(
                false,
                'A kötelező érettségi tantárgyak közül nem végezte el az alábbiakat: ' . $graduationSubjectValues
            );
        }

        return new ValidatorResult();
    }
}
