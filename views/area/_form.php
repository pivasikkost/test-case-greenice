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

    <div class="form-group">
        <label>
            <?= Yii::t(
                    'app',
                    'Area location on the map (you can specify the coordinates by dragging the marker.)'
            ); ?>
        </label>
        <div id="map-block">
            <div id="map-area" class="h-100" style="min-height: 400px;"></div>
        </div>
    </div>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlmf6a0-d66_PiyhgIYz5pOE0PjvO2c2o"></script>
