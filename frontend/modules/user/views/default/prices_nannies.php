<?php
/* @var $this yii\web\View */
use yii\web\View;

$this->title = Yii::t('frontend', 'Get credits');
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
<h2 style="color: #272727;">Find me a Nanny Job!</h2>

<h3>Cost: $24.99</h3>
<p>This is our cost for the background check. Each nanny will receive an email link to fill out the background check form. She will also get a copy of the background check once it's completed. This is non refundable if your background check comes back with any misdemeanors, arrests or convictions on it.  
</p>
<a href="" class="btn btn-inverse">Sign Me Up!</a>
<h3>$9.99</h3>
<p>This is a monthly subscription fee to be listed on our site. This can be put on hold status or cancelled at any time by the nanny. This will start only after we have received your background check, verified your references and accepted you. At this time we will approve your profile and you will be listed on our site. 
</p>