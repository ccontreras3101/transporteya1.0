<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */
/* @var $form yii\widgets\ActiveForm */
?>
    
<div class="aprobada-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6">
                <?= $form->field($model, 'cliente_nombre')->textInput() ?>
            
                <?= $form->field($model, 'pedido_datos')->textInput() ?>
            
                <?= $form->field($model, 'coordenadas_actuales')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-6">
                <?= $form->field($model, 'comentarios')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'oferta_serv')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Ofertar') : Yii::t('app', 'Modificar Oferta'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="hidden">
            <?= $form->field($model, 'cliente_id')->textInput() ?>
            <?= $form->field($model, 'pedido_id')->textInput() ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerJs('
            $("#oferta-cliente_nombre").prop("disabled", true);
            $("#oferta-pedido_datos").prop("disabled", true);
            $("#oferta-coordenadas_actuales").prop("disabled", true);
            $("#oferta-cliente_id").val(2);
        ')
?>