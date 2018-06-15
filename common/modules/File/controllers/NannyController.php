<?php

namespace common\modules\file\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


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
        // if (Yii::$app->request->post())
        // {
        //     $data = Yii::$app->request->post();

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
                    'Key'    =>  'nanny/sss', //这里应该用uuid，否则重名就替换了原来的文件了
                    // 'Body'   => fopen(__DIR__ . '/cardio.png', 'r'),
                    'Body' => 'sss'
                ]);

                return $upload->get('ObjectURL');
                
            }
            catch(S3Exception $e)
            {
                return $e->getMessage();
            }
            catch (Exception $e) {
                return $e->getMessage();
            }
        // }

        // return $this->redirect('/', 301)->send();
    }

    public function actionDownload($file_uuid)
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