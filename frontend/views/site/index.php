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
<?php if (Yii::$app->user->isGuest) : ?>
<div class="site-signup"  style="background: #6E6460;margin:20px 0 0 0;">
            <div class="row row-height" style=" padding: 60px 0 40px 0; margin: 0;">
                <div class="col-lg-12 text-center ">
                    <h1>I'm signing up as a</h1>
                    <ul class="choose-signup">
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['user/sign-in/family-signup'])?>"><button class="btn btn-primary">parent</button></a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['user/sign-in/nanny-signup'])?>"><button class="btn btn-primary">nanny</button></a>
                        </li>
                    </ul>

                </div>
            </div> 
</div>
<?php else : ?>
<div style="margin-top: 300px"></div>
<?php endif; ?>