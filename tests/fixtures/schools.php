<?php

use Hekia\SimplifiedScoreCalculator\GraduationSubject;
use Hekia\SimplifiedScoreCalculator\GraduationSubjectType;
use Hekia\SimplifiedScoreCalculator\School;
use Hekia\SimplifiedScoreCalculator\SchoolCollection;
use Hekia\SimplifiedScoreCalculator\SchoolCurse;
use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubject;
use Hekia\SimplifiedScoreCalculator\SchoolCurse\RequiredGraduationSubjectCollection;

return new SchoolCollection([
    new School(
        'ELTE',
        'IK',
        new SchoolCurse(
            'Programtervező informatikus',
            new RequiredGraduationSubject(GraduationSubject::MATHEMATICS),
            new RequiredGraduationSubjectCollection(
                [
                    new RequiredGraduationSubject(GraduationSubject::BIOLOGY),
                    new RequiredGraduationSubject(GraduationSubject::PHYSICS),
                    new RequiredGraduationSubject(GraduationSubject::IT),
                    new RequiredGraduationSubject(GraduationSubject::CHEMISTRY)
                ]
            )
        )
    ),
    new School(
        'PPKE',
        'BTK',
        new SchoolCurse(
            'Anglisztika',
            new RequiredGraduationSubject(GraduationSubject::ENGLISH_GRAMMAR, GraduationSubjectType::HIGH),
            new RequiredGraduationSubjectCollection(
                [
                    new RequiredGraduationSubject(GraduationSubject::FRENCH_GRAMMAR),
                    new RequiredGraduationSubject(GraduationSubject::GERMAN_GRAMMAR),
                    new RequiredGraduationSubject(GraduationSubject::ITALIAN_GRAMMAR),
                    new RequiredGraduationSubject(GraduationSubject::RUSSIAN_GRAMMAR),
                    new RequiredGraduationSubject(GraduationSubject::SPANISH_GRAMMAR),
                    new RequiredGraduationSubject(GraduationSubject::HISTORY)
                ]
            )
        )
    )
]);
