<?php
/**
 * @var \yii\web\View
 * @var $url          \common\models\User
 */
?>
<?php echo Yii::t('frontend', 'Thank you for registering with NannyCare.com! Please click on the link to activate your account. {url} Thank you!', ['url' => Yii::$app->formatter->asUrl($url)]) ?>
