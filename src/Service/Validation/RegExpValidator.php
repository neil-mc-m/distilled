<?php
/**
* Created by PhpStorm.
 * User: neil
* Date: 11/12/2017
* Time: 14:33
*/

namespace Distilled\Service\Validation;

/**
 * A regular expression validator.
 *
 * Class RegExpValidator
 * @package Distilled\Service\Validation
 */
class RegExpValidator implements ValidatorInterface
{

    /**
     * Input
     *
     * @var
     */
    protected $input;

    /**
     * Validation rules
     * @var
     */
    protected $rules;

    /**
     * Instantiate with the input
     *
     * RegExpValidator constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Set the rules which should be a regular expression.
     *
     * @param $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * Validate and return a boolean.
     *
     * @return bool
     */
    public function validate()
    {
        if (!preg_match($this->rules, $this->input)) {
            return false;
        }
        return true;
    }
}
