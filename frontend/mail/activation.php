<?php
/**
 * @var $this \yii\web\View
 * @var $url \common\models\User
 */
?>
<?php echo Yii::t('frontend', 'Thank you for registering with HeyNanny.com! Please click on the link to activate your account. {url} Thank you!', ['url' => Yii::$app->formatter->asUrl($url)]) ?>
