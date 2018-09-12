<?php
/**
 * User: xczizz
 * Date: 2018/9/4
 * Time: 14:08
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = Yii::t('backend', 'Tags');
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
$(function() {
  $.get('/tag/default/list', function(data) {
    if(data.length > 0){
       let str='';
       $.each(data, function(index, item) {
         str += "<tr data-key="+ item.id +">";
         str += "<td>" + item.id + "</td>";
         str += "<td>" + item.name + "</td>";
         str += "<td class='tag-info'>" + item.info + "</td>";
         str += "<td>" + item.target + "</td>";
         str += "<td><i class='fa fa-"+ item.icon +"'></i></td>";
         str += "<td>" + timestampToTime(item.created_at) + "</td>";
         let delete_url = "/tag/default/delete?id=" + item.id;
         str += "<td><a class=\"edit-tag-a\" href=\"javascript:;\" title=\"Update\" aria-label=\"Update\" data-id="+ item.id +" data-pjax=\"0\"><span class=\"glyphicon glyphicon-pencil\"></span></a> <a class=\"delete-tag-a\" href=\"javascript:;\" title=\"Delete\" aria-label=\"Delete\" data-pjax=\"0\" data-url="+ delete_url +"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
         str += "</tr>";
       });
       $(".tag-list > table > tbody").html(str);
    }
  }, 'json');
  
  $(".create-tag-btn").click(function() {
    $('.modal-title').text('Create Tag');
    $('#tagModal').modal('show')
  });
  
  let _body = $('body');
  
  _body.on('click', '.edit-tag-a', function() {
    let _tr = $("tr[data-key="+$(this).data('id')+"]");
    $('#name').val(_tr.children("td:eq(1)").text());
    $('#info').val(_tr.children("td:eq(2)").text());
    $('#id').val($(this).data('id'));
    $('#target').val(_tr.children("td:eq(3)").text());
    $('#icon').val(_tr.children("td:eq(4)").children("i").attr("class").slice(6));
    $('.modal-title').text('Update Tag');
    $("#tagModal").modal('show')
  });
  
  _body.on('click', '.delete-tag-a', function() {
    let _this = $(this);
    if (confirm('If it\'s deleted, all user-related tags will be cancelled, continue?')){
        $.post(_this.data('url'), function(data) {
          if (data) {
              _this.parents('tr').hide();
          } else {
              console.log('delete fail')
          }
        })
    }
  });
  
  $('#tagModal').on('hidden.bs.modal', function() {
    $('#tagForm')[0].reset();
    $("input[type='hidden']").val('');
  });
  
  $('.submit').click(function() {
    let _params = $('#tagForm').serialize();
    if (!$('#name').val()) return false;
    if ($('#id').val()) {
        $.post('/tag/default/update?' + _params, function(data) {
          if (data !== false) {
              window.location.reload(); // TODO should use ajax reload
          } else {
              console.log('update fail')
          }
        }, 'json')
    } else {
        $.post('/tag/default/create?' + _params, function(data) {
          if (data !== false) {
              window.location.reload(); // TODO should use ajax reload
          } else {
              console.log('create fail')
          }
        }, 'json')
    }
  })
})
JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>
<div class="tag-index">
    <p>
        <?php echo Html::a(Yii::t('backend', 'Create Tag'), 'javascript:;', ['class' => 'btn btn-success create-tag-btn']) ?>
    </p>
    <div class="tag-list">
        <table class="table table-striped table-bordered">
            <thead>
            <tr><th>ID</th><th>Name</th><th>Info</th><th>Target</th><th>Icon</th><th>Created At</th><th>Operate</th></tr>
            </thead>
            <tbody>
                <tr><td colspan="7"><div class="empty">No results found.</div></td></tr>
            </tbody>
        </table>
    </div>
</div>

<div class="tag-modal">
    <div class="modal" id="tagModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create Tag</h4>
                </div>
                <form class="form-horizontal" id="tagForm">
                <div class="modal-body">
                    <input type="hidden" value="" name="id" id="id">
                    <div class="form-group">
                        <label for="target" class="col-sm-2 control-label">Target</label>
                        <div class="col-sm-10">
                            <select name="target" id="target" class="form-control">
                                <option value="nanny" selected>Nanny</option>
                                <option value="parent">Parent</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="tag name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icon" class="col-sm-2 control-label">Icon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="icon" id="icon" placeholder="Reference https://fontawesome.com/v4.7.0/icons/">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="col-sm-2 control-label">Info</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="info" id="info" placeholder="Information ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>