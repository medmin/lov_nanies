<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleAttachment;
use common\models\ArticleCategory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends Controller
{
    /**
     * @param $c string category
     *
     * @return string
     */
    public function actionIndex($c = '')
    {
        Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = $c != '' ? $c : 'top_banner';

        $query = Article::find()->where(['status' => Article::STATUS_PUBLISHED]);
        if ($c && $category = ArticleCategory::findOne(['slug' => $c])) {
            $query->andWhere(['category_id' => $category->id]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', ['dataProvider'=>$dataProvider]);
    }

    /**
     * @param $slug
     *
     * @throws NotFoundHttpException
     *
     * @return string
     */
    public function actionView($slug)
    {
        $model = Article::find()->published()->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = $model->category->slug;

        $viewFile = $model->view ?: 'view';

        return $this->render($viewFile, ['model'=>$model]);
    }

    /**
     * @param $id
     *
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     *
     * @return $this
     */
    public function actionAttachmentDownload($id)
    {
        $model = ArticleAttachment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return Yii::$app->response->sendStreamAsFile(
            Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
            $model->name
        );
    }
}
