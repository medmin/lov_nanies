<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
$dataProvider->pagination=false;
$dataProvider->totalCount=10;
?>

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
