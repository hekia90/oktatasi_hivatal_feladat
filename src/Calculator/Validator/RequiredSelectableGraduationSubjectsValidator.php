<?php

namespace Hekia\SimplifiedScoreCalculator\Calculator\Validator;

use Hekia\SimplifiedScoreCalculator\Calculator\AbstractValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\ValidatorResult;
use Hekia\SimplifiedScoreCalculator\Student;

final class RequiredSelectableGraduationSubjectsValidator extends AbstractValidator
{
    protected function doCheck(Student $student): ValidatorResult
    {
        $graduationResultCollection = $student->getGraduationResultCollection();

        $school = $student->getSelectedSchool();
        $schoolCurse = $school->getSchoolCurse();
        $requiredSelectableSubjects = $schoolCurse->getRequiredSelectableGraduationSubjects();

        $selectedGraduationSubjectResults = $graduationResultCollection
            ->filterRequiredSelectableGraduationSubjectResults(
                $requiredSelectableSubjects
            );

        if (empty($selectedGraduationSubjectResults)) {
            $requiredGraduationSubjectTitles = [];

            foreach ($requiredSelectableSubjects as $requiredGraduationSubject) {
                $requiredGraduationSubjectTitles[] = $requiredGraduationSubject->getTitle();
            }

            $graduationSubjectTitles = implode(', ', $requiredGraduationSubjectTitles);
            $schoolTitle = $school->getTitle();

            return new ValidatorResult(
                false,
                'A(z) ' . $schoolTitle . ' szakon kötelezően választható érettségi tantárgyak közül' .
                ' egyiket sem végezte el: ' . $graduationSubjectTitles
            );
        }

        return new ValidatorResult();
    }
}
