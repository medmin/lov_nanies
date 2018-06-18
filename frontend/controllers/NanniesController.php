<?php
namespace frontend\controllers;

use Yii;
use common\models\Nannies;
use yii\web\Controller;
use backend\models\search\NannySearch;
use yii\web\NotFoundHttpException;
use common\models\PostalCode;

/**
 * Site controller
 */
class NanniesController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new NannySearch();
        $search = ["NannySearch" => ["status"=> "1"]];
        $error = '';
        $radius = 5;

        if (isset($_GET['radius']) && $_GET['radius'] == true) {
            $radius = $_GET['radius'];
        }

        $search["NannySearch"]["position_for"] = $_GET['position'] ?? '';
        $search["NannySearch"]["availability"] = $_GET['availability'] ?? '';

        if (isset($_GET['zip']) && $_GET['zip']) {
            try {
                $location= new PostalCode($_GET['zip']);
                $zips =$location->getPostalCodesInRange(0,$radius);
                foreach($zips as $object){
                    $zips_array[]=$object->postal_code;
                }
                $search["NannySearch"]["zip_code"] = $zips_array ?? '';
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        if (isset($_GET['city']) && $_GET['city']) {
            // 传过来的是小写和中划线,改为首字母大写和空格的组合,因为原来的就是那样,现在只是url优化,不改原来的逻辑
            $_GET['city'] = ucwords(str_replace('-', ' ', $_GET['city']));
            try {
                $location= new PostalCode($_GET['city'].", CA");
                $zips_array =$location->getSameCity();
                $search["NannySearch"]["zip_code"]=$zips_array;
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        $dataProvider = $searchModel->search($search);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'error' => $error
        ]);
        
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModelById($id),
        ]);
    }
    protected function findModelById($id)
    {
        if (($model = Nannies::find()->where(['id'=>$id])->one() ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
