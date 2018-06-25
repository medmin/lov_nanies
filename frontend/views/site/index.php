<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
$dataProvider->pagination=false;
$dataProvider->totalCount=10;
?>
<!--
<div class="site-index">
        <div class="container home">
            <div class="row row-margin">
                <div class="col-lg-12">
                <?php /*echo \yii\widgets\ListView::widget([
                        'dataProvider'=>$dataProvider,
                        'pager'=>[
                            'hideOnSinglePage'=>true,
                            'prevPageLabel'=>'Prev',
                            'nextPageLabel'=>'Next',
                            'options'=>[
                              'class'=>'pagination',  
                            ],
                        ],
                        'options'=>[
                            'class'=>'tab-pane fade active in',
                        ],
                        'itemOptions' => [
                            'tag' => false
                        ],
                        'summary'=>'',
                        'itemView'=>'list_item'
                ])*/?>
                </div>
            </div>
        </div>
</div>
-->
<div class="site-signup"  style="background: #6E6460;margin:20px 0 0 0;">
            <div class="row row-height" style=" padding: 60px 0 40px 0; margin: 0;">
                <div class="col-lg-12 text-center ">
                    <h1>I'm signing up as a</h1>
                    <ul class="choose-signup">
                        <li>
                            <form method="get" action="family-signup">
                            <input type="hidden" name="role" value="parent">
                            <button class="btn">parent</button></form>
                        </li>
                        <li>
                            <form method="get" action="nanny-signup">
                            <input type="hidden" name="role" value="nanny">
                            <button class="btn btn-primary">nanny</button></form>
                        </li>
                    </ul>

                </div>
            </div> 
</div>

