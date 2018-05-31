<?php
namespace frontend\controllers;

use Yii;
use common\models\UserProfile;
use yii\web\Controller;
use backend\models\search\NannySearch;
use yii\web\NotFoundHttpException;
use common\models\PostalCode;
use common\components\Paypal;
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

    public function actionIndex($city='')
    {
        $searchModel = new NannySearch();
        $search=["NannySearch" => ["status"=> "1"]];
        $radius=5;
//        $zu=new Paypal();
        switch (true){
            case ( isset($_GET['radius']) ):
                $radius=$_GET['radius'];
            case (isset($_GET['position'])):
                $search["NannySearch"]["position_for"]=$_GET['position'];
            case (isset($_GET['zip'])):
                $location= new PostalCode($_GET['zip']);
                $zips =$location->getPostalCodesInRange(0,$radius);
                foreach($zips as $object){
                    $zips_array[]=$object->postal_code;
                }
                $search["NannySearch"]["zip_code"]=$zips_array;
                break;
            case (isset($_GET['city'])):
                $location= new PostalCode($_GET['city'].", CA");
                $zips_array =$location->getSameCity();
                 $search["NannySearch"]["zip_code"]=$zips_array;
                break;
            default:
                $search=["NannySearch" => ["status"=> "1"]];
                break;
        }
        $dataProvider = $searchModel->search($search);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
