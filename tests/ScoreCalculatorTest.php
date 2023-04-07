<?php

namespace Tests;

use Hekia\SimplifiedScoreCalculator\ScoreCalculator;
use Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BasicScore\RequiredGraduationSubjectCalculator;
use Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BasicScore\BestRequiredSelectableGraduationSubjectCalculator;
use Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BonusScore\GraduationSubjectTypeHighCalculator;
use Hekia\SimplifiedScoreCalculator\Calculator\Middleware\BonusScore\LangaugeExamTypeCalculator;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;
use Hekia\SimplifiedScoreCalculator\Calculator\Validator\GraduationResultMinNotReachValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\Validator\RequiredDefaultGraduationSubjectsValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\Validator\RequiredGraduationSubjectValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\Validator\RequiredSelectableGraduationSubjectsValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\ValidatorResult;
use Hekia\SimplifiedScoreCalculator\ScoreCalculatorException;
use Hekia\SimplifiedScoreCalculator\Student;
use PHPUnit\Framework\TestCase;

/**
 * ScoreCalculatorTest
 */
class ScoreCalculatorTest extends TestCase
{
    private ScoreCalculator $calculator;

    protected function setUp(): void
    {
        $validator = new GraduationResultMinNotReachValidator();
        $validator->linkWith(new RequiredDefaultGraduationSubjectsValidator())
                  ->linkWith(new RequiredGraduationSubjectValidator())
                  ->linkWith(new RequiredSelectableGraduationSubjectsValidator());

        $calculatorMiddleware = new RequiredGraduationSubjectCalculator();
        $calculatorMiddleware->linkWith(new BestRequiredSelectableGraduationSubjectCalculator())
                             ->linkWith(new GraduationSubjectTypeHighCalculator())
                             ->linkWith(new LangaugeExamTypeCalculator());


        $this->calculator = new ScoreCalculator($validator, $calculatorMiddleware);
    }

    public static function loadSuccessDummyDatas(): array
    {
        return require __DIR__ . '/fixtures/calculator_success_student_datas.php';
    }

    public static function loadUnsuccessDummyDatas(): array
    {
        return require __DIR__ . '/fixtures/calculator_unsuccess_student_datas.php';
    }

    /**
     * @dataProvider loadSuccessDummyDatas
     */
    public function testSuccessCalculate(
        Student $student,
        CalculatorResult $expectedCalculatorResult
    ) {
        $actualCalculatorResult = $this->calculator->calculate($student);

        $this->assertSame(
            $expectedCalculatorResult->getBasicScore(),
            $actualCalculatorResult->getBasicScore(),
            'Basic Score'
        );

        $this->assertSame(
            $expectedCalculatorResult->getBonusScore(),
            $actualCalculatorResult->getBonusScore(),
            'Bonus Score'
        );

        $this->assertSame(
            $expectedCalculatorResult->getTotalScore(),
            $actualCalculatorResult->getTotalScore(),
            'Total Score'
        );
    }

    /**
     * @dataProvider loadUnsuccessDummyDatas
     */
    public function testUnsuccessCalculate(
        Student $student,
        ValidatorResult $validatorResult
    ) {
        $this->expectException(ScoreCalculatorException::class);
        $this->calculator->calculate($student);
    }

    /**
     * @dataProvider loadUnsuccessDummyDatas
     */
    public function testUnsuccessValidatorResult(
        Student $student,
        ValidatorResult $expectedValidatorResult
    ) {
        $actualValidatorResult = $this->calculator->validate($student);

        $this->assertSame(
            $expectedValidatorResult->isValid(),
            $actualValidatorResult->isValid(),
            'Validator result - is valid'
        );

        $this->assertSame(
            $expectedValidatorResult->getMessage(),
            $actualValidatorResult->getMessage(),
            'Validator result - message'
        );
    }

    /**
     * @dataProvider loadSuccessDummyDatas
     */
    public function testSuccessValidatorResult(
        Student $student,
        CalculatorResult $expectedCalculatorResult
    ) {
        $actualValidatorResult = $this->calculator->validate($student);

        $expectedValidatorResult = new ValidatorResult();

        $this->assertSame(
            $expectedValidatorResult->isValid(),
            $actualValidatorResult->isValid(),
            'Validator result - is valid'
        );

        $this->assertSame(
            $expectedValidatorResult->getMessage(),
            $actualValidatorResult->getMessage(),
            'Validator result - message'
        );
    }
}
