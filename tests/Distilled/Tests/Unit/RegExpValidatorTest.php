<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 11/12/2017
 * Time: 23:13
 */

namespace Distilled\Tests\Unit;

use Distilled\Service\Validation\RegExpValidator;
use PHPUnit\Framework\TestCase;

class RegExpValidatorTest extends TestCase
{
    public function testWillValidateWithCorrectInput()
    {
        $validator = new RegExpValidator('distilled90 9888 ---');
        $validator->setRules('/^[a-zA-Z0-9\-\ ]+$/');
        $valid = $validator->validate();

        $this->assertTrue($valid === true);
    }

    public function testValidationWillNotPassWithWrongInput()
    {
        $validator = new RegExpValidator('£$"£%$^%^&^%*&*');
        $validator->setRules('/^[a-zA-Z0-9\-\ ]+$/');
        $valid =  $validator->validate();

        $this->assertTrue($valid === false);
    }
}
