<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */


$this->title = 'Transporte Ya';
?>

<div class="site-index ">

    <div class="jumbotron">
      
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
              <p class="lead"><?= Yii::$app->formatter->asDate('2015-01-15', 'long')?> </p>
                <h3><?php echo \Yii::t('app', 'Bienvenido')?> a Transporte Ya</h3>
                <h6>Tu Empresa de Transporte </h6>
                <?= Html::img('@web'.Yii::$app->user->identity->imagenPerfil.'.png', ['class' => 'foto_mini_perfil']) ?>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <h5><?= Yii::$app->user->identity->fullname ?></h5>
            </div>
        </div>
    </div>

    <div class="body-content">
   <!-- Button trigger modal -->
    <?= Html::a('Modal',['site/modal_example']) ?>
    <!-- cliente -->
    <?php if( Yii::$app->user->can('cliente') ){ ?>

        <div class="container-fluid text-center bg-grey backindex">
          <h2></h2>
          <!--<h4>What we have created</h4>-->
            <div class="row text-center">
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <?php $img_new = Html::img('@web/image/nuevo_pedido.png', ['title' => 'Nuevo Pedido', 'class'=>'img_emp_index'], ['pedido/create'] ); ?>
                    <?= Html::a( $img_new,['pedido/create']) ?>
                    <h3>Nuevo Pedido</h3>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <?php $img_your = Html::img('@web/image/mis_pedidos.png', ['title' => 'Mis Pedidos', 'class'=>'img_emp_index'], ['pedido/create'] ); ?>
                    <?= Html::a( $img_your, ['pedido/index']) ?>
                    <h3>Mis Pedidos</h3>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <?php $img_update = Html::img('@web/image/actualiza_tus_datos.png', ['title' => 'Actualizar Datos', 'class'=>'img_emp_index'], ['pedido/create'] ); ?>
                    <?= Html::a( $img_update, ['cliente/update', 'id'=> Yii::$app->user->identity->id]) ?>
                    <h3>Actualiza tus datos</h3>
                  </div>
                </div>
            </div>
        </div>  
    <?php } ?>

    <!-- end cliente -->
    <!-- empresa-->
    <?php if( Yii::$app->user->can('empresa') ){ ?>
        <div class="container-fluid text-center bg-grey backindex">
          <h2></h2>
          <!--<h4>What we have created</h4>-->
            <div class="row text-center">
                <div class="col-sm-3">
                  <div class="thumbnail">
                    <?php $img_new = Html::img('@web/image/camion.png', ['title' => 'Nueva Carga', 'class'=>'img_emp_index'], ['pedido/index'] ); ?>
                    <?= Html::a( $img_new,['pedido/index']) ?>
                    <h4>Nuevas Cargas</h4>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="thumbnail">
                    <?php $img_new = Html::img('@web/image/mis_ofertas.png', ['title' => 'Mis Ofertas', 'class'=>'img_emp_index'], ['oferta/index'] ); ?>
                    <?= Html::a( $img_new,['oferta/indexfree']) ?>
                    <h4>Mis Ofertas</h4>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="thumbnail">
                    <?php $img_your = Html::img('@web/image/mis_cargas.png', ['title' => 'Mis Pedidos', 'class'=>'img_emp_index'], ['oferta/indexmiscargas'] ); ?>
                    <?= Html::a( $img_your, ['oferta/indexmiscargas']) ?>
                    <h4>Mis Cargas</h4>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="thumbnail">
                    <?php $img_update = Html::img('@web/image/actualiza_tus_datos.png', ['title' => 'Actualizar Datos', 'class'=>'img_emp_index'], ['cliente/update'] ); ?>
                    <?= Html::a( $img_update, ['cliente/update', 'id'=> Yii::$app->user->identity->id]) ?>
                    <h4>Actualiza Tus Datos</h4>
                  </div>
                </div>
            </div>
        </div>  
    <?php } ?>
    <!-- end empresa -->
    </div>
</div>
<?php
    $this->registerJs(' 
// $("._lang").on("change", function (e) {
//   // valor = $( "._lang option:selected" ).val();
//   // form = $("#form_lang").val(valor);
//   //   console.log(form);
//   $( "#form_lang" ).submit();
// });

$(".en").on("click", function (e) {
  $("#lang").val("en");
  $( "#form_lang" ).submit();
});

$(".es").on("click", function (e) {
  $("#lang").val("es");
  $( "#form_lang" ).submit();
});
$(".ru").on("click", function (e) {
  $("#lang").val("ru");
  $( "#form_lang" ).submit();
});

//  var Language = $("html").attr("lang");
// if (Language = "ru"){
// //   var input = document.getElementsByClassName("form-group");
// // input.setAttribute("lang", Language);
//  $("#demo2").css("font-family", "arabic");
//  console.log(navigator.language);
//  }

  // $(".form-control").bind("keyup", function(){
  // var x = event.keyCode;

  // console.log(x);
  //   });

// gridstack

$(function () {
    $(".grid-stack").gridstack();
});

    ')?> 
