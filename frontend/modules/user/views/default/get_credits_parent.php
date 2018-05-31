<?php
/* @var $this yii\web\View */
use yii\web\View;

$this->title = Yii::t('frontend', 'Get credits');
//这段是干嘛的？
$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
        console.log($("slide").height());
        
            });
    ',
    View::POS_READY,
    'my-button-handler'
);
?>
<div class="columns">
  <ul class="price">
    <li class="header">Basic</li>
    <li class="grey">$74.99</li>
    <li>3 credits</li>
    <li>Contact 3 nannies</li>
    <li class="grey"><a href="create-payment" class="btn btn-inverse">Buy</a></li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header" style="background-color: #DD980D;"><span style="display: block;font-size: 10px; line-height: 0;">Most Popular</span>Bronze</li>
    <li class="grey">$129.99</li>   
    <li>6 credits</li>
    <li>Contact 6 nannies</li>
    <li class="grey"><a href="#" class="btn btn-inverse">Buy</a></li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header">Gold</li>
    <li class="grey">$199.99</li>
    <li>10 credits</li>
    <li>Contact 10 nannies</li>
    <li class="grey"><a href="#" class="btn btn-inverse">Buy</a></li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header">Platinum</li>
    <li class="grey">$379.99</li>
    <li>20 credits</li>
    <li>Contact 20 nannies</li>
    <li class="grey"><a href="#" class="btn btn-inverse">Buy</a></li>
  </ul>
</div>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="yyourm-facilitator@gmail.com">
  <input type="hidden" name="item_name" value="hat">
  <input type="hidden" name="item_number" value="123">
  <input type="hidden" name="amount" value="00.01">
  <!--<input type="hidden" name="notify_url" value="http://new.lovingnannies.com/user/sign-in/confirm-payment/">-->
  <input type="hidden" name="city" value="Berwyn">
  <input type="hidden" name="state" value="PA">
  <input type="hidden" name="zip" value="19312">
  <input type="hidden" name="night_phone_a" value="610">
  <input type="hidden" name="night_phone_b" value="555">
  <input type="hidden" name="night_phone_c" value="1234">
  <input type="hidden" name="email" value="jdoe@zyzzyu.com">
    <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
</form>