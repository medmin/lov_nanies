<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use yii\web\Controller;
use common\models\UserProfile;
use common\models\PostalCode;
use backend\models\search\UserSearch;
use backend\models\search\NannySearch;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    //https://yii2-cookbook.readthedocs.io/incoming-post/#sending-cors-headers
    //这里添加这个可以解决cors error，但似乎只是 对于这一个路由而言
    //因此在.htaccess或者nginx的配置文件里添加配置比较好
    // public function behaviors()
    // {
    //     return [
    //         'corsFilter' => [
    //             'class' => \yii\filters\Cors::className(),
    //         ],
    //     ];
    // }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->view->params['fluid'] = true;
        }
        $searchModel = new NannySearch();
        $dataProvider = $searchModel->search(["NannySearch" => ["status"=> "1"]], 6);
        return $this->render('index', ['dataProvider'=>$dataProvider]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = "contact";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options'=>['class'=>'alert-success']
                ]);
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'There was an error sending email.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }
}
