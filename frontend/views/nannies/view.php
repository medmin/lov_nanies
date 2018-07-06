<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use common\models\User;
$this->registerJs(
    '
    if($(".profile-picture").height()<$(".hideContent").height()){
        if($(".profile-picture").height()>300){
           $(".hideContent").height($(".profile-picture").height());
           var size=$(".profile-picture").height();
        }else{
            $(".hideContent").height("200px");
            var size = "200px";
        }
    }else{
        $(".show-more").hide();
    }
    $(".open-popup-link").magnificPopup({
        type:"inline",
        midClick: true,
        });
    $(".show-more a").on("click", function(e) {
                        var $this = $(this); 
                        var $content = $this.parent().prev("div.content");
                        var linkText = $this.text().toUpperCase();    
                        e.preventDefault();
                        if(linkText === "SHOW MORE"){
                            linkText = "Show less";
                            $content.switchClass("hideContent", "showContent", 900);
                            $(".showContent").height("auto");
                        } else {
                            linkText = "Show more";
                            $content.switchClass("showContent", "hideContent", 900);
                            $(".hideContent").height(size);
                        };
                    
                        $this.text(linkText);
                    });
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
    });
    ',
    View::POS_READY,
    'my-button-handler'
);
?> 
<div class="row candidate">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class=" row-margin">
        <div class="col-lg-12">
        <div class="col-lg-5 col-md-3 col-sm-12 profile-picture">
            <img src="<?= $model->avatar_base_url."/".$model->avatar_path ?>" alt="" class="img-responsive nanny-profile-pic">
        </div>
        <div class="col-lg-7 col-md-9 col-sm-12">
            <h4 class="vtab-head" style="margin-top: 0px;"><?= preg_split('/\s+/', $model->name)[0] ?> seeks loving family<span style="float: right;"><a style="  color: #434343;" href="./?city=<?= $model->city->place_name ?>"><b style="color: #2DD1AF;"><i class="fa fa-map-marker"></i>  </b><?= $model->city->place_name ?> </a></span></h4>
            <div class="text-container">
                <div class="content hideContent">
                    <p><?= $model->biography; ?></p>
                </div>
                <div class="show-more">
                    <a class="btn btn-inverse" href="#">Show more</a>
                </div>
            </div>
        </div><div style="clear: both;"></div><br>
            <div class="col-sm-6">
                <ul class="candidate-features">
                    <li><i class="fa fa-check"></i>
                        <?= $model->age ?> years old
                    </li>
                    <li><i class="fa fa-check"></i>
                        <?= $model->childcare_exp ?> years of childcare experience
                    </li>
                    <li><?php echo $model->eligible_to_work==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                        Eligible to work in the U.S
                    </li>
                    <li><?php echo $model->aviliable_for_interview==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                        Available for interview
                    </li>
                </ul><br>
                
            </div>                
            <div class="col-sm-6">
                <ul class="candidate-features">
                    <li><?php echo $model->have_work_visa==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                        Have work visa
                    </li>
                    <li><?php echo $model->valid_licence==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                        Valid driver's licence
                    </li>
                    <li><?php echo $model->employed==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                        Currently employed
                    </li>
                    <li><?php echo $model->may_contact_employer==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                        May we contactyour employer?
                    </li>
                </ul>
            </div>
            <div style="clear: both;"></div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>When can you start?</label>
                    <p><?= $model->when_can_start?></p>
                </div>
                <div class="form-group">
                    <label>Hours willing to work per week</label>
                    <p><?= $model->hours_per_week?></p>
                </div>
                <div class="form-group">
                            <label>When can you start?</label>
                            <p><?= $model->when_can_start?></p>
                        </div>
                <?php
                    echo $model->personal_comments!='' ?'<div class="form-group">
                            <label>Personal comments</label>
                            <p>'.$model->personal_comments.'</p>
                        </div>' :'';
                ?>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Gross hourly rate</label>
                    <p><?= $model->hourly_rate?></p>
                </div>
                <div class="form-group">
                    <label>Weekly salary requested</label>
                    <p><?php echo $model->weekly_salary==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                </div>
                <div class="form-group">
                    <label>Additional wage comment</label>
                    <p><?= $model->wage_comment?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 popup1">
            <a href=<?= Yii::$app->user->isGuest ? "#login-popup" : ( User::findById(Yii::$app->user->id)->credits > 0 ? "#contact-nanny-popup" : "#buy-credit-popup" ) ?>   data-effect="mfp-zoom-in" style="line-height: 60px;" class="btn btn-inverse btn-contact open-popup-link mfp-zoom-in">Contact Candidate</a>
        </div>
        <div class="col-lg-12">
            <div class="panel-group candidate">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseOne">
                                Position apllying for
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel-body table-responsive panel-collapse collapse" id="collapseOne" aria-expanded="true">
                        <ul class="panel-list">
                            <li><?php echo in_array('1', $model->position_for) ?
                                '<i class="fa fa-check"></i>Part Time Nanny':'<i class="fa fa-times"></i><span>Part Time Nanny</span>';?>
                            </li>
                            <li><?php echo in_array('2', $model->position_for) ?
                                '<i class="fa fa-check"></i>Full Time Nanny':'<i class="fa fa-times"></i><span>Full Time Nanny</span>';?>
                            </li>
                            <li><?php echo in_array('3', $model->position_for) ?
                                '<i class="fa fa-check"></i>Live-in Nanny':'<i class="fa fa-times"></i><span>Live-in Nanny</span>';?>
                            </li>
                            <li><?php echo in_array('4', $model->position_for) ?
                                '<i class="fa fa-check"></i>Babysitter':'<i class="fa fa-times"></i><span>Babysitter</span>';?>
                            </li>
                            <li><?php echo in_array('5', $model->position_for) ?
                                '<i class="fa fa-check"></i>Newborn Specialist':'<i class="fa fa-times"></i><span>Newborn Specialist</span>';?>
                            </li>
                            <li><?php echo in_array('6', $model->position_for) ?
                                '<i class="fa fa-check"></i>Caregiver':'<i class="fa fa-times"></i><span>Caregiver</span>';?>
                            </li>
                            <li><?php echo in_array('7', $model->position_for) ?
                                '<i class="fa fa-check"></i>Housekeeper':'<i class="fa fa-times"></i><span>Housekeeper</span>';?>
                            </li>
                            <li><?php echo in_array('8', $model->position_for) ?
                                '<i class="fa fa-check"></i>Special Needs Nanny':'<i class="fa fa-times"></i><span>Special Needs Nanny</span>';?>
                            </li>
                            <li><?php echo in_array('9', $model->position_for) ?
                                '<i class="fa fa-check"></i>Elderly Care':'<i class="fa fa-times"></i><span>Elderly Care</span>';?>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-group candidate">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                                Experience, certificates and other
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel-body table-responsive panel-collapse collapse" id="collapseThree" aria-expanded="true">
                    <div class="row">
                    <div class="col-md-12">
                        <ul class="panel-list">
                            <li><?php echo $model->crp_certified==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                CPR certified
                            </li>
                            <li><?php echo $model->first_aid_certified==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                First Aid Certified
                            </li>
                            <li><?php echo $model->need_crp_fa_renew!=1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                CPR\First Aid up to date
                            </li>
                            <li><?php echo $model->tb_test==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                TB test done
                            </li>
                            <li><?php echo $model->pet_allergies==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                Pet allergies
                            </li>
                            <li><?php echo $model->smoking==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                Smoking
                            </li>
                            <li><?php echo $model->valid_passport==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                Have a valid passport
                            </li>
                            <li><?php echo $model->swim==1 ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i> ' ?>
                                Swimmer
                            </li>
                        </ul>
                    </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Will you work at home with a parent that smokes?</label>
                                <p><?php echo $model->work_if_parent_smokes==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Will you travel with the family?</label>
                                <p><?php echo $model->trawel_with_family==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Any travel restrictions?</label>
                                <p><?=$model->travel_restrictions?></p>
                            </div>
                            <div class="form-group">
                                <label>List all cities you have lived in and for how long:</label>
                                <p><?=$model->states_lived_in?></p>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Will you work in a home with a parent that is home?</label>
                                <p><?php echo $model->work_if_parent_at_home==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Miles you are willing to commute:</label>
                                <p><?=$model->miles_to_commute?></p>
                            </div>
                            <div class="form-group">
                                <label>Do you have a child of your own you need to bring?</label>
                                <p><?php echo $model->child_of_your_own==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Work with a dog or cat at home?</label>
                                <p><?php echo $model->dog_cat_at_home==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Would you wear a uniform or dress code?</label>
                                <p><?php echo $model->uniform_dress_code==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                    <div class="col-md-12" style="margin-bottom:20px;">
                        <h4 class="panel-list-head">Availability</h4>
                        <ul class="panel-list">
                            <li><?php echo in_array('0', $model->availability) ?
                                '<i class="fa fa-check"></i>Full time live in':'<i class="fa fa-times"></i><span>Full time live in</span>';?>
                            </li>
                            <li><?php echo in_array('1', $model->availability) ?
                                '<i class="fa fa-check"></i>Full time live out':'<i class="fa fa-times"></i><span>Full time live out</span>';?>
                            </li>
                            <li><?php echo in_array('2', $model->availability) ?
                                '<i class="fa fa-check"></i>Part time live out':'<i class="fa fa-times"></i><span>Part time live out</span>';?>
                            </li>
                            <li><?php echo in_array('3', $model->availability) ?
                                '<i class="fa fa-check"></i>Part time live in':'<i class="fa fa-times"></i><span>Part time live in</span>';?>
                            </li>
                            <li><?php echo in_array('4', $model->availability) ?
                                '<i class="fa fa-check"></i>Part Time Nanny':'<i class="fa fa-times"></i><span>Part Time Nanny</span>';?>
                            </li>
                            <li><?php echo in_array('5', $model->availability) ?
                                '<i class="fa fa-check"></i>Babysitting':'<i class="fa fa-times"></i><span>Babysitting</span>';?>
                            </li>
                            <li><?php echo in_array('6', $model->availability) ?
                                '<i class="fa fa-check"></i>Evenings':'<i class="fa fa-times"></i><span>Evenings</span>';?>
                            </li>
                            <li><?php echo in_array('7', $model->availability) ?
                                '<i class="fa fa-check"></i>Weekends Only':'<i class="fa fa-times"></i><span>Weekends Only</span>';?>
                            </li>
                            <li><?php echo in_array('8', $model->availability) ?
                                '<i class="fa fa-check"></i>Overnights':'<i class="fa fa-times"></i><span>Overnights</span>';?>
                            </li>
                            <li><?php echo in_array('9', $model->availability) ?
                                '<i class="fa fa-check"></i>I`m flexible':'<i class="fa fa-times"></i><span>I`m flexible</span>';?>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>What ages will you work with?</label>
                            <p><?= $model->ages_to_work_with?></p>
                        </div>
                        <div class="form-group">
                            <label>What ages do you have the most experience with?</label>
                            <p><?= $model->most_exp_with?></p>
                        </div>
                        <div class="form-group">
                            <label>Have you cared for twins or multiples?</label>
                            <p><?= $model->cared_of_twins?></p>
                        </div>
                        <div class="form-group">
                            <label>Do you have special needs experience?</label>
                            <p><?= $model->special_needs_exp?></p>
                        </div>
                        <div class="form-group">
                            <label>Would you tutor?</label>
                            <p><?= $model->tutor?></p>
                        </div>
                        <div class="form-group">
                            <label>Why do you want to be a nanny?</label>
                            <p><?= $model->why_want_be_nanny?></p>
                        </div>
                        <div class="form-group">
                            <label>What type of activities would you do with the children?</label>
                            <p><?= $model->type_of_activities?></p>
                        </div>
                        <div class="form-group">
                            <label>If you were a parent looking for a nanny, what characteristics would you look for?</label>
                            <p><?= $model->characteristics_look_for?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Do you have any background in child development? If so, how many units?</label>
                            <p><?= $model->background_in_child_dev?></p>
                        </div>
                        <div class="form-group">
                            <label>How many children will you care for?</label>
                            <p><?= $model->number_of_children_care_for?></p>
                        </div>
                        <div class="form-group">
                            <label>Would you care for sick children?</label>
                            <p><?= $model->sick_children?></p>
                        </div><div class="form-group">
                            <label>Will you assist children with homework?</label>
                            <p><?= $model->assist_homework?></p>
                        </div>
                        <div class="form-group">
                            <label>Briefly tell us about your family life?</label>
                            <p><?= $model->family_life?></p>
                        </div>
                        <div class="form-group">
                            <label>What are your interests?</label>
                            <p><?= $model->interests?></p>
                        </div>
                        <div class="form-group">
                            <label>What is your philosophy on discipline?</label>
                            <p><?= $model->philosophy?></p>
                        </div>
                        <div class="form-group">
                            <label>What is most important for a good relationship between a nanny and parents?</label>
                            <p><?= $model->most_important?></p>
                        </div>
                        <div class="form-group">
                            <label>Rate yourself on communication skills: (1-10)</label>
                            <p><?= $model->rate_communication_skills?></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-group candidate">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
                                Availability Schedule
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel-body table-responsive panel-collapse collapse" id="collapseFour" aria-expanded="true">
                    <div class="col-lg-12 col-md-12">
                    <table class="table table-bordered table-hover sign-table candidate-table">
                        <tbody><tr>
                            <td>Day</td>
                            <td>SUN</td>
                            <td>MON</td>
                            <td>TUE</td>
                            <td>WED</td>
                            <td>THU</td>
                            <td>FRI</td>
                            <td>SAT</td>
                        </tr>
                        <tr>
                            <td>Availability</td>
                            <td>
                                <?php echo ($model->sun!='') ?'<i class="fa fa-check"></i> '.$model->sun: ''?>
                            </td>
                            <td>
                                <?php echo ($model->mon!='') ?'<i class="fa fa-check"></i> '.$model->mon: ''?>
                            </td>
                            <td>
                                <?php echo ($model->tue!='') ?'<i class="fa fa-check"></i> '.$model->tue: ''?>
                            </td>
                            <td>
                                <?php echo ($model->wed!='') ?'<i class="fa fa-check"></i> '.$model->wed: ''?>
                            </td>
                            <td>
                                <?php echo ($model->thu!='') ?'<i class="fa fa-check"></i> '.$model->thu: ''?>
                            </td>
                            <td>
                                <?php echo ($model->fri!='') ?'<i class="fa fa-check"></i> '.$model->fri: ''?>
                            </td>
                            <td>
                                <?php echo ($model->sat!='') ?'<i class="fa fa-check"></i> '.$model->sat: ''?>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-group candidate">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo"  aria-expanded="true">
                                Housekeeping*
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel-body table-responsive panel-collapse collapse" id="collapseTwo" aria-expanded="true">
                    <div class="row">
                        <div class="col-md-12">
                                <ul class="panel-list">
                                <li><?php echo in_array('1', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Clean main living areas':'<i class="fa fa-times"></i><span>Clean main living areas</span>';?>
                                </li>
                                <li><?php echo in_array('2', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Clean bathrooms':'<i class="fa fa-times"></i><span>Clean bathrooms</span>';?>
                                </li>
                                <li><?php echo in_array('3', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Clean children`s rooms':'<i class="fa fa-times"></i><span>Clean children`s rooms</span>';?>
                                </li>
                                <li><?php echo in_array('4', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Vacuum':'<i class="fa fa-times"></i><span>Vacuum</span>';?>
                                </li>
                                <li><?php echo in_array('5', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Wipe down kitchen counters':'<i class="fa fa-times"></i><span>Wipe down kitchen counters</span>';?>
                                </li>
                                <li><?php echo in_array('6', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Clean dishes/put dishes away':'<i class="fa fa-times"></i><span>Clean dishes/put dishes away</span>';?>
                                </li>
                                <li><?php echo in_array('7', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Mop floors':'<i class="fa fa-times"></i><span>Mop floors</span>';?>
                                </li>
                                <li><?php echo in_array('8', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>I am fine with heavy cleaning':'<i class="fa fa-times"></i><span>I am fine with heavy cleaning</span>';?>
                                </li>
                                <li><?php echo in_array('9', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>Light housekeeping only':'<i class="fa fa-times"></i><span>Light housekeeping only</span>';?>
                                </li>
                                <li><?php echo in_array('0', $model->houskeeping) ?
                                    '<i class="fa fa-check"></i>I will not do ANY housekeeping':'<i class="fa fa-times"></i><span>I will not do ANY housekeeping</span>';?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-6">
                            <br>
                            <div class="form-group">
                                <label>How many years experience?</label>
                                <p><?= $model->houskeep_years_exp?></p>
                            </div>
                            <div class="form-group">
                                <label>What is the largest house you have cleaned?</label>
                                <p><?= $model->largest_house?></p>
                            </div>
                            <div class="form-group">
                                <label>Will you perform laundry and ironing?</label>
                                <p><?php echo $model->laundry_and_ironing==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>What best describes your housekeeping standards?</label>
                                <?php echo in_array('1', $model->best_describes_housekeeping) ?
                                            '<i class="fa fa-check"></i>Extremely Thorough':'<i class="fa fa-times"></i><span>Extremely Thorough</span>';?>
                                <br>
                                <?php echo in_array('2', $model->best_describes_housekeeping) ?
                                        '<i class="fa fa-check"></i>Neat & Orderly':'<i class="fa fa-times"></i><span>Neat & Orderly</span>';?>
                                <br>
                                <?php echo in_array('3', $model->best_describes_housekeeping) ?
                                        '<i class="fa fa-check"></i>It`s Good, Not Great':'<i class="fa fa-times"></i><span>It`s Good, Not Great</span>';?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Rate yourself on communication skills: (1-10)</label>
                                <p><?= $model->housekeep_communication_skills?></p>
                            </div>
                            <div class="form-group">
                                <label>Rate yourself on organizational skills: (1-10)</label>
                                <p><?= $model->housekeep_organization_skills?></p>
                            </div>
                            <div class="form-group">
                                <label>What is your personal style of service? </label>
                                <?php
                                    if($model->personal_style_of_service==1){
                                                echo '<p><i class="fa fa-check"></i>Professional</p>';
                                    }
                                    if($model->personal_style_of_service==2){
                                                echo '<p><i class="fa fa-check"></i>Laid Back but professional</p>';
                                    }
                                    if($model->personal_style_of_service==3){
                                                echo '<p><i class="fa fa-check"></i>Part of Family</p>';
                                    } 
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Have you worked in a private household? How long?</label>
                                <p><?= $model->private_household?></p>
                            </div>
                            <div class="form-group">
                                <label>Are you willing to work at home with a child?</label>
                                <p><?php echo $model->work_at_home_with_child==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Are you willing to help the family with childcare when needed?</label>
                                <p><?php echo $model->help_with_childcare==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                            </div>
                            <div class="form-group">
                                <label>Describe the type of household duties you are NOT willing to perform:</label>
                                <p><?= $model->not_willing_housework?></p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4>*skiped if not a housecleaner</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-group candidate">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFive"  aria-expanded="true">
                                Driving
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel-body table-responsive panel-collapse collapse" id="collapseFive" aria-expanded="true">
                    <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Do you drive?</label>
                            <p><?php echo $model->drive==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                        </div>
                        <div class="form-group">
                            <label>Have a car?</label>
                            <p><?php echo $model->have_car==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                        </div>
                        <div class="form-group">
                            <label>Car make, model and year:</label>
                            <p><?= $model->car_model_year?></p>
                        </div>
                        <div class="form-group">
                            <label>State the driver's license was issued in:</label>
                            <p><?= $model->state_licence?></p>
                        </div>
                        <div class="form-group">
                            <label>Have car insurance?</label>
                            <p><?php echo $model->car_insurance==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                        </div>
                        <div class="form-group">
                            <label>What company?</label>
                            <p><?= $model->company_car_insurance?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Had any traffic citations (including DWI, DUI)?</label>
                            <p><?= $model->traffic_citations?></p>
                        </div>
                        <div class="form-group">
                            <label>What states have you lived in?</label>
                            <p><?= $model->states_lived_in?></p>
                        </div>
                        <div class="form-group">
                            <label>Do you have a license that is valid and not under suspension?</label>
                            <p><?php echo $model->valid_licence==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                        </div>
                        <div class="form-group">
                            <label>Will you use your car for work purposes?</label>
                            <p><?php echo $model->use_car_for_work==1 ? '<i class="fa fa-check"></i>Yes': '<i class="fa fa-times"></i>No' ?></p>
                        </div>
                        <div class="form-group">
                            <label>Have you had traffic citations in the last 5 years? If so, please list:</label>
                            <p><?= $model->traffic_citations_last5_yrs?></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-group candidate">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSix"  aria-expanded="true">
                                About <?= preg_split('/\s+/', $model->name)[0] ?> 
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel-body table-responsive panel-collapse collapse" id="collapseSix" aria-expanded="true">
                    <div class="row">
                        <div class="col-sm-6 col-sm-6">
                            <div class="form-group">
                                <label>What extra curricular activities/special skills or hobbies are you interested in?</label>
                                <p><?= $model->extra_activities?></p>
                            </div>
                            <div class="form-group">
                                <label>Describe the type of family you would like to work for:</label>
                                <p><?= $model->type_of_family?></p>
                            </div>
                            <div class="form-group">
                                <label>What are your short term goals?</label>
                                <p><?= $model->short_term_goals?></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            
                            <div class="form-group">
                                <label>Why do you think you are qualified for this position?</label>
                                <p><?= $model->why_qualified?></p>
                            </div>
                            <div class="form-group">
                                <label>What languages do you speak?</label>
                                <p><?= $model->languages?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php require_once('sidebar.php');?>
</div>
</div>
<div id="login-popup" class="white-popup mfp-with-anim mfp-hide">
   <a class="btn btn-inverse" href="/user/sign-in/login">Log In Please</a>
</div>
<div id="contact-nanny-popup" class="white-popup mfp-with-anim mfp-hide">
    <form action="/pay/parent/contact-nanny" method="post">
    <input type="hidden" name="user_id" value="<?=Yii::$app->user->id ?>" />
    <input type="hidden" name="nanny_id" value="<?=$model->id ?>" />
    <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
    <input type="submit" class="btn btn-inverse" style="max-width: 250px" value="Click to Proceed/Use Credit" />
    </form>
</div>
<div id="buy-credit-popup" class="white-popup mfp-with-anim mfp-hide">
    You don't have enough credits to contact this candidate. <br>Please increase your balance in your account dashboard or <a class="btn btn-inverse" href="/user/default/get-credits">Buy Credits Now</a>
</div>
                    