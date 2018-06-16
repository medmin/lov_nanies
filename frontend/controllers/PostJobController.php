<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 21:12
 */


namespace frontend\controllers;

use common\models\UserOrder;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\ParentPost;
use yii\web\NotFoundHttpException;

class PostJobController extends Controller
{
    private $expired_at = 0;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    ['allow' => true, 'roles' => ['@']]
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id === 'create' && !($this->expired_at = UserOrder::ParentPostStatus(Yii::$app->user->id))) {
            // TODO flash 内容编写
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-danger'],
                'body' => Yii::t('frontend', 'Permission denied', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            $this->redirect(['user/default/get-credits']);
            return false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $query = ParentPost::find()->where(['status' => ParentPost::STATUS_ACTIVE])->andWhere(['>', 'expired_at', time()])->orderBy('created_at DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('/parent_post/index', ['dataProvider' => $dataProvider]);

    }

    public function actionCreate()
    {
        $model = new ParentPost();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->expired_at = $this->expired_at;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('/parent_post/create', [
            'model' => $model,
        ]);

    }

    public function actionView($id)
    {
        $model = ParentPost::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException();
        }
        return $this->render('/parent_post/view', ['model' => $model]);
    }
}