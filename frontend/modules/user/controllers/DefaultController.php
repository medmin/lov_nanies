<?php

namespace frontend\modules\user\controllers;

use common\models\Nannies;
use Yii;
use common\base\MultiModel;
use frontend\modules\user\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Refs;
use common\models\Employment;
use common\components\Paypal;
/*use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;*/

class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

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
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {

        $accountForm = new AccountForm();
        /** 说明：这里print_r($tmpArr)之后，是一个array，并且如果是家长，就是seeker
         * print_r的结果： Array ([seeker]=> .......)
         * 如果是nanny身份，尚未测试 2018.5.20
         */
        /**
         * getRolesByUser 是获取指定用户（ID）在权限表（rbac_auth_assignment）中的角色（item_name）
         * 返回一个数组，即一个用户可以有多个角色，数组的键为用户所拥有的角色名，值为一个Role对象
         * Role对象是属性为角色表（rbac_auth_item）的字段值
         */
        $tmpArr = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if( array_key_exists('nanny', $tmpArr) ){
            $accountForm->setUser(Yii::$app->user->identity);
            $model = new MultiModel([
                'models' => [
                    'account' => $accountForm,
                    'profile' => Yii::$app->user->identity->nannies
                ]
            ]);

            $locale = $model->getModel('profile')->locale;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('forceUpdateLocale');
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-success'],
                    'body' => Yii::t('frontend', 'Your account has been successfully saved', [], $locale)
                ]);
                return $this->refresh();
            }
            $refs=Refs::find()->where(['email' => \Yii::$app->user->identity->email]);
            if(count($refs)<3){
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class'=>'alert-danger'],
                    'body' => Yii::t('frontend', 'We verify a <b>minimum of three</b> references listed on your profile and do verify reference letters as well. Families can request to see our reference sheets after they have interviewed with you. You`re also welcome to provide all references to the family during or after your interview. Many nannies will bring a resume along with their references to the interview and hand it to the family. Please, provide your references.', [], $locale)
                ]);
            }
            $dataProvider = new ActiveDataProvider([
                'query' => $refs,
            ]);
            
            $dataProvider1 = new ActiveDataProvider([
                'query' => Employment::find()->where(['email' => \Yii::$app->user->identity->email]),
            ]);
            return $this->render('index', ['model'=>$model, 'dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1, 'refs'=>$refs]);
        }else{
            $accountForm->setUser(Yii::$app->user->identity);
            $model = new MultiModel([
                'models' => [
                    'account' => $accountForm,
                    'profile' => Yii::$app->user->identity->families
                ]
            ]);
            
            return $this->render('user_index_parent', ['model'=>$model]);
        }
        
    }
    public function actionMain(){
        $user = Yii::$app->user->identity;
        $model= Nannies::findOne(Yii::$app->user->id);
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            //$user->step=$user->step+1;
            $user->save();
            return $this->refresh();
        }
        return $this->render('main', ['model' => $model]);
    }
    
    public function actionQuestionsNSchedule(){
        $user = Yii::$app->user->identity;
        $model= Nannies::findOne(Yii::$app->user->id);
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            //$user->step=$user->step+1;
            $user->save();
            return $this->refresh();
        }
        return $this->render('questions-n-schedule', ['model' => $model]);
    }
    public function actionEducationNDriving(){
        $user = Yii::$app->user->identity;
        $model= Nannies::findOne(Yii::$app->user->id);
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            //$user->step=$user->step+1;
            $user->save();
            return $this->refresh();
        }
        return $this->render('education-n-driving', ['model' => $model]);
    }
    public function actionHousekeeping(){
        $user = Yii::$app->user->identity;
        $model= Nannies::findOne(Yii::$app->user->id);
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            //$user->step=$user->step+1;
            $user->save();
            return $this->refresh();
        }
        return $this->render('housekeeping', ['model' => $model]);
    }
    public function actionAboutYou(){
        $user = Yii::$app->user->identity;
        $model= Nannies::findOne(Yii::$app->user->id);
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            //$user->step=$user->step+1;
            $user->save();
            return $this->refresh();
        }
        return $this->render('aboutyou', ['model' => $model]);
    }
    
    public function actionView_ref($id)
    {
        $model=$this->findRef($id);
        if ($model->email==\Yii::$app->user->identity->email){
            return $this->render('view_ref', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(['view_incorrect', 'id' => 1]);
        }
    }
    public function actionUpdate_ref($id)
    {
        $model=$this->findRef($id);
        if ($model->email==\Yii::$app->user->identity->email){
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view_ref', 'id' => $model->id]);
            } else {
                return $this->render('update_ref', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->redirect(['view_incorrect', 'id' => 1]);
        }
    }
    public function actionCreateReference(){
        $model = new Refs();
        if ($model->load(Yii::$app->request->post())) {
            $model->email=\Yii::$app->user->identity->email;
            if($model->save()){
                
            }else{
                return $this->render('create', [
                'model' => $model,
            ]);
            }
            return $this->redirect(['view_ref', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    protected function findRef($id)
    {
        if (($model = Refs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionView_emp($id)
    {
        $model=$this->findEmp($id);
        if ($model->email==\Yii::$app->user->identity->email){
            return $this->render('view_employment', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(['view_incorrect', 'id' => 1]);
        }
    }
    public function actionUpdate_emp($id)
    {
        $model=$this->findEmp($id);
        if ($model->email==\Yii::$app->user->identity->email){
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view_emp', 'id' => $model->id]);
            } else {
                return $this->render('update_employment', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->redirect(['view_incorrect', 'id' => 1]);
        }
    }
    public function actionCreateEmployment(){
        $model = new Employment();
        if ($model->load(Yii::$app->request->post())) {
            $model->email=\Yii::$app->user->identity->email;
            if($model->save()){
                
            }else{
                return $this->render('create_employment', [
                'model' => $model,
            ]);
            }
            return $this->redirect(['view_emp', 'id' => $model->id]);
        } else {
            return $this->render('create_employment', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionGetCredits(){
        //这里意思是，如果是家长，就调转到家长付款页面，保姆的话，就是保姆的付款页面
        
        $tmpArr = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        $model = Yii::$app->user;

        if( array_key_exists('nanny', $tmpArr) ){
            return $this->render('prices_nannies', [
                'model' => $model,
            ]);
        }else{
            return $this->render('get_credits_parent', [
                'model' => $model,
            ]);
        }

        // print_r(Yii::$app->user);
    }
    protected function findEmp($id)
    {
        if (($model = Employment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    
    public function actionCreatePayment($id){
        /*$payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(74.99)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description");
        $baseUrl="http://new.lovingnannies.com/user/default";
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/execute-payment?success=true")
        ->setCancelUrl("$baseUrl/execute-payment?success=false");
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        $request = clone $payment;
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }
        $approvalUrl = $payment->getApprovalLink();
        ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);
        return $payment;*/
                
    }
    
}
