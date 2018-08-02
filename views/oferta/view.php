<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = "Desde:".$model->pedido->origen."- Hasta: ".$model->pedido->destino;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="oferta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if( Yii::$app->user->can('empresa') ){ ?>
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Mis Cargas'), ['indexmiscargas'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
        <?php if( Yii::$app->user->can('cliente') ){ ?>
        <?= Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'value'=>$model->cliente->nombre.",".$model->cliente->apellidop." ".$model->cliente->apellidom,
              'label'=>'Cliente',  
            ],
            'pedido_id',
            'oferta_serv',
            'comentarios',
            [
              'label'=>'Aprobada', 
              'attribute'=>'pedido',
              'filter'=>'id',
              'value'=> function($model)
                {   
                    if($model->aprobada == 0){
                        return 'En Proceso';
                    }
                    if($model->aprobada == 1){
                        return 'Aprobada';
                    }
                },
               
            ],
            
                       
            /*'id',
            'coordenadas_actuales',*/
        ],
    ]) ?>

</div>
