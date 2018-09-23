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
use common\models\UserOrder;
use common\models\UserToken;
use common\components\Paypalka;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\PasswordResetRequestForm;
use frontend\modules\user\models\ResetPasswordForm;
use frontend\modules\user\models\SignupForm;
use yii\helpers\Url;
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
                            'signup', 'confirm-payment', 'nanny-signup', 'family-signup', 'login', 'request-password-reset', 'reset-password', 'oauth', 'activation','manual-activation'
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
                            //既然要求登陆用户才可以访问这些action，那干脆就重定向到登录页
                            return Yii::$app->controller->redirect(['/user/sign-in/login']);
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

        /**这两行啥意思？
         * doze reply： 
         * 这两行是原作者用来设置页面是否需要设置导航栏（可能不是导航栏，但肯定是页面上需要展示的内容）,
         * 对应用到的地方在frontend\views\layouts\main.php文件中的第 26 行到 42 行之间
        */
        Yii::$app->view->params['offslide'] = 1;
        Yii::$app->view->params['slider'] = "login";

        if(Yii::$app->request->post()){
            $model->load($_POST);
            $login = Yii::$app->request->post('LoginForm')['identity'];

            $user = User::find()
                        ->where([
                                'or',
                                ['username'=>$login ],
                                ['email'=>$login] 
                            ])
                        ->one();
            if ($user) {
                if ($user->status == User::STATUS_DELETED)
                {
                    Yii::$app->session->setFlash('alert', [
                        'options'=>['class'=>'alert-danger'],
                        'body'=>Yii::t('frontend', 'Sorry, user was disabled', [])
                    ]);
                    return $this->render('login', ['model' => $model]);
                }
                if ($user->status == User::STATUS_NOT_ACTIVE) {
                    Yii::$app->session->setFlash('LOGIN_ERROR');
                    return $this->render('login', ['model' => $model]);
                }
            }
        }
        
        if (Yii::$app->request->isAjax) 
        {
            $model->load($_POST);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            /**这里，如果是nanny，刚注册，step是1，
             * 除非填写接下来的所有信息，step就一直小于6，
             * 直到完成所有表格，step才变为8
             * 如果注册的时候，身份选的是parent，注册后，不管是否激活，step就是7
            */

            //这里，身份是注册了，激活了，但未填写信息的parent
            if ( Yii::$app->user->identity->step == 7 )
            {
                return $this->actionContinueRegistration();
            }
            //刚注册且激活了的nanny，是否付款未知
            else if (Yii::$app->user->identity->step < 6 )
            {
                $userid = Yii::$app->user->id;
                /**判断保姆是否已经支付过了signup fee和monthly fee
                 * 为了便于阅读，搞成这样，请doze见谅
                 * 
                 * 下面这if是已经支付了注册费且月费没过期的保姆
                 */ 
                if (
                    User::findById($userid)->credits >= 9999 
                    && UserOrder::NannyListingFeeStatus($userid)
                    )
                {
                    return $this->redirect(['/user/default/index']);
                }

                //没付款就重定向去付款页面
                return $this->redirect(['/user/default/get-credits']);
            }

            //这里是所有信息填写完毕的parent和nanny
            return $this->redirect(['/user/default/index']);
        }
        
        return $this->render('login', [
            'model' => $model
        ]);
    }


    public function actionManualActivation()
    {
        if (Yii::$app->request->isPost)
        {
            $email = Yii::$app->request->post('myEmail');

            $user = User::find()->where(['email' => $email])->one();

            if (!$user)
            {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t(
                        'frontend',
                        'Email Not found!'
                    ),
                    'options' => ['class' => 'alert-warning']
                ]);
                return $this->render('manual-activation');
            }
            elseif ($user->status == 2)
            {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t(
                        'frontend',
                        'Your account is already activated!'
                    ),
                    'options' => ['class' => 'alert-success']
                ]);
                return Yii::$app->controller->redirect(['/user/sign-in/login']);
            }

            $token = UserToken::create(
                $user->id,
                UserToken::TYPE_ACTIVATION,
                \cheatsheet\Time::SECONDS_IN_A_DAY
            );
            (new \common\lib\SendEmail([
                'subject' => Yii::t('frontend', 'Activation email'),
                'to' => $email,
                'body' => Yii::t('frontend', 'Thank you for registering with NannyCare.com! Please click on the link to activate your account. {url} Thank you!', ['url' => Yii::$app->formatter->asUrl(Url::to(['/user/sign-in/activation', 'token' => $token->token], true))])
            ]))->handle();

            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t(
                    'frontend',
                    'The new activation email has been sent to your email address. <br/>
                    Please check your email inbox for further instructions.<br/>
                    If you don\'t see the activation email, check your junk mail folder.'
                ),
                'options' => ['class' => 'alert-success']
            ]);
            return Yii::$app->controller->redirect(['/user/sign-in/login']);
        }
        return $this->render('manual-activation');
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
   
    public function actionContinueRegistration()
    {
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
                            'Your account has been successfully created!<br/>
                            Please check your email for further instructions.<br/>
                            If you don\'t see the activation email, check your junk mail folder.'
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
                            'Your account has been successfully created!<br/>
                            Please check your email for further instructions.<br/>
                            If you don\'t see the activation email, check your junk mail folder.'
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
        Yii::$app->view->params['fluid'] = true;

        return $this->render('selectSignup');
    }

    /**
     * @param $token
     * @return Response
     */
    public function actionActivation($token)
    {
        $token = UserToken::find()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->notExpired()
            ->one();

        if (!$token) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t(
                    'frontend',
                    'Your activation link is expired.<br>Please request a new activation link.'
                ),
                'options' => ['class' => 'alert-warning']
            ]);
            return Yii::$app->controller->redirect(['/user/sign-in/manual-activation']);
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

        if(array_key_exists('nanny',$tmpArr2))
        {
            Nannies::initialization();
            return $this->redirect(['/user/default/index']);
            // return  Yii::$app->controller->redirect(['/user/sign-in/continue-registration']);
        }
        else
        {
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
    
    public function beforeAction($action) 
    {
        
        if(Yii::$app->controller->action->id=="confirm-payment"){
            
            $this->enableCsrfValidation = false;
        }
            
        return parent::beforeAction($action);
    }


    
    
}
