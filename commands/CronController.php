<?php

namespace app\commands;

use Yii;
use app\models\Lottery;
use app\models\User;

class CronController extends \yii\console\Controller
{

    public function actionIndex($n=500) {
        
        $lotteryModel = new Lottery;
        $userModel = new User;

        foreach ($userModel->getAllUsersId() as $user) {

        	$lottery = $lotteryModel->getByUserId($user->id);

        	if (!$lottery) {

        		$fields = [
        			'user_id' => $user->id,
        			'money' => $n,
        		];

        		Yii::$app->db->createCommand()->insert('lottery', $fields)->execute();

        		echo 'money has been sent;';
        	}
        }
        

    }

}