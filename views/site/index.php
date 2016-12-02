<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="hotel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_id')->dropDownList($model->countries) ?>

    <?= $form->field($model, 'city_id')->dropDownList($model->cities) ?>

    <?= $form->field($model, 'hotel_id')->dropDownList($model->hotels) ?>

    <div class="form-group">
        <?= Html::submitButton('Confirm', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

