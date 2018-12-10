<?php

namespace tests\models;

use Yii;
use app\models\User;
use app\models\Lottery;

class ConvertMoneyTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testConvertMoney()
    {
        /* mock didnt worked out for some reason, so i did like this, i guess there can be better testing, then this hardcode. */
        $this->model = new Lottery(); 

        //get user
        $user = User::find()->where(['username' => 'admin'])->one();
        
        //create user for test if not exist
        if (empty($user)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@admin.admin';
            $user->setPassword('admin');
            $user->generateAuthKey();
            $user->save();
        }

        //set current user for test
        Yii::$app->user->setIdentity($user);

        //set new values
        $this->model->points = NULL;
        $this->model->money = 1000;
        $this->model->prize = NULL;

        $this->model->setPrize();

        //convert money to points
        $res = $this->model->convertMoney();

        //check result with expected values
        $this->assertEquals(600, $res['points']);
        $this->assertEquals(NULL, $this->model->money);
    }
}
