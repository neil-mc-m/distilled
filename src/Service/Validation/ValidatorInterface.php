<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 11/12/2017
 * Time: 21:25
 */

namespace Distilled\Service\Validation;

/**
 * Interface for validators
 *
 * Interface ValidatorInterface
 * @package Distilled\Service\Validation
 */
interface ValidatorInterface
{

    /**
     * Set the rules
     *
     * @param $rules
     * @return mixed
     */
    public function setRules($rules);

    /**
     * Do the validating
     *
     * @return mixed
     */
    public function validate();
}
