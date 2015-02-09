<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StatusLog */

$this->title = 'Create Status Log';
$this->params['breadcrumbs'][] = ['label' => 'Status Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
