<?php

namespace frontend\modules\user\controllers;

use common\models\Nannies;
use Yii;
use yii\authclient\AuthAction;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use common\components\Paypalka;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\PasswordResetRequestForm;
use frontend\modules\user\models\ResetPasswordForm;
use frontend\modules\user\models\SignupForm;

/**
 * Class SignInController
 * @package frontend\modules\user\controllers
 */
class SignInController extends \yii\web\Controller
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'oauth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'successOAuthCallback']
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
                        'actions' => [
                            'signup', 'confirm-payment', 'nanny-signup', 'family-signup', 'login', 'request-password-reset', 'reset-password', 'oauth', 'activation'
                        ],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => [
                            'signup', 'nanny-signup', 'family-signup', 'login', 'request-password-reset', 'reset-password', 'oauth', 'activation'
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                        'denyCallback' => function () {
                            return Yii::$app->controller->redirect(['/user/default/index']);
                        }
                    ],
                    [
                        'actions' => ['logout', 'continue-registration',  'continue-family'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * @return array|string|Response
     */
    
    
    public function actionLogin()
    {
        
        $model = new LoginForm();
        Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = "login";
        if (Yii::$app->request->isAjax) {
            $model->load($_POST);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if((Yii::$app->user->identity->step<6)||(Yii::$app->user->identity->step==7)){
                return $this->actionContinueRegistration();
            }
            return $this->redirect(['/user/default/index']);
        }
        
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
   
    public function actionContinueRegistration(){
        $user = Yii::$app->user->identity;
        if(Yii::$app->user->identity->step<=6){
            Nannies::initialization();
            $model = Nannies::findOne(Yii::$app->user->id);
        }else{
            $model= Yii::$app->user->identity->families;
        }
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            $user->step=$user->step+1;
            $user->save();
            return Yii::$app->controller->redirect(['/user/default/get-credits']);
        }
        switch($user->step){
            case 1:
                return $this->render('step1', ['model' => $model]);
                break;
            case 2:
                return $this->render('step2', ['model' => $model]);
                break;
            case 3:
                return $this->render('step3', ['model' => $model]);
                break;
            case 4:
                return $this->render('step4', ['model' => $model]);
                break;
            case 5:
                return $this->render('step5', ['model' => $model]);
                break;
            case 7:
                return Yii::$app->controller->redirect(['/user/sign-in/continue-family']);
                break;
            default:
                return $this->goHome();
                break;
        }        
    }
    
    public function actionContinueFamily(){
        $model= Yii::$app->user->identity->families;
        $user = Yii::$app->user->identity;
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [])
            ]);
            $user->step=8;
            $user->save();
            return Yii::$app->controller->redirect(['/user/default/get-credits']);
        }
        return $this->render('continue_family', ['model' => $model]);
    }

    /**
     * @return string|Response
     */
    public function actionNannySignup(){
        $model = new SignupForm();
        Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = "signup";
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if ($model->shouldBeActivated()) {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t(
                            'frontend',
                            'Your account has been successfully created. Check your email for further instructions.'
                        ),
                        'options' => ['class' => 'alert-success']
                    ]);
                } else {
                    Yii::$app->getUser()->login($user);
                }
                return Yii::$app->controller->redirect(['/user/sign-in/login']);
            }
        }
        return $this->render('signup', [
            'model' => $model, 'type' =>'1'
        ]);
    }

    
    public function actionFamilySignup(){
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if ($model->shouldBeActivated()) {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t(
                            'frontend',
                            'Your account has been successfully created. Check your email for further instructions.'
                        ),
                        'options' => ['class' => 'alert-success']
                    ]);
                } else {
                    Yii::$app->getUser()->login($user);
                }
                return Yii::$app->controller->redirect(['/user/sign-in/continue-family']);//$this->actionContinueFamily();
            }
        }
        Yii::$app->view->params['offslide'] = 1;
        return $this->render('signup', [
            'model' => $model, 'type' =>'2'
        ]);
    }
    
    public function actionSignup()
    {
         Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = "signup";
        return $this->render('selectSignup');
    }

    /**
     * @param $token
     * @return Response
     * @throws BadRequestHttpException
     */
    public function actionActivation($token)
    {
        $token = UserToken::find()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->notExpired()
            ->one();

        if (!$token) {
            throw new BadRequestHttpException;
        }
 
        $user = $token->user;
        $user->updateAttributes([
            'status' => User::STATUS_ACTIVE
        ]);
        $token->delete();
        Yii::$app->getUser()->login($user);
        Yii::$app->getSession()->setFlash('alert', [
            'body' => Yii::t('frontend', 'Your account has been successfully activated.'),
            'options' => ['class' => 'alert-success']
        ]);
        $tmpArr2 = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ;
        if(array_key_exists('nanny',$tmpArr2)){
            return  Yii::$app->controller->redirect(['/user/sign-in/continue-registration']);
        }else{
            return  Yii::$app->controller->redirect(['/user/sign-in/continue-family']);
        }
        
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Check your email for further instructions.'),
                    'options' => ['class' => 'alert-success']
                ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('frontend', 'New password was saved.'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @param $client \yii\authclient\BaseClient
     * @return bool
     * @throws Exception
     */
    /*public function successOAuthCallback($client)
    {
        // use BaseClient::normalizeUserAttributeMap to provide consistency for user attribute`s names
        $attributes = $client->getUserAttributes();
        $user = User::find()->where([
            'oauth_client' => $client->getName(),
            'oauth_client_user_id' => ArrayHelper::getValue($attributes, 'id')
        ])->one();
        if (!$user) {
            $user = new User();
            $user->scenario = 'oauth_create';
            $user->username = ArrayHelper::getValue($attributes, 'login');
            $user->email = ArrayHelper::getValue($attributes, 'email');
            $user->oauth_client = $client->getName();
            $user->oauth_client_user_id = ArrayHelper::getValue($attributes, 'id');
            $user->status = User::STATUS_ACTIVE;
            $password = Yii::$app->security->generateRandomString(8);
            $user->setPassword($password);
            if ($user->save()) {
                $profileData = [];
                if ($client->getName() === 'facebook') {
                    $profileData['firstname'] = ArrayHelper::getValue($attributes, 'first_name');
                    $profileData['lastname'] = ArrayHelper::getValue($attributes, 'last_name');
                }
                $user->afterSignup($profileData);
                $sentSuccess = Yii::$app->commandBus->handle(new SendEmailCommand([
                    'view' => 'oauth_welcome',
                    'params' => ['user' => $user, 'password' => $password],
                    'subject' => Yii::t('frontend', '{app-name} | Your login information', ['app-name' => Yii::$app->name]),
                    'to' => $user->email
                ]));
                if ($sentSuccess) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options' => ['class' => 'alert-success'],
                            'body' => Yii::t('frontend', 'Welcome to {app-name}. Email with your login information was sent to your email.', [
                                'app-name' => Yii::$app->name
                            ])
                        ]
                    );
                }

            } else {
                // We already have a user with this email. Do what you want in such case
                if ($user->email && User::find()->where(['email' => $user->email])->count()) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options' => ['class' => 'alert-danger'],
                            'body' => Yii::t('frontend', 'We already have a user with email {email}', [
                                'email' => $user->email
                            ])
                        ]
                    );
                } else {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options' => ['class' => 'alert-danger'],
                            'body' => Yii::t('frontend', 'Error while oauth process.')
                        ]
                    );
                }

            };
        }
        if (Yii::$app->user->login($user, 3600 * 24 * 30)) {
            return true;
        }

        throw new Exception('OAuth error');
    }*/
    
    public function actionConfirmPayment(){
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
          $keyval = explode ('=', $keyval);
          if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {
          $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
          if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
          } else {
            $value = urlencode($value);
          }
          $req .= "&$key=$value";
        }
        
        // Step 2: POST IPN data back to PayPal to validate
        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        // In wamp-like environments that do not come bundled with root authority certificates,
        // please download 'cacert.pem' from "https://curl.haxx.se/docs/caextract.html" and set
        // the directory path of the certificate as shown below:
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        if ( !($res = curl_exec($ch)) ) {
          // error_log("Got " . curl_error($ch) . " when processing IPN data");
          curl_close($ch);
          exit;
        }
        curl_close($ch);
            if (strcmp ($res, "VERIFIED") == 0) {
              Yii::$app->mailer->compose()->setTextBody('xxxxt')
                ->setFrom('from@domain.com')
                ->setTo("yyourm@gmail.com")
                ->setSubject('sbj')
                ->send();
            } else if (strcmp ($res, "INVALID") == 0) {
              Yii::$app->mailer->compose()->setTextBody('cccc')
                ->setFrom('from@domain.com')
                ->setTo("yyourm@gmail.com")
                ->setSubject('sbj')
                ->send();
            }

        //$listener = new Paypalka();
        //$listener->use_sandbox = true;
        /*
        
        try {
            $listener->requirePostMethod();
            $verified = $listener->processIpn();
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit(0);
        }
        if ($verified) {
            Yii::$app->mailer->compose()->setTextBody('xxxxt')
                ->setFrom('from@domain.com')
                ->setTo("yyourm@gmail.com")
                ->setSubject('WOW!!')
                ->send();
        } else {
            /*
            An Invalid IPN *may* be caused by a fraudulent transaction attempt. It's
            a good idea to have a developer or sys admin manually investigate any 
            invalid IPN.
            */
            //mail('YOUR EMAIL ADDRESS', 'Invalid IPN', $listener->getTextReport());

    }
    public function beforeAction($action) 
    {
        
        if(Yii::$app->controller->action->id=="confirm-payment"){
            
            $this->enableCsrfValidation = false;
        }
            
        return parent::beforeAction($action);
    }
    
}
