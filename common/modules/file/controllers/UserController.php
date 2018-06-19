<?php

namespace common\modules\file\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use common\modules\file\models\UserFile;
use yii\web\UploadedFile;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use yii\db\Transaction;

use GuzzleHttp\Psr7;


class UserController extends Controller
{
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


    public function actionIndex()
    {
        return $this->redirect('/file/user/upload', 301)->send();
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
                    'Key'    =>  'user/' . Yii::$app->user->id . '/' . $uuid .'.'. $file->getExtension(), //重名就替换了原来的文件，且这里是故意不用$ext的
                    'Body'   => fopen($tempFile, 'r')
                ]);
            }
            catch(S3Exception $e)
            {
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => $e->getMessage()
                ]);
                $this->redirect(['/user/default/upload-files'])->send();
                return false;
            }
            catch (\Exception $e) {
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => $e->getMessage()
                ]);
                $this->redirect(['/user/default/upload-files'])->send();
                return false;
            }

            $isolationLevel = Transaction::SERIALIZABLE;
            $transaction = Yii::$app->db->beginTransaction($isolationLevel);
            try
            {
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
                $this->redirect(['/user/default/upload-files'])->send();
                return true;
            }
            catch (\Exception $e)
            {
                $transaction->rollBack();
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => Yii::t('frontend', 'UploadFailure', [], Yii::$app->user->identity->userProfile->locale)
                ]);
                $this->redirect(['/user/default/upload-files'])->send();
                return false;
            }

        }

        return $this->redirect(['/user/default/upload-files'])->send();
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