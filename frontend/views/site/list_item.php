<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
use yii\helpers\Html;

?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <!-- Single Card list view -->
    <div class="list-view">
        <div class="card center-block">
            <a>
                <figure class="imghvr-zoom-in card-img"><img class="" src="<?= $model->avatar_base_url."/".$model->avatar_path ?>" alt="">
                    <figcaption>
                        <div class="rate-o"><b><?= preg_split('/\s+/', $model->name)[0] ?><?= $model->city->place_name=='N/A' ? "" :" from ".$model->city->place_name ?> seeks loving family</b></div>
                    </figcaption>
                </figure>
            </a>
            <div class="card-content">
                <h3><?= preg_split('/\s+/', $model->name)[0] ?></h3>
                <h4><a href="/nannies/?city=<?= $model->city->place_name ?>"><i class="fa fa-map-marker"></i><?= $model->city->place_name ?></a></h4>
                <p><?php echo $model->biography==""? "BIO currently unavailable..." : substr($model->biography, 0, 40)."..."; ?></p>
                <ul>
                    <li>
                        <a href="#" class="like-edit">
                            Age: <?= $model->age ?>
                        </a>
                    </li>
    
                </ul>
                <a href="nannies/view?id=<?= $model->id ?>" class="go-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i> Go</a>
            </div>
        </div>
    </div>
</div>

