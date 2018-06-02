<?php

namespace frontend\modules\pay\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class ParentController extends Controller
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

    public function actionStripe()
    {

        if (Yii::$app->request->post()){

            $data = Yii::$app->request->post();

            try 
            {
                \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
                                
                $token = Yii::$app->request->post('stripeToken');
                $email = $data['stripeEmail'];
                $service_plan = $data['plan'];
                $money = $data['money'];

                $charge = \Stripe\Charge::create([
                    'amount' => $money,
                    'currency' => 'usd',
                    'description' => $service_plan,
                    'source' => $token,
                ]);
    
                return redirect('/user/default/index');
            }
            catch (ErrorException $e)
            {
                return $this->redirect('/pay/stripe/error');
            }
            
        }

        return $this->goHome();
    }

    public function actionSuccess()
    {
        return "success";
    }

    public function actionError()
    {
        return "Oops....Error...Please contact us! ";
    }
}