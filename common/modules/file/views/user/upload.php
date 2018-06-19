<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/**  
 * @var $this yii\web\View
 * @var $form yii\widgets\ActiveForm
 * @var $model common\modules\file\models\UserFile
 * 
 */

$this->title = Yii::t('common', 'User Upload');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-upload">
    <div class="row">
    
        <?php if (Yii::$app->session->has('FileFormatError')): ?>
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>ERROR: <?=Yii::$app->session->get('FileFormatError') ?></h4>
            </div>
        <?php elseif (Yii::$app->session->has('UploadSuccess')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>SUCCESS: File Uploaded Successfully!</h4>
            </div>
        <?php elseif (Yii::$app->session->hasFlash('UploadFailure')): ?>
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>ERROR: File Upload Failure!</h4>
            </div>
        <?php endif; ?>
        <div class="col-lg-6 col-md-6">
            <?php $form = ActiveForm::begin([
                'id' => 'upload-form',
                'method' => 'post',
                'action' =>   '/file/user/upload',
                'options' => [ 'enctype' => 'multipart/form-data']
            ]); ?>
            <?= $form->field($model, 'user_id')->label(false)->hiddenInput([
                'value'=> Yii::$app->user->id
            ]) ?>
            <?= $form->field($model, 'file_uuid')->label(false)->hiddenInput([
                'value'=> \Ramsey\Uuid\Uuid::uuid4()->toString()
            ]) ?>
            <?= $form->field($model,'title')->label('File Name')->textInput(['maxlength' => 300]) ?>
            <!-- 这里为什么用link而不用file呢，因为这里是首先把文件传到后台，然后传给digitalocean，存储的是do的url -->
            <?= $form->field($model, 'link')->label(false)->fileInput() ?>
            <p class="text-muted well well-sm no-shadow">
                Attention: <br />
                You can upload only 1 file at once and the total size should be no more than 10M. <br>
                Supported formats are tif, png, jpg, doc, docx, xls, xlsx, ppt, pptx, pdf, zip, rar, 7z, txt.
            </p>
            <?=$form->field($model, 'status')->label(false)->hiddenInput([
                'value' => $model::STATUS_ACTIVE
            ]) ?>
            <?=$form->field($model, 'created_at')->label(false)->hiddenInput([
                'value' => time()
            ]) ?>
            <div class="form-group">
                    <?= Html::submitButton(Yii::t('frontend', 'Upload'), ['class' => 'btn btn-inverse', 'name' => 'upload-files-button']) ?>
                </div>
            <?php $form = ActiveForm::end() ?>
        </div>
    </div>
</div>