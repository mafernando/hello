<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\StatusAsset;
use kartik\file\FileInput;

StatusAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-form">
  <?php 
      $form = ActiveForm::begin([
          'options'=>['enctype'=>'multipart/form-data']]); // important         
           ?>    
    <div class="row">
      <div class="col-md-8">
      <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
      </div>
      <div class="col-md-4">
      <p>Remaining: <span id="counter2">0</span></p>
      </div>
    </div>
    <div class="row">
    <div class="clearfix col-md-12">
      
    <?=
        $form->field($model, 'permissions')->dropDownList($model->getPermissions(), 
                 ['prompt'=>Yii::t('app','- Choose Your Permissions -')]) ?>
               </div>
    </div>
    <div class="row">
      <?= $form->field($model, 'image')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
          ]);   ?>
  </div>
    <div class="row">
                 
    <div class="form-group">
 <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     </div>
   </div>

    <?php ActiveForm::end(); ?>

</div>
