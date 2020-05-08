<?php


namespace Lexuss1979\Validol\Validations;


class MinValidation extends AbstractValidation implements ValidationInterface
{
    public function validate($data, $key)
    {
        $testedValue = $data[$key] ?? null;
        if (mb_strlen($testedValue) < $this->options[0]) {
            $this->error = "is too short ( minimum {$this->options[0]} characters";
            return false;
        }
        return true;
    }

}

