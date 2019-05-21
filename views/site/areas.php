<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\AreasForm */
/* @var $areas array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-areas">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Please select an area.
    </p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'areas-form']); ?>

                <?= $form->field($model, 'address')->dropDownList($areas, ['prompt'=>'Select Area']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
