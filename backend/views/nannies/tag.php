<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('backend', 'Tag');
$this->params['breadcrumbs'][] = $this->title;

$user_id = $model->id;
$js = <<<JS
$(function() {
  $.get('/tag/default/user-tag', {user_id: $user_id}, function(data){
     let str = '';
     $.each(data, function(index, item) {
       str += generateUserTagHtml(item.name, item.icon, item.info, item.id);
     });
     if (str.length > 0) {
         $('.user-tag').html(str);
         $('.no-tag').hide();
     }
  }, 'json');
 
  $.get('/tag/default/list', function(data) {
    let _select = $('#tags');
    $.each(data, function(key, value) {
      _select.append("<option value="+ value.id +">"+ value.name +"</option>")
    })
  });
 
  $('body').on('click', '.delete-tag', function() {
    let _this = $(this);
    if (confirm('Are you sure you want to delete this item?')){
        $.ajax({
            url: '/tag/default/delete-user-tag?'+ $.param({user_id: $user_id, id: _this.data('id')}),
            type: 'POST',
            success: function(data) {
              if (data) {
                    _this.parents(".info-box").parent().remove();
               } else {
                    console.log('delete fail')
               }
            },
            async: false  // if do not turn off async,$(".xxx").html() still have value
        })
        if ($(".user-tag").html().trim() === '') $('.no-tag').show();
     }
 });
 
 $('#addTag').click(function() {
   let tag_id = $('#tags').val();
   if (!tag_id) {
       alert('Please select tag');
       return false;
   }
   $.post('/tag/default/create-user-tag?'+ $.param({user_id: $user_id, tag_id: tag_id}),function(data) {
     if (data) {
         $('.no-tag').hide();
         $('.user-tag').append(generateUserTagHtml(data.name, data.icon, data.info, data.id));
     } else {
         console.log('create fail')
     }
   })
 });
 
 function generateUserTagHtml(name, icon, info, id) {
     let str = '';
      str += "<div class='col-md-3'><div class='info-box'>";
      str += "<span class='info-box-icon bg-aqua'><i class='fa fa-"+ icon +"'></i></span>";
      str += "<div class='info-box-content'><span class='info-box-text'>"+ name +"</span><span class='info-box-info'>"+ info +"</span><button class='btn btn-flat btn-danger btn-xs pull-right delete-tag' type='button' data-id="+ id +">delete</button></div>";
      str += "</div></div>";
      return str;
 }
})
JS;

$css = <<<CSS
  .info-box-info {
    display: block;
    font-size: 18px;
    line-height: 36px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  .select-tag {
    margin-bottom: -15px;
  }
CSS;

$this->registerJs($js, \yii\web\View::POS_END);
$this->registerCss($css);
?>
<section class="signup-process" style="margin-top:20px;">
    <?php $form = ActiveForm::begin(['action' =>['update?id='.$model->id.'&step=2']]); ?>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <ul class="process-label">
            <a href="update?id=<?php echo $model->id;?>&step=1"><li class="process-label2" id="label-1">Main </li></a>
            <a href="update?id=<?php echo $model->id;?>&step=2"><li class="process-label2" id="label-2">Questions & Schedule</li></a>
            <a href="update?id=<?php echo $model->id;?>&step=3"><li class="process-label2" id="label-3">Education & Driving</li></a>
            <a href="update?id=<?php echo $model->id;?>&step=4"><li class="process-label2" id="label-4">Housekeeping</li></a>
            <a href="update?id=<?php echo $model->id;?>&step=5"><li class="process-label2" id="label-5">About you</li></a>
            <br>
            <a href="update?id=<?php echo $model->id;?>&step=tag"><li class="process-label2 active" id="label-tag">Nanny Tag</li></a>
        </ul>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class=""></i> Tag</h3>
                </div>
                <div class="panel-body">
                    <p class="no-tag">No tags found.</p>
                    <div class="user-tag">
                    </div>
                </div>
                <div class="panel-footer form-horizontal">
                    <div class="select-tag">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="tags">Add tag for nanny</label>
                            <div class="col-sm-5">
                                <select name="tags" id="tags" class="form-control">
                                    <option disabled selected>select tag</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="button" class="btn btn-info" value="submit" id="addTag"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- #FORM ENDS -->

</section>
