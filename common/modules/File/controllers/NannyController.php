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


class NannyController extends Controller
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
        return $this->redirect('/file/nanny/upload', 301)->send();
    }

    public function actionUpload()
    {
        $model =  new UserFile();

        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('UserFile');

            $file = UploadedFile::getInstance($model, 'link');
            $ext = pathinfo($file)['extension'] ;


            if (!in_array($ext, ['tif', 'png', 'jpg', 'doc', 'docx', 'xls', 'xlsx','ppt', 'pptx', 'pdf', 'zip', 'rar', '7z', 'txt'])) 
            {
                Yii::$app->session->set('FileFormatError', 'The format '. $ext .' is not supported!');
                return $this->refresh();
            }

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
                    'Key'    =>  'nanny/' .$data['user_id'] . '/' . $data['file_uuid'] .'.'. $ext, //这里应该用uuid，否则重名就替换了原来的文件了
                    'Body'   => $file,
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

    public function actionDownloadViaUuid($file_uuid)
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
                'Key'    => 'nanny/' . $file_uuid,
            ]);

            // Display the object in the browser.
            header("Content-Type: {$file['ContentType']}");
            echo $file['Body'];
        } 
        catch (S3Exception $e) {
            return $e->getMessage();
        }
        catch (Exception $e) {
            return $e->getMessage();
        }

    }


}