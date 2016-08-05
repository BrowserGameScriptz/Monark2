<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class LoginPage extends BasePage
{
    public $route = 'user/login';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $this->actor->fillField('input[name="UserLoginForm[username]"]', $username);
        $this->actor->fillField('input[name="UserLoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
