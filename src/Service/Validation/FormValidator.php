<?php
namespace Distilled\Service\Validation;

/**
 * Created by PhpStorm.
 * User: neil
 * Date: 11/12/2017
 * Time: 14:33
 */
class FormValidator
{
    protected $query;
    protected $rules;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function setRules($rules)
    {
        $this->rules = $rules;
    }
    public function validate()
    {
        if (!preg_match($this->rules, $this->query)) {
            return false;
        }
        return true;
    }
}
