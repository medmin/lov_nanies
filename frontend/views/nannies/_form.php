<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nannies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nannies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'unique_link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reg_date')->textInput() ?>

    <?= $form->field($model, 'password')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'biography')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_home')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_cell')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aviliable_for_interview')->textInput() ?>

    <?= $form->field($model, 'over_18')->textInput() ?>

    <?= $form->field($model, 'date_of_birth')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'eligible_to_work')->textInput() ?>

    <?= $form->field($model, 'have_work_visa')->textInput() ?>

    <?= $form->field($model, 'personal_comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'position_for')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employed')->textInput() ?>

    <?= $form->field($model, 'may_contact_employer')->textInput() ?>

    <?= $form->field($model, 'when_can_start')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hours_per_week')->textInput() ?>

    <?= $form->field($model, 'hourly_rate')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'weekly_salary')->textInput() ?>

    <?= $form->field($model, 'wage_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'availability')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sun')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mon')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tue')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wed')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fri')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'schedule_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'level_of_school')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_of_school')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'college')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'college_location')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subjects_studied')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'spec_training')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'childcare_exp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ages_to_work_with')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'most_exp_with')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cared_of_twins')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'special_needs_exp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tutor')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'houskeeping')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'why_want_be_nanny')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type_of_activities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'characteristics_look_for')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'background_in_child_dev')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number_of_children_care_for')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sick_children')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assist_homework')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'family_life')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'interests')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'philosophy')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'most_important')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rate_communication_skills')->textInput() ?>

    <?= $form->field($model, 'houskeep_years_exp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'largest_house')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'laundry_and_ironing')->textInput() ?>

    <?= $form->field($model, 'best_describes_housekeeping')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'housekeep_communication_skills')->textInput() ?>

    <?= $form->field($model, 'housekeep_organization_skills')->textInput() ?>

    <?= $form->field($model, 'personal_style_of_service')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'private_household')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'work_at_home_with_child')->textInput() ?>

    <?= $form->field($model, 'help_with_childcare')->textInput() ?>

    <?= $form->field($model, 'not_willing_housework')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'crp_certified')->textInput() ?>

    <?= $form->field($model, 'first_aid_certified')->textInput() ?>

    <?= $form->field($model, 'need_crp_fa_renew')->textInput() ?>

    <?= $form->field($model, 'tb_test')->textInput() ?>

    <?= $form->field($model, 'pet_allergies')->textInput() ?>

    <?= $form->field($model, 'smoking')->textInput() ?>

    <?= $form->field($model, 'work_if_parent_smokes')->textInput() ?>

    <?= $form->field($model, 'travel_restrictions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'valid_passport')->textInput() ?>

    <?= $form->field($model, 'work_if_parent_at_home')->textInput() ?>

    <?= $form->field($model, 'miles_to_commute')->textInput() ?>

    <?= $form->field($model, 'child_of_your_own')->textInput() ?>

    <?= $form->field($model, 'dog_cat_at_home')->textInput() ?>

    <?= $form->field($model, 'swim')->textInput() ?>

    <?= $form->field($model, 'uniform_dress_code')->textInput() ?>

    <?= $form->field($model, 'crime')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'benefits')->textInput() ?>

    <?= $form->field($model, 'trawel_with_family')->textInput() ?>

    <?= $form->field($model, 'drive')->textInput() ?>

    <?= $form->field($model, 'have_car')->textInput() ?>

    <?= $form->field($model, 'state_licence')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'car_insurance')->textInput() ?>

    <?= $form->field($model, 'company_car_insurance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'traffic_citations')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'states_lived_in')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'valid_licence')->textInput() ?>

    <?= $form->field($model, 'use_car_for_work')->textInput() ?>

    <?= $form->field($model, 'traffic_citations_last5_yrs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'car_model_year')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'extra_activities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type_of_family')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_term_goals')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'why_qualified')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'languages')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'heared_about_us')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rate_candidate')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'trustline')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'back_checks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach12')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach13')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach22')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach23')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach32')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attach33')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
