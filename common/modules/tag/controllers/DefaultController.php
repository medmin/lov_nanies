<?php

namespace common\modules\tag\controllers;

use common\service\TagService;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `modules` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete-user-tag' => ['post'],
                    'delete' => ['post'],
                    'create' => ['post'],
                    'update' => ['post']
                ]
            ],
            'response' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        if (!\Yii::$app->user->can('administrator')) {
            throw new NotFoundHttpException();
        }
        return parent::beforeAction($action);
    }

    public function actionCreateUserTag($user_id, $tag_id)
    {
        return TagService::createUserTag($user_id, $tag_id);
    }
    
    public function actionUserTag($user_id)
    {
        return TagService::getUserTags($user_id);
    }

    public function actionDeleteUserTag($user_id, $id)
    {
        return TagService::deleteUserTag($id, $user_id);
    }

    public function actionList()
    {
        return TagService::getTags();
    }

    public function actionCreate($target, $name, $icon = null, $info = null)
    {
        return TagService::createTag($target, $name, $icon, $info);
    }

    public function actionUpdate($id, $target, $name, $icon, $info = null)
    {
        return TagService::updateTag($id, $target, $name, $icon, $info);
    }

    public function actionDelete($id)
    {
        return TagService::deleteTag($id);
    }
}
