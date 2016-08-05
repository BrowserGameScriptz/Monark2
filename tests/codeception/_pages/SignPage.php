<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents contact page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class SignPage extends BasePage
{
    public $route = 'user/sign';

    /**
     * @param array $contactData
     */
    public function sign(array $signData)
    {
        foreach ($signData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="UserCreateForm[' . $field . ']"]', $value);
        }
        $this->actor->click('sign-button');
    }
}
