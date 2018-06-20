<?php

namespace common\modules\file\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use common\modules\file\models\UserFile;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Ramsey\Uuid\Uuid;
use yii\db\Transaction;



class UserController extends Controller
{
    public $redirect_url;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * 添加权限判断
     *
     * @param \yii\base\Action $action
     * @return bool
     * @throws NotFoundHttpException
     */
    public function beforeAction($action)
    {
        $userRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (array_key_exists('nanny', $userRoles)) {
            $this->redirect_url = '/user/default/upload-files';
        } elseif (array_key_exists('seeker', $userRoles)) {
            $this->redirect_url = '/user/default/index';
        } else {
            $this->redirect_url = '/'; // 这地方就是管理员了
        }
        if ($action->id === 'download' && (array_key_exists('nanny', $userRoles) || array_key_exists('seeker', $userRoles))) {
            // 如果是download 并且角色为 nanny 或者 seeker 的话，判断当前用户和 user_id 是否一样，不一样不能查看。杜绝管理员拥有nanny或者seeker角色的情况
            $user_id = Yii::$app->request->get('user_id') ?: Yii::$app->request->post('user_id') ?: Yii::$app->user->id;
            if ($user_id != Yii::$app->user->id) {
                throw new NotFoundHttpException('File does not exist.');
            }
            
        }
        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        return $this->redirect($this->redirect_url, 301)->send();
    }

    public function actionUpload()
    {
        $model =  new UserFile();

        if (Yii::$app->request->isPost)
        {
//            $data = Yii::$app->request->post('UserFile');

            $file = UploadedFile::getInstance($model, 'file');
            $uuid = Uuid::uuid4()->toString();
            $tempFile = './uploadTempDir/' . $uuid;
            $this->extIsValid($file->getExtension());
            $file->saveAs($tempFile);

            // Instantiate an Amazon S3 client which is compatiable to DO Spaces.
            $client = new S3Client([
                'version' => 'latest',
                'region'  => 'ny3',
                'endpoint' => 'https://nyc3.digitaloceanspaces.com',
                'credentials' => [
                    'key'    => getenv('DO_SPACES_KEY'),
                    'secret' => getenv('DO_SPACES_SECRET'),
                ],
            ]);

            try
            {
                // Upload a file to the Space
                $upload = $client->putObject([
                    'Bucket' => getenv('DO_SPACES_BUCKET_NAME'),
                    'Key'    =>  'user/' . Yii::$app->user->id . '/' . $uuid .'.'. $file->getExtension(), // 重名就替换了原来的文件
                    'Body'   => fopen($tempFile, 'r')
                ]);
            }
            catch(S3Exception $e)
            {
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => $e->getMessage()
                ]);
                $this->redirect($this->redirect_url)->send();
                return false;
            }
            catch (\Exception $e) {
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => $e->getMessage()
                ]);
                $this->redirect($this->redirect_url)->send();
                return false;
            }

            $isolationLevel = Transaction::SERIALIZABLE;
            $transaction = Yii::$app->db->beginTransaction($isolationLevel);
            try
            {
                $model->file = $_FILES;
                $model->user_id = Yii::$app->user->id;
                $model->file_uuid = $uuid;
                $model->title = Yii::$app->request->post((new \ReflectionClass($model))->getShortName())['title'];
                $model->ext = $file->getExtension();
                $model->link = $upload->get('ObjectURL');
                $model->status = UserFile::STATUS_ACTIVE;
                $model->created_at = time();
                if (!$model->save())
                {
                    throw new \Exception('UserFile DB Save Failure');
                }

                
                $transaction->commit();
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-success'],
                    'body' => Yii::t('frontend', 'UploadSuccess', [], Yii::$app->user->identity->userProfile->locale)
                ]);
//                unlink($tempFile);  // 删除临时文件会出错 Resource temporarily unavailable 原因未知（可能是正在上传?）
                $this->redirect($this->redirect_url)->send();
                return true;
            }
            catch (\Exception $e)
            {
                $transaction->rollBack();
                echo '<pre>';
                print_r($e->getMessage());
                echo '</pre>';
                exit;
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => Yii::t('frontend', 'UploadFailure', [], Yii::$app->user->identity->userProfile->locale)
                ]);
                $this->redirect($this->redirect_url)->send();
                return false;
            }

        }

        return $this->redirect($this->redirect_url)->send();
    }

    public function actionDownload($user_id, $file_uuid)
    {
        // Instantiate an Amazon S3 client which is compatiable to DO Spaces.
        $client = new S3Client([
            'version' => 'latest',
            'region'  => 'ny3',
            'endpoint' => 'https://nyc3.digitaloceanspaces.com',
            'credentials' => [
                'key'    => getenv('DO_SPACES_KEY'),
                'secret' => getenv('DO_SPACES_SECRET'),
            ],
        ]);

        $user_file = UserFile::findOne(['file_uuid' => $file_uuid]);
        try {
            // Get the object.
            $file = $client->getObject([
                'Bucket' => 'nannycare',
                'Key'    => 'user/' . $user_id . '/' . $file_uuid .'.'. $user_file->ext,
            ]);

            // Display the object in the browser.
            header("Content-Type: {$file['ContentType']}");
            // 设置 filename 就可以显示下载的名称
            header("Content-Disposition:attachment;filename = " . $user_file->title . "." . $user_file->ext);
            echo $file['Body'];  // Instance of GuzzleHttp\Psr7\Stream
            
        } 
        catch (S3Exception $e) {
            return $e->getMessage();
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        return false;
    }


    /**
     * 其实前端也验证过了，后端再验证一次也没问题
     *
     * @param $ext
     * @return bool
     */
    private function extIsValid($ext)
    {
        if (!$ext) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-danger'],
                'body' => Yii::t('frontend', 'The file does not have an extension!', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            $this->redirect(['/user/default/upload-files'])->send();
            return false;
        } elseif (!in_array($ext, ['tif', 'png', 'jpg', 'doc', 'docx', 'xls', 'xlsx','ppt', 'pptx', 'pdf', 'zip', 'rar', '7z', 'txt'])){
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-danger'],
                'body' => Yii::t('frontend', 'The format '. $ext .' is not supported!', [], Yii::$app->user->identity->userProfile->locale)
            ]);
            $this->redirect(['/user/default/upload-files'])->send();
            return false;
        }
        return true;
    }


}