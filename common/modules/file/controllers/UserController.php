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
            $data = Yii::$app->request->post('UserFile');

            $file = UploadedFile::getInstance($model, 'link');
            $tempFile = './uploadTempDir/' . $data['file_uuid'];
            $ext = $file->getExtension(); $this->extIsValid($ext);
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
                    'Key'    =>  'user/' .$data['user_id'] . '/' . $data['file_uuid'] .'.'. $ext, //重名就替换了原来的文件，且这里是故意不用$ext的
                    'Body'   => fopen($tempFile, 'r')
                ]);

                
                
            }
            catch(S3Exception $e)
            {
                return $e->getMessage();
            }
            catch (Exception $e) {
                return $e->getMessage();
            }

            $isolationLevel = Transaction::SERIALIZABLE;
            $transaction = Yii::$app->db->beginTransaction($isolationLevel);
            try
            {
                $model->user_id = $data['user_id'];
                $model->file_uuid = $data['file_uuid'];
                $model->title = $data['title'];
                $model->ext = $ext;
                $model->link = $upload->get('ObjectURL');
                $model->status = $data['status'];
                $model->created_at = $data['created_at'];
                if (!$model->save())
                {
                    throw new \Exception('UserFile DB Save Failure');
                }
                $transaction->commit();
                Yii::$app->session->setFlash('UploadSuccess');
                $model = new UserFile();
                return $this->render('upload', ['model' => $model]);
            }
            catch (\Exception $e)
            {
                $transaction->rollBack();
                Yii::$app->session->setFlash('UploadFailure');
                return $this->render('upload', ['model' => $model]);
            }


        }

        return $this->render('upload', ['model' => $model]);
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

        try {
            // Get the object.
            $file = $client->getObject([
                'Bucket' => 'nannycare',
                'Key'    => 'user/' . $user_id . '/' . $file_uuid .'.'. UserFile::getExt($file_uuid),
            ]);

            // Display the object in the browser.
            header("Content-Type: {$file['ContentType']}");
            echo $file['Body'];  // Instance of GuzzleHttp\Psr7\Stream
            
        } 
        catch (S3Exception $e) {
            return $e->getMessage();
        }
        catch (Exception $e) {
            return $e->getMessage();
        }

    }


    private function extIsValid($ext)
    {
        if (!$ext )
        {
            Yii::$app->session->set('FileFormatError', 'The file does not have an extension!');
            return $this->refresh();
        }
        else if ( !in_array($ext, ['tif', 'png', 'jpg', 'doc', 'docx', 'xls', 'xlsx','ppt', 'pptx', 'pdf', 'zip', 'rar', '7z', 'txt']))
        {
            Yii::$app->session->set('FileFormatError', 'The format '. $ext .' is not supported!');
            return $this->refresh();
        }
    
    }


}