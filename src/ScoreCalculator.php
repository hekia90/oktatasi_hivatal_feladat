<?php

namespace Hekia\SimplifiedScoreCalculator;

use Hekia\SimplifiedScoreCalculator\Calculator\ValidatorResult;
use Hekia\SimplifiedScoreCalculator\Calculator\AbstractMiddleware;
use Hekia\SimplifiedScoreCalculator\Calculator\AbstractValidator;
use Hekia\SimplifiedScoreCalculator\Calculator\CalculatorResult;

final class ScoreCalculator
{
    private AbstractValidator $validator;
    private AbstractMiddleware $calculatorMiddleware;

    public function __construct(
        AbstractValidator $validator,
        AbstractMiddleware $calculatorMiddleware
    ) {
        $this->validator = $validator;
        $this->calculatorMiddleware = $calculatorMiddleware;
    }

    public function validate(Student $student): ValidatorResult
    {
        return $this->validator->check($student);
    }

    public function calculate(Student $student): CalculatorResult
    {
        $validatorResult = $this->validate($student);

        if (!$validatorResult->isValid()) {
            throw new ScoreCalculatorException($validatorResult->getMessage());
        }

        return $this->calculatorMiddleware->calculate($student);
    }
}
