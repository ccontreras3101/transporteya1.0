<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use kartik\file\FileInput;
/*models*/
use app\models\Region;
use app\models\Comuna;
/*plugins*/
use kartik\datetime\DateTimePicker;
use kartik\depdrop\DepDrop;
/*end plugins*/

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Registrar Entrega";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mis Cargas Aprobadas'), 'url' => ['oferta/index_mis_cargas']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="entrega-form">
    
        <div class="row">
            <div class="col-lg-1 col-md-1 col-xs-3 div_entrega">
                <h5 class="entrega_title">N°</h5><span><?php echo  $model->id ?></span>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3 div_entrega">
                <h5 class="entrega_title"> Cliente</h5><span><?php echo $model->name ?></span>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-3 div_entrega">
                <h5 class="entrega_title">Rut</h5><span><?php echo $model->rut ?></span>
            </div> 
            <div class="col-lg-3 col-md-3 col-xs-3 div_entrega">
                <h5 class="entrega_title">Origen</h5><span><?php echo $model->origen ?></span>
            </div> 
            <div class="col-lg-3 col-md-3 col-xs-12 div_entrega">
                <h5 class="entrega_title">Destino </h5><span><?php echo $model->destino ?></span>
            </div>
                       
        </div>
    <?php $form = ActiveForm::begin([
            'id' => 'entrega-form',
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>
        <div class="row padding">
            <div class="col-lg-6 col-md-6 col-xs-12 div_entrega div_imagen">
                <h4>Imagen de entrega</h4>
                <?= $form->field($entrega, 'imagen')->widget(FileInput::classname(), [
                    'id' => 'file-image',
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'showPreview' => true,
                        'showCaption' => false,
                        'showRemove' => true,
                        'showUpload' => false
                    ]
                ])->label(false) ?>
            </div>
 
            <div class="col-lg-6 col-md-6 col-xs-12 div_entrega div_imagen">
                <h4>firma de cliente</h4> 
                <div id="signature-pad" class="signature-pad row">
                    <div class="signature-pad--body row">
                        <canvas></canvas>
                    </div>
                </div>
                <?= $form->field($entrega, 'firma')->hiddenInput(['id'=> 'canvasFirmaUrl'])->label(false) ?>
                <div class="row">
                    <button id="limpiar" name="limpiar" class="btn btn-danger">Limpiar</button>
                </div>      
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <?= Html::button(Yii::t('app', 'Ingresar'), ['class' =>  'btn btn-success btn-view', 'id'=>'guardar-entrega']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<?php 
    $this->registerJs('
        $(document).ready(function() {

            var wrapper = document.getElementById("signature-pad");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: "rgb(255, 255, 255)"
            });

            function resizeCanvas() {
                var ratio =  Math.max(window.devicePixelRatio || 1, 1);

                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);

                signaturePad.clear();
            }

            window.onresize = resizeCanvas;
            resizeCanvas();

            $("#limpiar").click(function(e){
                e.preventDefault();
                signaturePad.clear();
            });

            $("#guardar-entrega").click(function(e){
                e.preventDefault();
                
                if (signaturePad.isEmpty() || $("input[type=file]").val() === "") {
                    swal({
                        title: "Error!",
                        text: "Imagen y firma obligatorias!",
                        icon: "error",
                        button: "Entendido!",
                    });
                } else {
                    $("#canvasFirmaUrl").val(signaturePad.toDataURL("image/png"));
                    setTimeout(function(){
                        $("form#entrega-form").submit();
                    }, 500);
                }
            });
        });
    ')
?>