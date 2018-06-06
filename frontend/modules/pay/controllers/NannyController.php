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
                'metadata' => ['user_id' =>$data['userid'], 'username' => $user->username, "user_type" => 'parent', 'email' => $email],
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
                        'event' => 'parent',
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
                'metadata' => ['user_id' =>$data['userid'], 'username' => $user->username, "user_type" => 'parent', 'email' => $email],
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
                        'event' => 'parent',
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

    public function actionMonthlyShouldRenew()
    {
       //post or get ?  if ajax is successful, it shoud use post
            $data = Yii::$app->request->get();
            $nannyid = $data['nannyid'];
            $payrecords = UserOrder::find()->where(['user_id'=> $nannyid, "service_money" =>999])->all();
            if ($payrecords)//不为空，说明是有纪录的
            {
                $expires_at = 0;
                foreach ($payrecords as $record)
                {
                    if ($record->expired_at > $expires_at )
                    {
                        $expires_at = $record->expired_at;
                    }
                }

                if ($expires_at >= time()){
                    return "hasexpired";
                }
                else if ($expires_at >= strtotime('-7 days')){
                    return "soon";
                }
            }
            else {
                return "norecord";
            }
    }
}