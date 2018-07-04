<?php

namespace backend\controllers;

use Yii;
use common\models\UserDiscount;
use backend\models\search\UserDiscountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserDiscountController implements the CRUD actions for UserDiscount model.
 */
class UserDiscountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserDiscount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserDiscountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $offForAllNannies = UserDiscount::getDiscountForAllNannies();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'offForAllNannies' => $offForAllNannies,
        ]);
    }

    /**
     * Displays a single UserDiscount model.
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
     * 创建或者更新全体折扣
     *
     * @return mixed
     */
    public function actionCreate()
    {

        $model = UserDiscount::findOne(['user_id' => 0]);
        if (!$model) {
            $model = new UserDiscount();
            $model->user_id = 0;
        }
        $model->created_at = time();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->expired_at = $model->expired_at ? strtotime($model->expired_at) : null;
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 给用户添加折扣
     *
     * @return bool
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isAjax  )
        {
            
            $user_id = Yii::$app->request->post('user_id');
            $model = UserDiscount::findOne($user_id);
            if (!$model) {
                $model = new UserDiscount();
                $model->user_id = $user_id;
                $model->created_at = time();
            }
            $model->discount = Yii::$app->request->post('off');
            $model->expired_at = strtotime(Yii::$app->request->post('expired_at')) ?: null;
            return $model->save();
        }
        return false;
    }
    
    /**
     * Updates an existing UserDiscount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserDiscount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserDiscount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDiscount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDiscount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
