<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <section class="form-section">
        <div class="form-row">
            <div class="form-col form-col-full">
                <div class="form-group">
                    <label><?php Yii::t('app', 'Area location on the map (add correct address)'); ?></label>
                    <div id="map-block">
                        <div id="map-area" class="h-100" style="min-height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlmf6a0-d66_PiyhgIYz5pOE0PjvO2c2o"></script>
