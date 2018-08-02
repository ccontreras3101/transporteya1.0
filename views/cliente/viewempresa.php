<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = $model->nombre.",".$model->apellidop." ".$model->apellidom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a(Yii::t('app', 'Volver'), ['pedido/index'], ['class' => 'btn btn-success']) ?>
    <p><?php if( Yii::$app->user->can('empresa') ){ ?>
        
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php  } ?>
        
    </p>


</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-6">
      <h3>Perfil de Empresa</h3>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-6 fullname_pedido_view">
           
      <h3> <?= Yii::$app->user->identity->fullname ?></h3>
    </div>    
  </div>
  <div class="row empresa_view">
   
      <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Empresa: </span><?php echo $model->nombre; ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Rut: </span><?php echo $model->rut."-".$model->rut_add; ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Dirección: </span><?php echo $model->direccion; ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Teléfono: </span><?php echo $model->fono; ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 div_pedido_view">
          <span class="txt_pedido_view"> Email: </span><?php echo $model->email; ?>
        </div>

      </div>
      <!-- -->
      <div class="col-lg-6 col-md-6 col-xs-12 perfil_empresa">
          <div class="col-lg-4 col-md-4 col-xs-4 midle font16px">
            <?php $img_new = Html::img('@web/image/bueno.png', ['title' => '', 'class'=>'img_perfil_empresa'], [''] ); ?>
            <?= Html::a( $img_new) ?>
            <?php echo $buenocant;  ?>
            <span>Bueno</span>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4 midle font16px">
            <?php $img_new = Html::img('@web/image/regular.png', ['title' => '', 'class'=>'img_perfil_empresa'], [''] ); ?>
            <?= Html::a( $img_new) ?>
            <?php echo $regularcant;  ?>
            <span>Neutro</span>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4 midle font16px">
            <?php $img_new = Html::img('@web/image/malo.png', ['title' => '', 'class'=>'img_perfil_empresa'], [''] ); ?>
            <?= Html::a( $img_new) ?>
            <?php echo $malocant;  ?>
            <span>Negativo</span>
          </div>
          <div class="col-lg-12 col-md-12 col-xs-12 midle">
            <h3><?php echo $recomendaciones?></h3>
          </div>
      </div>  
     
  </div>

  <div class="empresa-index">

  <table class="table table-striped">
    <theader>
      <tr>
        <th style="width: 10%"></th>
        <th  style="width: 60%">Comentario</th>
        <th style="width: 30%">Cliente</th>
      </tr>
    </theader>
    <tbody>
      <?php foreach ($calificaciones as $cal){ ?>
        <tr>
          <td style="width: 10%"><?= Html::img('@web/image/'.$cal->imagen, ['title' => '', 'class'=>'img_tabla_perfil'], [''] ); ?></td>
          <td  style="width: 60%"><?= $cal->comentario ?></td>
          <td style="width: 30%"><?= $cal->cliente ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>   
</div>