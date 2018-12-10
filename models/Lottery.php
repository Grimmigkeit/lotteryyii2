<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Lottery model.
 */
class Lottery extends Model
{
    public $points;
    public $prize;
    public $money;

    const PRIZE_LIST = array('phone', 'mouse', 'keyboard', 'monitor', 'notebook'); // todo get from config(file or db)
    const MONEY_COEFFICIENT = 0.6;

    /**
     * Set prize from lottery to current user
     * @return bool
     */
    public function setPrize()
    {
        $userId = Yii::$app->user->getId();

        if (!$userId) {
            return false;
        }

        $this->randomPrize();

        $fields = [
            'points' => $this->points ? $this->points : NULL,
            'prize' => $this->prize ? $this->prize : NULL,
            'money' => $this->money ? $this->money : NULL,
        ];

        $lottery = $this->getByUserId($userId);

        if ($lottery) {

            $this->updateLottery($fields, $userId);

        } else {

            $fields['user_id'] = $userId;

            Yii::$app->db->createCommand()->insert('lottery', $fields)->execute();

        }
            return $fields;
    }

    /**
     * Get random prize
     */
    public function randomPrize()
    {
        $rn = rand(1,3); // @todo get from config(file or db)

        switch ($rn) {
            case 1:
                $this->points = rand(1, 9999); // @todo get from config(file or db)
                break;

            case 2:
                $prizeNumber = rand(0, 4);
                $this->prize = self::PRIZE_LIST[ $prizeNumber ];
                break;

            case 3:
                $this->money = rand(1, 3000); // @todo get from config(file or db)
                break;
        }
    }

    /**
     * Get row by user id
     * @param $userId int
     * @return array
     */
    public function getByUserId($userId)
    {
        return Yii::$app->db->createCommand('SELECT * FROM lottery WHERE user_id=:user_id')
        ->bindValue(':user_id', $userId)
        ->queryOne();
    }

    /**
     * Update lottery row
     * @param $userId int
     * @return array
     */
    public function updateLottery($fields, $userId)
    {
        Yii::$app->db->createCommand()->update('lottery', $fields, ['user_id' => $userId])
            ->execute();
    }

    /**
     * Convert money to points
     */
    public function convertMoney()
    {
        $userId = Yii::$app->user->getId();

        $lottery = $this->getByUserId($userId);

        if ($lottery['money']) {

            $fields = [
                'points' => number_format($lottery['money'] * self::MONEY_COEFFICIENT, 0, '', ''),
                'money' => NULL,
            ];

            $lottery['money'] = NULL;
            $lottery['points'] = $fields['points'];

            $this->updateLottery($fields, $userId);

            return $lottery;
        }
    }

    /**
     * Convert money to points
     */
    public function refusePrize()
    {
        $userId = Yii::$app->user->getId();

        $fields = [
            'points' => NULL,
            'money' => NULL,
            'prize' => NULL,
        ];

        $this->updateLottery($fields, $userId);

        return $fields;
    }
}
