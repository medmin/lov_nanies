<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 21:12
 */


namespace frontend\controllers;

use common\models\UserOrder;
use common\models\WidgetCarousel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\ParentPost;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PostJobController extends Controller
{
    private $expired_at = 0;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'index', 'view', 'update'],
                'rules' => [
                    ['allow' => true, 'roles' => ['@']]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post']
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id === 'create' && !($this->expired_at = UserOrder::ParentPostStatus(Yii::$app->user->id))) {
            // TODO message 提示用户必须购买279才能发送
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-danger'],
                'body' => Yii::t('frontend', 'Permission denied', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            $this->redirect(['user/default/get-credits']);
            return false;
        }
        if (WidgetCarousel::findOne(['key' => 'job', 'status' => WidgetCarousel::STATUS_ACTIVE])) {
            Yii::$app->view->params['offslide'] = true;
            Yii::$app->view->params['slider'] = 'job';
        }
        return parent::beforeAction($action);
    }

    /**
     * job 列表页面
     *   如果是 parent：直接返回他们的post 列表
     *   如果是 nanny：判断是否有权限查看，有的话，返回列表，否则跳转购买页面。
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $query = ParentPost::find()->where(['status' => ParentPost::STATUS_ACTIVE])->andWhere(['>', 'expired_at', time()])->orderBy('created_at DESC');
        if (key_exists('seeker', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))) {
            $query = ParentPost::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['<>', 'status', ParentPost::STATUS_DELETED])->orderBy('created_at DESC');
        }
        if (key_exists('nanny', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())) && !UserOrder::NannyListingFeeStatus(Yii::$app->user->id)) {
            // TODO message 提示用户必须订阅 99 才能查看
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-danger'],
                'body' => Yii::t('frontend', 'Permission denied', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            return $this->redirect(['user/default/get-credits']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        Yii::$app->view->params['offslide'] = true;
        Yii::$app->view->params['slider'] = 'find-a-job';

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

    public function actionUpdate()
    {
        if ($id = Yii::$app->request->post('id')) {
            $model = $this->findModel($id);
            return $this->render('/parent_post/create', ['model' => $model]);
        } elseif ($form = Yii::$app->request->post('ParentPost')) {
            $model = $this->findModel($form['id']);
            if ($model->load($form, '') && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('/parent_post/create', ['model' => $model]);
            }
        } else {
            return $this->redirect('/');
        }
    }

    protected function findModel($id)
    {
        if (($model = ParentPost::findOne(['id' => $id, 'user_id' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}