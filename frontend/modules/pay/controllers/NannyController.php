<?php

namespace frontend\modules\pay\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\UserOrder;
use common\models\ParentNanny;
use common\commands\AddToTimelineCommand;

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

    public function actionStripeSignupFee()
    {
        
        if (Yii::$app->request->post())
        {
            
            $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
            $transaction = Yii::$app->db->beginTransaction($isolationLevel);
        try {
            $data = Yii::$app->request->post();

            \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
                            
            $token = Yii::$app->request->post('stripeToken');

            //order info
            $email = $data['stripeEmail'];
            $service_plan = $data['plan'];
            $money = $data['money'];
            //还必须在charge前面，因为charge里面用到了这个变量
            $user= User::findById($data['userid']);

            $charge = \Stripe\Charge::create([
                'amount' => $money,
                'currency' => 'usd',
                'description' => $service_plan,
                'source' => $token,
                'statement_descriptor' => 'NannyCare.com',
                'metadata' => ['user_id' =>$data['userid'], 'username' => $user->username, "user_type" => 'nanny', 'email' => $email],
            ]);
                
                $user->credits += 4999;//  one time signup fee
                $user->save(); 
                
                $order = new UserOrder();
                $order->user_id = $user->id;
                $order->user_type = "nanny";
                $order->payment_gateway = "stripe";
                $order->payment_gateway_id = $charge->id;
                $order->service_plan = $service_plan;
                $order->service_money = (int)$money;
                $order->timestamp = time(); //paid_at, to be precise
                $order->expired_at = strtotime('+5000 days');
                if ($order->save()) {
                    // 订单保存成功,写入事件日志
                    Yii::$app->commandBus->handle(new AddToTimelineCommand([
                        'category' => 'order',
                        'event' => 'nanny',
                        'data' => [
                            'public_identity' => Yii::$app->user->identity->getPublicIdentity(),
                            'order_id' => $order->id,
                            'user_id' => $order->user_id,
                            'created_at' => $order->timestamp
                        ]
                    ]));
                }

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                return $this->redirect('/pay/stripe/error');
            } 
            $money2 = (float)($money / 100);
            (new \common\lib\SendEmail([
                'subject' => 'We have got your payment ' . date('Y-m-d', time()),
                'to' => [$email, 'info@nannycare.com'],
                'body' => <<<EOT
                <h2>Hi, {$user->username}</h2>
                <h4>Your service plan is : {$service_plan} </h4>
                <h4>Your payment is : {$money2}  dollars. </h4>
                <h4>Your charge ID is: {$charge->id} </h4>
                <h4>Thank you for your business.</h4>
    
                Regards,
                Wendy Pierce
EOT
            ]))->handle();

            return  $this->redirect('/user/default/index');


        }

        return $this->goHome();
    }

    public function actionStripeListingFee()
    {
        if (Yii::$app->request->post())
        {
            
            $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
            $transaction = Yii::$app->db->beginTransaction($isolationLevel);
        try {
            $data = Yii::$app->request->post();

            \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
                            
            $token = Yii::$app->request->post('stripeToken');

            //order info
            $email = $data['stripeEmail'];
            $service_plan = $data['plan'];
            $money = $data['money'];
            //还必须在charge前面，因为charge里面用到了这个变量
            $user= User::findById($data['userid']);

            $charge = \Stripe\Charge::create([
                'amount' => $money,
                'currency' => 'usd',
                'description' => $service_plan,
                'source' => $token,
                'statement_descriptor' => 'NannyCare.com',
                'metadata' => ['user_id' =>$data['userid'], 'username' => $user->username, "user_type" => 'nanny', 'email' => $email],
            ]);
                
                $user->credits += 999;//  monthly signup fee
                $user->save(); 
                
                $order = new UserOrder();
                $order->user_id = $user->id;
                $order->user_type = "nanny";
                $order->payment_gateway = "stripe";
                $order->payment_gateway_id = $charge->id;
                $order->service_plan = $service_plan;
                $order->service_money = (int)$money;
                $order->timestamp = time(); //paid_at, to be precise
                $order->expired_at = strtotime('+30 days');
                if ($order->save()) {
                    // 订单保存成功,写入事件日志
                    Yii::$app->commandBus->handle(new AddToTimelineCommand([
                        'category' => 'order',
                        'event' => 'nanny',
                        'data' => [
                            'public_identity' => Yii::$app->user->identity->getPublicIdentity(),
                            'order_id' => $order->id,
                            'user_id' => $order->user_id,
                            'created_at' => $order->timestamp
                        ]
                    ]));
                }

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                return $this->redirect('/pay/stripe/error');
            } 
            $money2 = (float)($money / 100);
            (new \common\lib\SendEmail([
                'subject' => 'We have got your payment ' . date('Y-m-d', time()),
                'to' => [$email, 'info@nannycare.com'],
                'body' => <<<EOT
                <h2>Hi, {$user->username}</h2>
                <h4>Your service plan is : {$service_plan} </h4>
                <h4>Your payment is : {$money2}  dollars. </h4>
                <h4>Your charge ID is: {$charge->id} </h4>
                <h4>Thank you for your business.</h4>
    
                Regards,
                Wendy Pierce
EOT
            ]))->handle();

            return  $this->redirect('/user/default/index');


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