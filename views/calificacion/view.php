<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calificacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calificacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-6">
      <h3>Perfil de Empresa</h3>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-6 fullname_pedido_view">
           <?= Yii::$app->user->identity->imagenPerfil ?>
      <h3> <?= Yii::$app->user->identity->fullname ?></h3>
    </div>    
  </div>
  <div class="row empresa_view">
   
      <div class="col-lg-6 col-md-6 col-xs-6">
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Empresa: </span>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Rut: </span>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Dirección: </span>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Teléfono: </span>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Email: </span>
        </div>

      </div>
      <!-- -->
      <div class="col-lg-6 col-md-6 col-xs-6 perfil_empresa">
          <div class="col-lg-4 col-md-4 col-xs-4 midle font16px">
            <?php $img_new = Html::img('@web/image/bueno.png', ['title' => '', 'class'=>'img_perfil_empresa'], [''] ); ?>
            <?= Html::a( $img_new) ?>
           
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4 midle font16px">
            <?php $img_new = Html::img('@web/image/regular.png', ['title' => '', 'class'=>'img_perfil_empresa'], [''] ); ?>
            <?= Html::a( $img_new) ?>
            
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4 midle font16px">
            <?php $img_new = Html::img('@web/image/malo.png', ['title' => '', 'class'=>'img_perfil_empresa'], [''] ); ?>
            <?= Html::a( $img_new) ?>
            
          </div>
          <div class="col-lg-12 col-md-12 col-xs-12 midle">
            <h3>El  de sus clientes lo recomienda</h3>
          </div>
      </div>  
     
     
  </div>
<div class="calificacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'calificacion',
            'comentario:ntext',
            'fecha',
            'oferta_id',
        ],
    ]) ?>

</div>
