<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Sample */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>    

    <?= $form->field($model, 'thought')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput()->label(Yii::t('app','Your email address')) ?>

    <?= $form->field($model, 'url')->textInput()->label(Yii::t('app','Your website')) ?>

    <?= $form->field($model, 'censorship')->textInput() ?>
    
    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
        // configure additional widget properties here
    ]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
