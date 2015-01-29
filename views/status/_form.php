<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->widget(\yii\redactor\widgets\Redactor::className(),
    [
       'clientOptions' => [
           'imageUpload' => \yii\helpers\Url::to(['/redactor/upload/image']),
       ],
    ]
      ) ?>

    <?=
        $form->field($model, 'permissions')->dropDownList($model->getPermissions(), 
                 ['prompt'=>Yii::t('app','- Choose Your Permissions -')]) ?>
                 
    <div class="form-group">
 <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     </div>

    <?php ActiveForm::end(); ?>

</div>
