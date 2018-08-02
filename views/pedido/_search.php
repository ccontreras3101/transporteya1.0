<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'origen') ?>

    <?= $form->field($model, 'destino') ?>

    <?= $form->field($model, 'tiempo') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'comentarios') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'coords_origen') ?>

    <?php // echo $form->field($model, 'coords_destino') ?>

    <?php // echo $form->field($model, 'cliente_id') ?>

    <?php // echo $form->field($model, 'comuna_origen_id') ?>

    <?php // echo $form->field($model, 'comuna_destino_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
