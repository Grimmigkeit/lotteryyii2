<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Lottery;
use app\models\User;

class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'actions' => ['lottery', 'convert-money', 'refuse-prize'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Get and set random prize.
     *
     * @return Response|json
     */
    public function actionLottery()
    {
        $model = new Lottery();

        if ($res = $model->startLottery()) {
            return $this->asJson($res);
        }
    }

    /**
     * Convert money to points
     *
     * @return Response|json
     */
    public function actionConvertMoney()
    {
        $model = new Lottery();

        if ($res = $model->convertMoney()) {
            return $this->asJson($res);
        }
    }

    /**
     * Refuse prizes
     *
     * @return Response|json
     */
    public function actionRefusePrize()
    {
        $model = new Lottery();

        if ($res = $model->refusePrize()) {
            return $this->asJson($res);
        }
    }
}