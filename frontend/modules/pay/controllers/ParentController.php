<?php

namespace frontend\modules\pay\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\UserOrder;
use common\models\ParentNanny;
use common\commands\AddToTimelineCommand;

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
        
        if (Yii::$app->request->post())
        {
            
            $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
            $transaction = Yii::$app->db->beginTransaction($isolationLevel);
        try {
            $data = Yii::$app->request->post();
            $service_plan = $data['plan'];
            switch ($service_plan) {
                case UserOrder::ParentServicePlans()['basic']:
                    $money = 5900;
                    $credits = 25;
                    $expired_days = 0;
                    break;
                case UserOrder::ParentServicePlans()['bronze']:
                    $money = 14900;
                    $credits = 100;
                    $expired_days = 90;
                    break;
                case UserOrder::ParentServicePlans()['gold']:
                    $money = 47900;
                    $credits = 250;
                    $expired_days = 365;
                    break;
                default:
                    throw new \Exception('Invalid Service Plan');
            }
          
            \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
                            
            $token = Yii::$app->request->post('stripeToken');

            //order info
            $email = $data['stripeEmail'];

            $user= User::findById(Yii::$app->user->id);

            $charge = \Stripe\Charge::create([
                'amount' => $money,
                'currency' => 'usd',
                'description' => $service_plan,
                'source' => $token,
                'statement_descriptor' => 'NannyCare.com',
                'metadata' => ['user_id' => $user->id, 'username' => $user->username, "user_type" => 'parent', 'email' => $email],
            ]);
                
                $user->credits += $credits;
                

                $order = new UserOrder();
                $order->user_id = $user->id;
                $order->user_type = "parent";
                $order->payment_gateway = "stripe";
                $order->payment_gateway_id = $charge->id;
                $order->service_plan = $service_plan;
                $order->service_money = (int)$money;
                $order->timestamp = time();
                $order->expired_at = strtotime('+5000 days');

                // 如果不是 basic （即不是 59 的话，就有发帖订单）
                if ($service_plan != UserOrder::ParentServicePlans()['basic']) {
                    $expired_at = UserOrder::ParentPostStatus($user->id);
                    if ($expired_at) {
                        $expired_at = $expired_at + $expired_days * 86400;
                    } else {
                        $expired_at = strtotime('+' . $expired_days . ' days');
                    }
                    $NinetyDaysPosting = new UserOrder();
                    $NinetyDaysPosting->setAttributes([
                        'user_id' => $user->id,
                        'user_type' => 'parent',
                        'payment_gateway' => 'stripe',
                        'payment_gateway_id' => $charge->id,
                        'service_plan' => 'Ninety-Days-Posting',  // 现在不管是 90 天还是 1 年，都统一用这个名称
                        'service_money' => 0,
                        'timestamp' => time(),
                        'expired_at' => $expired_at
                    ]);
                }

                if ( $user->save() && $order->save() && (isset($NinetyDaysPosting) ? $NinetyDaysPosting->save() : true)) {
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
                else{
                    throw new \Exception('Database Save Failure');
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
                <p>Your service plan is : {$service_plan} </p>
                <p>Your payment is : {$money2}  dollars. </p>
                <p>Your charge ID is: {$charge->id} </p>
                <p>Thank you for your business.</p>
                Thank you,<br />
                Team NannyCare.com
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

    public function actionContactNanny()
    {
        if (Yii::$app->request->post())
        {
            // Array ( [user_id] => 330 [nanny_id] => 31  )
            $data=Yii::$app->request->post();
            $parent_id = $data['user_id'];
            $nanny_id = $data['nanny_id'];
        
            $r = ParentNanny::find()->where(['parentid' => $parent_id, 'nannyid' => $nanny_id])->all();
            
            if ( !$r )
            {
                $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
                $transaction = Yii::$app->db->beginTransaction($isolationLevel);
                try 
                {
                    
                    $parentnanny = new ParentNanny();
                    $parentnanny->parentid = (int)$parent_id;
                    $parentnanny->nannyid = (int)$nanny_id;
                    $parentnanny->timestamp = time();
                    

                    // here, parent is actually user
                    $parent = User::findById($parent_id);
                    $parent->credits -= 1;
                    

                    if ($parentnanny->save() && $parent->save())
                    {
                        // 订单保存成功,写入事件日志
                        Yii::$app->commandBus->handle(new AddToTimelineCommand([
                            'category' => 'order',
                            'event' => 'parent-get-nanny-info',
                            'data' => [
                                'public_identity' => Yii::$app->user->identity->getPublicIdentity(),
                                'order_id' => $parentnanny->id,
                                'user_id' => $parentnanny->parentid,
                                'created_at' => $parentnanny->timestamp
                            ]
                        ]));
                    }
                    else {
                        throw new \Exception('Database Save Failure');
                    }

                    $transaction->commit();

                } catch (\Exception $e) {
                    $transaction->rollBack();
                    return $this->redirect('/pay/stripe/error');
                } 

                return  $this->redirect('/user/default/index');

            }
            else{
                return  $this->redirect('/user/default/index');
            }

        }
        return 'OK';
    }

    public function actionPostOnly()
    {
        if (Yii::$app->request->isPost)
        {
            // $expired_at = UserOrder::ParentPostStatus($user->id);
            // if ($expired_at) 
            // {
            //     $expired_at = $expired_at + $expired_days * 86400;
            // } 
            // else 
            // {
            //     $expired_at = strtotime('+' . $expired_days . ' days');
            // }

            /**
             * 不管那么多，就是单纯加90天。
             * 这个单独的服务，本意就是不用付款，就可以发帖了。
             */
            $expired_at = strtotime('+90 days');

            $NinetyDaysPosting = new UserOrder();
            $NinetyDaysPosting->setAttributes([
                'user_id' => Yii::$app->user->id,
                'user_type' => 'parent',
                'payment_gateway' => 'stripe',
                'payment_gateway_id' => 'free order', // 暂时先定用 free order
                'service_plan' => 'Ninety-Days-Posting', //发帖服务都叫这个名字，不管时间长短
                'service_money' => 0,
                'timestamp' => time(),
                'expired_at' => $expired_at
            ]);

            if ($NinetyDaysPosting->save())
            {
                Yii::$app->commandBus->handle(new AddToTimelineCommand([
                    'category' => 'order',
                    'event' => 'parent',
                    'data' => [
                        'public_identity' => Yii::$app->user->identity->getPublicIdentity(),
                        'order_id' => $NinetyDaysPosting->id,
                        'user_id' => $NinetyDaysPosting->user_id,
                        'created_at' => $NinetyDaysPosting->timestamp
                    ]
                ]));

                return $this->redirect('/user/default/index');
            }
            else
            {
                throw new \Exception('Database Save Failure');
            }
        }
        return $this->redirect('/user/default/get-credits');
    }
}