<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sample */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>    

    <?= $form->field($model, 'thought')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'goodness')->textInput() ?>

    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'censorship')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'occurred')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
