<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 21:12
 */


namespace frontend\controllers;

use common\models\UserNotify;
use common\models\UserOrder;
use common\models\WidgetCarousel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\ParentPost;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PostJobController extends Controller
{
    private $expired_at = 0;
    private $user_roles;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    ['allow' => true, 'roles' => ['@']]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                    'delete' => ['post']
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->user_roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if ($action->id === 'create' && !($this->expired_at = UserOrder::ParentPostStatus(Yii::$app->user->id))) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-danger'],
                'body' => Yii::t('frontend', 'Please buy bronze paln(279 USD) or higer.', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            $this->redirect(['user/default/get-credits']);
            return false;
        }
//        if (($action->id === 'index' || $action->id === 'view') && key_exists('nanny', $this->user_roles) && !UserOrder::NannyListingFeeStatus(Yii::$app->user->id)) {
//            Yii::$app->session->setFlash('alert', [
//                'options' => ['class'=>'alert-danger'],
//                'body' => Yii::t('frontend', 'Please buy membership (99 USD).', [], Yii::$app->user->identity->userProfile->locale)
//            ]);
//            return $this->redirect(['user/default/get-credits'])->send();
//        }
        if ($action->id === 'posted' && !key_exists('seeker', $this->user_roles)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if (WidgetCarousel::findOne(['key' => 'job', 'status' => WidgetCarousel::STATUS_ACTIVE])) {
            Yii::$app->view->params['offslide'] = true;
            Yii::$app->view->params['slider'] = 'job';
        }
        return parent::beforeAction($action);
    }

    /**
     * job 列表页面
     * 返回所有未到期并且状态正常的job
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
//        if (key_exists('seeker', $this->user_roles)) {
//            $query = ParentPost::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['<>', 'status', ParentPost::STATUS_DELETED])->orderBy('created_at DESC');
//        } else {
//        }
        $query = ParentPost::find()->where(['status' => ParentPost::STATUS_ACTIVE])->andWhere(['>', 'expired_at', time()])->orderBy('created_at DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        Yii::$app->view->params['offslide'] = true;
        Yii::$app->view->params['slider'] = 'find-a-job';

        return $this->render('/parent_post/index', ['dataProvider' => $dataProvider]);

    }

    /**
     * 获取用户自己的post
     *
     * @return string
     */
    public function actionPosted()
    {
        $query = ParentPost::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['<>', 'status', ParentPost::STATUS_DELETED])->orderBy('created_at DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        Yii::$app->view->params['offslide'] = true;
        Yii::$app->view->params['slider'] = 'find-a-job';

        return $this->render('/parent_post/index', ['dataProvider' => $dataProvider]);
    }

    /**
     * 新建
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ParentPost();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->expired_at = $this->expired_at;
            $model->updated_at = time();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('/parent_post/create', [
            'model' => $model,
        ]);

    }

    /**
     * 详情页
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
//        if (key_exists('nanny', $this->user_roles)) {
//        } else {
//            $model = ParentPost::find()->where(['id' => $id, 'user_id' => Yii::$app->user->id])->andWhere(['<>', 'status', ParentPost::STATUS_DELETED])->one();
//        }
        $model = ParentPost::find()->where(['id' => $id, 'status' => ParentPost::STATUS_ACTIVE])->andWhere(['>', 'expired_at', time()])->one();
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('/parent_post/view', ['model' => $model]);
    }

    /**
     * 更新
     *
     * @return string|\yii\web\Response
     */
    public function actionUpdate()
    {
        if ($id = Yii::$app->request->post('id')) {
            $model = $this->findModel($id);
            return $this->render('/parent_post/create', ['model' => $model]);
        } elseif ($form = Yii::$app->request->post('ParentPost')) {
            $model = $this->findModel($form['id']);
            $model->updated_at = time();
            if ($model->load($form, '') && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('/parent_post/create', ['model' => $model]);
            }
        } else {
            return $this->redirect('/');
        }
    }

    /**
     * 删除
     *
     * @return \yii\web\Response
     */
    public function actionDelete()
    {
        if ($id = Yii::$app->request->post('id')) {
            $model = $this->findModel($id);
            $model->status = ParentPost::STATUS_DELETED;
            $model->save();
        }
        return $this->redirect(['index']);
    }

    /**
     * 通过 id 获取 model
     *
     * @param $id
     * @param $only_id bool 是否只查询id
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($id, $only_id = false)
    {
        $model = ParentPost::find()->where(['id' => $id])->andWhere(['<>', 'status', ParentPost::STATUS_DELETED]);
        if (!$only_id) {
            $model->andWhere(['user_id' => Yii::$app->user->id]);
        }
        if ($this->action->id === 'delete') {
            $model = $model->one();
        } else {
            $model = $model->andWhere(['>', 'expired_at', time()])->one();
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 联系job
     */
    public function actionContact()
    {
        Yii::$app->response->format = 'json';

        $job = $this->findModel(Yii::$app->request->post('post_id'), true);

        $model = new UserNotify();

        if (parse_url(Yii::$app->request->referrer, PHP_URL_PATH) === Url::to(['user/default/message'])) {
            $model->pid = Yii::$app->request->post('pid');
            $replyNotify = UserNotify::findOne(['id' => $model->pid, 'receiver_id' => Yii::$app->user->id]);
            if (!$replyNotify) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            $model->receiver_id = $replyNotify->sender_id;
        } else {
            $model->receiver_id = $job->user_id;
        }
        $model->job_post_id = $job->id;
        $model->content = Yii::$app->request->post('content');
        $model->subject = Yii::$app->request->post('subject');

        if ($model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-success'],
                'body' => Yii::t('frontend', 'The message has been sent', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            return ['status' => true];
        } else {
            return ['status' => false, 'message' => 'error'];
        }
    }
}