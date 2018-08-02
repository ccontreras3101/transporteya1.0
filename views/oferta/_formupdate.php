<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
/* @var $this yii\web\View */
/* @var $model app\models\Oferta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oferta-form">
    <div class="row">
        <div class="col-lg-6  col-md-6  col-xs-6 ">
            <div class="col-lg-12 col-md-12 col-xs-12 update_oferta"><span style="font-weight: 700;">Cliente:  <?php echo $model->cliente->fullname ; ?></span></div>
            <div class="col-lg-12 col-md-12 col-xs-12 update_oferta"><span style="font-weight: 700;">Pedido N°:   <?php echo $model->pedido->id; ?></span></div>
            <div class="col-lg-12 col-md-12 col-xs-12 update_oferta"><span style="font-weight: 700;">Origen:  <?php echo $model->pedido->origen; ?></span></div>
            <div class="col-lg-12 col-md-12 col-xs-12 update_oferta"><span style="font-weight: 700;">Destino:  <?php echo $model->pedido->destino; ?></span></div>
        </div>
        
    <?php $form = ActiveForm::begin(); ?>
        
        <div class="col-lg-6  col-md-6  col-xs-6 ">
            <?= $form->field($model, 'comentarios')->textarea(['rows' => 5]) ?>

             <?= $form->field($model, 'oferta_serv')->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Ofertar') : Yii::t('app', 'Modificar Oferta'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success', 'id'=>'boton', 'name'=>'boton']) ?>
            </div>
        </div>
    
        <div class="hidden">
            <?= $form->field($model, 'cliente_id')->textInput() ?>
            <?= $form->field($model, 'pedido_id')->textInput() ?>
            <input type="text" name="empresas_id" id="empresas_id" value="<?php echo Yii::$app->user->identity->id; ?>">
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerJs('
            $("#oferta-cliente_nombre").prop("disabled", true);
            $("#oferta-pedido_datos").prop("disabled", true);
            $("#oferta-coordenadas_actuales").prop("disabled", true);
            $("#oferta-coordenadas_actuales")val("33°27′00″S 70°40′00″");
            
           
                
        ')
?>