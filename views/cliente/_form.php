<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use app\models\Comuna;
use kartik\file\FileInput;
?>
<style type="text/css">

.footer{
    display: none;
}
.navbar{
    background: #fff !important;
}
.breadcrumb{
    margin-left: -15px;
    margin-right: -15px;
    background: #93c572 !important;
    height: 50px;
}
.btn{
    margin-left: -15px;
    opacity: 1;
    background: #93c572 !important;
    border: #455d36 !important;
}
.navbar-brand{
        margin-left: 0px !important;
}
@media(max-width:767px) {
   .collapse, .navbar-collapse{
        display: block;
    }
    .breadcrumb{
    height: auto;
    }
  }
</style>
 <?= Html::csrfMetaTags() ?>
<div class="cliente-form">
    <?php $form = ActiveForm::begin([            
                'id' => 'nuevo-cliente-form',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
            <div class="row">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-xs-10">
                        <?= $form->field($model, 'rut')->textInput() ?>
                    </div>
                    
                    <div class="col-lg-1 col-md-1 col-xs-2">
                        <?= $form->field($model, 'rut_add')->textInput() ?>
                    </div>
            
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>

                <?php if( $model->tipo == 0 ) { ?>
                    <?php if ( $model->isNewRecord ) { ?>
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <?= $form->field($model, 'apellidop')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <?= $form->field($model, 'apellidom')->textInput(['maxlength' => true]) ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                </div>

                <?php if( $model->tipo == 0 ) { ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'foto_perfil')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'showPreview' => false,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false
                            ]
                        ]) ?>
                    </div>
                </div>
                <?php } ?>

                <?php if( $model->tipo == 1 ) { ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?= $form->field($model, 'foto_perfil')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showPreview' => false,
                                    'showCaption' => true,
                                    'showRemove' => true,
                                    'showUpload' => false
                                ]
                            ]) ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?= $form->field($model, 'roll_sii')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showPreview' => false,
                                    'showCaption' => true,
                                    'showRemove' => true,
                                    'showUpload' => false
                                ]
                            ]) ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'fono')->textInput(['maxlength' => 11]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'comuna_id')->dropDownList(ArrayHelper::map(Comuna::find()->orderBy(['nombre'=>SORT_ASC])->all(),'id', 'nombre'),['prompt'=>'seleccione la comuna']) ?>
                    </div>
                </div>
                <?php if ( $model->isNewRecord ) { ?>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                    </div>
                        <?= $form->field($model, 'tipo')->hiddenInput()->label(false); ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">

            
                <div class="terminos">
                    <span>
                        <h4>TÉRMINOS Y CONDICIONES PARA USUARIOS DE “TRANSPORTES YA”</h4>
                        <br>
                        Este documento describe los Términos y Condiciones Generales aplicables a los usuarios del sitio web “transportesya.cl”, propiedad de NEILS SpA, con domicilio en Ejercito Libertador 2, Ciudad Rio Bueno, Chile.
                        “transportesya.cl” es un proveedor de servicios en internet, que opera como un foro para que los clientes enviantes y transportistas intercambien información, presentando ofertas o solicitudes de servicios.
                        <br>
                        “transportesya.cl” se reserva el derecho a modificar unilateralmente las condiciones del presente acuerdo en cualquier momento sin previo aviso.
                        <br>
                        Las modificaciones a las condiciones serán obligatorias para los usuarios a contar de los 30 días después de su liberación en el sitio web.
                        <br>
                        Los usuarios de “transportesya.cl” son responsables de ingresar y revisar periódicamente las condiciones. El uso de este sitio web después de cualquier liberación de las modificaciones obligatorias constituirá la aceptación de las mismas por los usuarios.
                        <br><br>
                        <h5>Aceptación de Condiciones e información personal</h5>
                        <br><br>
                        Para utilizar “transportesya.cl” es obligatorio leer y aceptar estas condiciones, así como la Política de Privacidad que se encuentra en el siguiente link: Políticas de Privacidad para imprimir.
                        <br>
                        Toda la información proporcionada por el usuario será utilizada de acuerdo a la Política de Privacidad de “transportesya.cl”.
                        <br>
                        Al crear y utilizar su cuenta de usuario, la información personal proporcionada por el usuario de manera explicita quedará registrada.
                        <br>
                        “transportesya.cl” se reserva el derecho de modificar o eliminar tanto cuentas de usuarios como avisos publicados, así como bloquear los e-mails y teléfonos asociados.
                        <br>
                        “transportesya.cl” podrá recopilar información cuando el usuario utiliza nuestros servicios y sitios web, como las páginas que visita, la información técnica, y cuándo, dónde y cómo utiliza nuestros servicios. Procesamos ésta información y la usamos para mejorar y desarrollar los servicios que ofrecemos.
                        <br><br>
                        <h5>Renuncia de Responsabilidad</h5>
                        <br><br>
                        Los usuarios son los únicos responsables de sus avisos. “transportesya.cl” no asume ninguna responsabilidad por cualquier clase de bienes o servicios anunciados en su sitio web.
                        <br>
                        Los usuarios garantizan que sus avisos no violan ningún derecho de autor, derechos de propiedad intelectual u otros derechos de los demás. En caso de acción judicial o reclamación respecto a cualquier contenido, el usuario respectivo deberá tomar a su cargo y asegurar la exención de todo costo, daño o perjuicio en contra de “transportesya.cl”.
                        <br>
                        Los servicios prestados por “transportesya.cl” a través de su sitio web, no están sujetos a ninguna garantía o condición, expresa o implícita. El usuario reconoce y acepta que el uso de “transportesya.cl” está en su propio riesgo. “transportesya.cl” no es responsable de las transacciones realizadas por los usuarios a través de su página web.
                        <br>
                        Excepto por las garantías expresamente establecidas en este acuerdo, “transportesya.cl” no garantiza que los servicios serán continuos, ininterrumpidos, libres de errores, la calidad, la identidad o la fiabilidad de sus usuarios la exactitud de la información suministrada por los Usuarios.
                        <br>
                        Los usuarios son responsables de los términos y condiciones específicos de una transacción (por ejemplo, los precios, las garantías de venta, opciones de entrega y los pagos a los licitadores), y el pago y / o retención de cualquier impuesto asociado con el producto, ya sea local, nacional o internacional.
                        <br>
                        Condiciones vigentes a partir de noviembre de 2017.
                    </span>
                </div>
                <?= $form->field($model, 'reglas_condiciones')->checkbox() ?>
        </div>
            

        <div class="row">
            <div class=" col-lg-12 col-md-12 col-xs-12 form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Editar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
            </div>
        </div>
        
    <?php ActiveForm::end(); ?>
</div>
    
<?php 
    $this->registerJs('
            $(".navbar-fixed-top").css("position" , "unset");
            $(".navbar-fixed-bottom").css("position" , "unset");
            $(".wrap").css("margin-top" , "0");

            $( document ).ready(function() {

                
                if($("#cliente-reglas_condiciones").is(":checked")){
                    $(".terminos").prop( "disabled", false );
                    $(".btn-success").prop( "disabled", false );
                    $(".terminos").css("background-color","#fff");
                }else{
                     $(".terminos").prop( "disabled", true );
                    $(".btn-success").prop( "disabled", true );
                    $(".terminos").css("background-color","#d4cdcd");  
                }
                if($("#cliente2-reglas_condiciones").is(":checked")){
                    $(".terminos").prop( "disabled", false );
                    $(".btn-success").prop( "disabled", false );
                    $(".terminos").css("background-color","#fff");
                }else{
                     $(".terminos").prop( "disabled", true );
                    $(".btn-success").prop( "disabled", true );
                    $(".terminos").css("background-color","#d4cdcd");  
                }
              
                
            });
            
            $("#cliente-reglas_condiciones").change(function() {
                if($(this).is(":checked")) {
                    $(".terminos").prop( "disabled", false );
                    $(".btn-success").prop( "disabled", false );
                    $(".terminos").css("background-color","#fff");   
                }else{
                    $(".terminos").prop( "disabled", true );
                    $(".btn-success").prop( "disabled", true );
                    $(".terminos").css("background-color","#d4cdcd");   
                }
                  
            });

             $("#cliente2-reglas_condiciones").change(function() {
                if($(this).is(":checked")) {
                    $(".terminos").prop( "disabled", false );
                    $(".btn-success").prop( "disabled", false );
                    $(".terminos").css("background-color","#fff");   
                }else{
                    $(".terminos").prop( "disabled", true );
                    $(".btn-success").prop( "disabled", true );
                    $(".terminos").css("background-color","#d4cdcd");   
                } 
            });

            // Rut de empresas
            $("#cliente2-rut_add").val("k");
            $("#cliente2-rut_add").change(function() {
                $("#cliente2-rut_add").val("k");
            });

    $(".form-control").keydown(function(){
           // var x = event.keyCode;
            console.log("x");
    });
         

            ');
?>

    
