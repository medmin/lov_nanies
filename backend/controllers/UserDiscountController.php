<?php

namespace backend\controllers;

use backend\models\search\UserDiscountSearch;
use common\models\UserDiscount;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserDiscountController implements the CRUD actions for UserDiscount model.
 */
class UserDiscountController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Nannies Discount models.
     *
     * @return mixed
     */
    public function actionNanny()
    {
        $searchModel = new UserDiscountSearch();
        $searchCondition = ArrayHelper::merge(Yii::$app->request->queryParams, ['UserDiscountSearch' => ['type' => UserDiscount::TYPE_NANNY]]);
        $dataProvider = $searchModel->search($searchCondition);

        $offForAllNannies = UserDiscount::getDiscountForAllNannies();

        return $this->render('index', [
            'searchModel'      => $searchModel,
            'dataProvider'     => $dataProvider,
            'offForAllNannies' => $offForAllNannies,
        ]);
    }

    public function actionFamily()
    {
        $searchModel = new UserDiscountSearch();
        $searchCondition = ArrayHelper::merge(Yii::$app->request->queryParams, ['UserDiscountSearch' => ['type' => UserDiscount::TYPE_FAMILY_POST]]);
//        var_dump($searchCondition);exit;
        $dataProvider = $searchModel->search($searchCondition);

        $offForAllFamiliesPost = UserDiscount::getPostDiscountForAllFamilies();

        return $this->render('index_family', [
            'searchModel'           => $searchModel,
            'dataProvider'          => $dataProvider,
            'offForAllFamiliesPost' => $offForAllFamiliesPost,
        ]);
    }

    /**
     * Displays a single UserDiscount model.
     *
     * @param int $user_id
     * @param int $type
     *
     * @return mixed
     */
    public function actionView($user_id, $type)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $type),
        ]);
    }

    /**
     * 创建或者更新全体折扣.
     *
     * @param int $type 折扣类型
     *
     * @return mixed
     */
    public function actionCreate($type = UserDiscount::TYPE_NANNY)
    {
        $model = UserDiscount::findOne(['user_id' => 0, 'type' => $type]);
        if (!$model) {
            $model = new UserDiscount();
            $model->user_id = 0;
            $model->type = $type;
        }
        $model->created_at = time();

        if ($model->load(Yii::$app->request->post())) {
            $model->expired_at = $model->expired_at ? strtotime($model->expired_at) : null;
            $model->save();

            return $this->redirect([$type == UserDiscount::TYPE_FAMILY_POST ? 'family' : 'nanny']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 给用户添加折扣.
     *
     * @param int $type 折扣类型
     *
     * @return bool
     */
    public function actionAdd($type = UserDiscount::TYPE_NANNY)
    {
        if (Yii::$app->request->isAjax) {
            $user_id = Yii::$app->request->post('user_id');
            $model = UserDiscount::findOne(['user_id' => $user_id, 'type' => $type]);
            if (!$model) {
                $model = new UserDiscount();
                $model->user_id = $user_id;
                $model->type = $type;
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
     *
     * @param int $user_id
     * @param int $type
     *
     * @return mixed
     */
    public function actionUpdate($user_id, $type)
    {
        $model = $this->findModel($user_id, $type);

        if ($model->load(Yii::$app->request->post())) {
            $model->expired_at = $model->expired_at ? strtotime($model->expired_at) : null;
            $model->save();

            return $this->redirect(['view', 'user_id' => $model->user_id, 'type' => $type]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserDiscount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $user_id
     * @param int $type
     *
     * @return mixed
     */
    public function actionDelete($user_id, $type)
    {
        $this->findModel($user_id, $type)->delete();

        return $this->redirect([$type == UserDiscount::TYPE_FAMILY_POST ? 'family' : 'nanny']);
    }

    /**
     * Finds the UserDiscount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $user_id
     * @param int $type
     *
     * @throws NotFoundHttpException if the model cannot be found
     *
     * @return UserDiscount the loaded model
     */
    protected function findModel($user_id, $type)
    {
        if (($model = UserDiscount::findOne(['user_id' => $user_id, 'type' => $type])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
