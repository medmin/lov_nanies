<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\models\Nannies;
use common\models\Refs;
use backend\models\UserForm;
use backend\models\search\UserSearch;
use backend\models\search\NannySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;

/**
 * NanniesController implements the CRUD actions for User model.
 */
class NanniesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NannySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @param string $step
     * @return mixed
     */
    public function actionUpdate($id,$step='')
    {
        
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
                'query' => Refs::find()->where(['email' => $model->email]),
            ]);
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            
            return $this->refresh();
        }
        switch($step){
            case 1:
                return $this->render('main', ['model' => $model, 'dataProvider'=>$dataProvider]);
            break;
            case 2:
                return $this->render('questions-n-schedule', ['model' => $model, 'dataProvider'=>$dataProvider]);
            break;
            case 3:
                return $this->render('education-n-driving', ['model' => $model, 'dataProvider'=>$dataProvider]);
            break;
            case 4:
                return $this->render('housekeeping', ['model' => $model, 'dataProvider'=>$dataProvider]);
            break;
            case 5:
                return $this->render('aboutyou', ['model' => $model, 'dataProvider'=>$dataProvider]);
            break;
            case 'tag':
                return $this->render('tag', ['model' => $model]);
            break;
            default:
                return $this->render('main', ['model' => $model, 'dataProvider'=>$dataProvider]);
        }
        
    
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->authManager->revokeAll($id);
        $model = User::findOne($id);
        $model->status=User::STATUS_DELETED;
        $model->save();
        return $this->goBack();
    }
    
    public function actionApprove($id)
    {
//        Yii::$app->authManager->revokeAll($id);
        // TODO 没有明白为什么接受保姆申请之后要删除该用户的角色，这样造成的影响是改用户没有角色在查看个人信息直接报错，估计这个沙比是复制的 actionDelete
        $model=$this->findModel($id);
        $model->status=1;
        $model->save();
        // TODO 接受之后也没有发送邮件的功能
        return $this->goBack();
    }
    
    public function actionDereactivation($id)
    {
//        Yii::$app->authManager->revokeAll($id);
        $model=$this->findModel($id);
        if($model->status=='-1'){
           $model->status=1;
        }else{
            $model->status=-1;
        }
        $model->save();
        return $this->goBack();
    }
    
    public function actionDeactivate($id)
    {
//        Yii::$app->authManager->revokeAll($id);
        $model=$this->findModel($id);
        if($model->status=='1'){
           $model->status=-1;
        }
        $model->save();
        return $this->goBack();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nannies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nannies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function afterAction($action, $result)
    {
        Yii::$app->getUser()->setReturnUrl(Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }
    
    public function actionView_ref($id)
    {
        $model=$this->findRef($id);
            return $this->render('view_ref', [
                'model' => $model,
            ]);
        
    }
    public function actionUpdate_ref($id)
    {
            $model=$this->findRef($id);
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view_ref', 'id' => $model->id]);
            } else {
                return $this->render('update_ref', [
                    'model' => $model,
                ]);
            }
    }

    protected function findRef($id)
    {
        if (($model = Refs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
