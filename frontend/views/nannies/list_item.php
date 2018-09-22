<?php
/**
 * @var yii\web\View
 * @var $model       common\models\Nannies
 */
?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item ">
    <div class="card center-block" data-user-id="<?= $model->id ?>">
            <a>
                <figure class="imghvr-zoom-in card-img"><img class="" src="<?= $model->avatar_base_url.'/'.$model->avatar_path ?>" alt="">
                    <figcaption>
                        <div class="rate-o"><b><?= preg_split('/\s+/', $model->name)[0] ?><?= $model->city->place_name == 'N/A' ? '' : ' from '.$model->city->place_name ?> seeks loving family</b></div>
                    </figcaption>
                </figure>
            </a>
            <div class="card-content">
                <ul class="tags-list"></ul>
                <h3><?= preg_split('/\s+/', $model->name)[0] ?></h3>
                <!--<h4><i class="fa fa-map-marker"></i>  Carson City, NV</h4>-->
                <p><?php echo $model->biography == '' ? 'BIO currently unavailable...' : substr($model->biography, 0, 40).'...'; ?></p>
                <ul>
                    <li>
                        <a href="#" class="like-edit">
                            Age: <?= $model->age ?>
                        </a>
                    </li>
                    <li>
                        <a href="?city=<?= $model->city->place_name ?>" class="like-edit">
                            <i class="fa fa-map-marker"></i><?= $model->city->place_name ?>
                        </a>
                    </li>
                </ul>
                <a href="view?id=<?= $model->id ?>" class="go-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i> Go</a>
            </div>
            
    </div>
</div>