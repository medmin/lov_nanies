<?php

namespace backend\controllers;

use backend\models\search\ParentPostSearch;
use common\models\ParentPost;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ParentPostController implements the CRUD actions for ParentPost model.
 */
class ParentPostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ParentPost models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParentPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ParentPost model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ParentPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ParentPost();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ParentPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ParentPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = ParentPost::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * 审核通过.
     *
     * @param $id
     *
     * @return mixed
     */
    public function actionApproved($id)
    {
        $model = $this->findModel($id);
        $model->status = ParentPost::STATUS_ACTIVE;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * 审核失败.
     *
     * @param $id
     *
     * @return mixed
     */
    public function actionUnApproved($id)
    {
        $model = $this->findModel($id);
        if ($remark = Yii::$app->request->post('remark')) {
            $model->remark = $remark;
        }
        $model->status = ParentPost::STATUS_FAILED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ParentPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @throws NotFoundHttpException if the model cannot be found
     *
     * @return ParentPost the loaded model
     */
    protected function findModel($id)
    {
        if (($model = ParentPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
