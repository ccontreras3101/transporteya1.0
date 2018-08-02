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
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <?= $form->field($model, 'cliente_nombre')->textInput(['class'=>'form-control disabled']) ?>
            
                <?= $form->field($model, 'pedido_datos')->textarea(['rows' =>5, 'class'=>'form-control disabled']) ?>
            
                <!-- <?= $form->field($model, 'coordenadas_actuales')->textInput(['maxlength' => true,'class'=>'form-control disabled']) ?> -->
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12">
                <?= $form->field($model, 'comentarios')->textarea(['rows' => 5]) ?>
            
                <?= $form->field($model, 'oferta_serv')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Ofertar') : Yii::t('app', 'Modificar Oferta'), ['class' => $model->isNewRecord ? 'btn btn-success btn-view' : 'btn btn-success btn-view', 'id'=>'boton', 'name'=>'boton']) ?>
                </div>
            </div>
        </div>
        <div class="hidden">
            <?= $form->field($model, 'cliente_id')->textInput() ?>
            <?= $form->field($model, 'pedido_id')->textInput() ?>
            <input type="text" name="empresas_id" id="empresas_id" value="<?php echo Yii::$app->user->identity->id; ?>">
        </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerJs('
            $(".disabled").attr( "disabled", true );
            $(".number").keyup(function (){
                this.value = (this.value + "").replace(/[^0-9]/g, "");
              });
           
                
        ')
?>