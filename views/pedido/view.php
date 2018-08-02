<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = "Pedido N°:". $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <?php
    if( Yii::$app->user->can('cliente') )
      {
          echo Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->id], ['class' => 'btn btn-success ']);
             
    }
  ?>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-6">
      <h3>Búsqueda de Pedido</h3>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-6 fullname_pedido_view">
      <h3> <?= Yii::$app->user->identity->fullname ?></h3>
    </div>    
  </div>
  <div class="row pedido_view">
   
      <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Pédido N°: 00 </span><?= $model->id; ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Lugar de Origen: </span><?= $inicio ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Lugar de Destino: </span><?= $final ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Comentarios: </span><?= $model->comentarios ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Fecha Estimada de Entrega: </span><?= $model->tiempo ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Fecha de Entrega: </span><?= $model->fecha_entrega ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Envía: </span><?= $model->name ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Empresa: </span><?= $model->empresa->nombre ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Valor Pactado: </span><?= $model->valor->oferta_serv ?>

        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Estado: </span><?= $model->estado ?>
        </div>
      </div>
      <!-- -->
      <div class="col-lg-6 col-md-6 col-xs-12 relog">
          <?= Html::img('@web/image/clock.png'); ?>
    
          <input id="tiempo" name="tiempo" class=""><br>
          <input id="alert" name="alert" class="alert-pedido">
          
      </div>
      <?php if( Yii::$app->user->can('cliente') ){ ?>  
        <div class="col-lg-12 col-md-12 col-xs-12 col_btn_view">
        <?php if($model->status == 0){
          echo ( Html::a(Yii::t('app', 'Elige Tu Transporte'), ['oferta/vencida' ,'id'=>$model->ofertaId->id, 'pedido_id'=>$model->id], ['id'=> 'elige', 'name'=> 'elige','class' => 'btn btn-pedido-view']) );
        }
        ?>
          <?= Html::a(Yii::t('app', 'Perfil de Transporte'), ['cliente/viewempresa', 'empresa_id'=>$model->empresa->id], ['id'=> 'perfil', 'class' => 'btn btn-pedido-view']);  ?>
          
        </div>
      <?php } ?>
      <?php if( Yii::$app->user->can('empresa') ){ ?>
        <div class="col-lg-12 col-md-12 col-xs-12 col_btn_view">
          <?= Html::a(Yii::t('app', 'Mis Cargas'), ['oferta/indexmiscargas'], ['class' => 'btn btn-success btn-view']);  ?>
        </div>
      <?php } ?>
      <input class="hidden" id="clock" name="clock"  value="<?= $model->tiempo ?>"/ >
  </div>
</div>

<?php 
 $this->registerJs('
    $( document ).ready(function() {
      // $("#elige").attr( "disabled", "disabled" );
      // $("#perfil").attr( "disabled", "disabled" );
      $("#alert").css("display","none");
   });

    var countDownDate = new Date($("#clock").val()).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get todays date and time
      var now = new Date().getTime();

      // Find the distance between now an the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="tiempo"
      var time = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
      $("#tiempo").val(time);

      // If the count down is finished, write some text 
      if (distance < 0) {
        clearInterval(x);
        $("#elige").removeAttr("disabled");
        $("#perfil").removeAttr("disabled");
        // $("#ubicacion").attr( "disabled", "disabled" );
        $("#califica").attr( "disabled", "disabled" );
        $("#tiempo").val("00:00:00");
        // $("#alert").css("display","block");
        // $("#alert").val("Expiró el Tiempo, por favor realice un nuevo pedido");

      }
    }, 1000);

  ')

?>