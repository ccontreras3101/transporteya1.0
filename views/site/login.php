<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use aryelds\sweetalert\SweetAlert;
use yii\helpers\ArrayHelper;

$this->title = '';
?>
<style type="text/css">
  .footer{
    position: relative;
    bottom: -560px;
  }
  .navbar-fixed-top{
    position: unset;
    height: 450px !important;
  }
  .navbar-toggle, .navbar-brand{
    display: none;
  }
  .contact {
    margin-top: 150px;
  }
 .wrap{
  margin-top: 0px;
  margin-bottom: 0px;
 }
 .email_textarea{
  margin: 20px 0;

 }
  @media(max-width:767px) {
   .collapse, .navbar-collapse{
        display: block;
    }
  }
</style>
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
        ]); ?>
            <div class="row">
                <div class="col-lg-8  col-md-8  col-xs-12 fff center responsive-hide">
                  <div class="lorem-login">
                    
                    <h2>Quienes Somos</h2>
                    <h4>Transportesya.cl es una web de subastas de transporte a nivel nacional. Los clientes que necesitan realizar un transporte pueden hacer la publicación en nuestra página y recibir los diferentes precios de los transportistas que pujan por su carga. Al ser una publicación gratuita y sin compromiso, el cargador puede modificarla o eliminarla si finalmente no le interesa hacer el transporte.</h4>
                  </div>
                  </div>
              </div>
                
                <div class="col-lg-4  col-md-4  col-xs-12  login">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>    
                        <?= $form->field($model, 'password')->passwordInput() ?>                    
                        <?= $form->field($model, 'rememberMe')->checkbox(['id'=>'checkbox', 'name'=>'checkbox']) ?>                 
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 center">
                                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success ', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 center top">
                                <label>Registarse</label><br>
                                <?= Html::a(Yii::t('app', 'Cliente'), ['cliente/create','tipo'=>0],['class' => 'span ', 'data-toggle'=>'tooltip']) ?>
                                <?= Html::a(Yii::t('app', 'Empresa'), ['cliente/create','tipo'=>1],['class' => 'span']) ?>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        <?php ActiveForm::end(); ?>
    </div>

   
    <!-- Flash message-->
    <?php foreach (Yii::$app->session->getAllFlashes() as $message) {
        echo SweetAlert::widget([
            'options' => [
                'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
                'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
                'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
                'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
            ]
        ]);
    } ?>
     
    <!-- end flash message-->
<div class="row contact ">
    <div class="container-fluid bg-grey">
      <h2 class="text-center">CONTACTO</h2>
      <div class="row">
        <div class="col-sm-5">
          <p>Contáctanos y te responderemos en 24 horas.</p>
          <p><span class="glyphicon glyphicon-map-marker"></span> Rio Bueno, Chile</p>
          <p><span class="glyphicon glyphicon-envelope"></span> Contacto.tya@transporteya.cl</p> 
        </div>
        <div class="col-sm-7">
            <form method="post" action="email.php">
                    <div class="col-sm-6">
                      <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" required="true">
                    </div>
                    <div class="col-sm-6">
                      <input type="email" name="email" id="email" placeholder="Correo" class="form-control" required="true">
                    </div>
                    <div class="col-sm-12 email_textarea">     
                      <textarea rows="4" cols="3" name="body" id="body" class="form-control"  required="true"> </textarea>
                    </div>
                    <div class="col-sm-12">
                      <input type="submit" value="Enviar" class="btn btn-success">
                    </div>
          </form>
      </div>
    </div>
  </div>
</div>
<?php 
     $this->registerJs('

       $(document).ready(function(){
        $("#checkbox").tooltip({"trigger":"focus", "title": "Password tooltip"});
     });

        $("#LoginForm[tipo]").click(function(){
            console.log($(this).val());
        });
        
        
        
      ')

?>
      
      

