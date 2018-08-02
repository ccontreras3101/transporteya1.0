<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pedidos');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="pedido-index-empresa">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
            <?= Html::a(Yii::t('app', 'Crear Pedido'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' =>"Pedido N°",
                    'attribute' => 'id',
                    'contentOptions' => ['class' => 'grid-responsive'],
                    'headerOptions' => ['class' => 'grid-responsive'],
                    'value'=>function($data){
                        return $data["id"];
                    }
                ],
                [
                    'label' =>"Dir. Origen",
                    'attribute' => 'origen',
                    'value'=>function($data){
                        return $data["origen"];
                    }
                ],
                [
                    'label' =>"Dir. Destino",
                    'attribute' => 'destino',
                    'value'=>function($data){
                        return $data["destino"];
                    }
                ],
                [
                    'label' =>"F. Solicitud",
                    'attribute' => 'fecha',
                    'contentOptions' => ['class' => 'grid-responsive'],
                    'headerOptions' => ['class' => 'grid-responsive'],
                    'value'=>function($data){
                        return $data["fecha"];
                    }
                ],
                [
                    'label' =>"F. Estimada",
                    'attribute' => 'tiempo',
                    'value'=>function($data){
                        return $data["tiempo"];
                    }
                ],
                [
                    'label' =>"Estado",
                    'attribute' => 'status',
                    'value'=>function($data){
                        if($data["status"] == 0){
                            return 'Ofertado';
                        }
                        if($data["status"] == 1){
                            return 'Contratado';
                        }
                        if($data["status"] == 2){
                            return 'Entregado';
                        }
                        if($data["status"] == 3){
                            return 'Vencido';
                        }
                        if($data["status"] == 4){
                            return 'Concluido';
                        }
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {link} {delete}',
                        'buttons'=>[
                            'view' => function ($url, $model) {
                                //if( Yii::$app->user->can('cliente') ){
                                    return Html::a('<input type="button" class="btn btn_view btn-success" value="Ver" />',
                                    ['/pedido/view', 'id' => $model["id"]], 
                                    ['title' => Yii::t('yii', 'Ver')]);
                               // }
                            },
                            'update' => function ($url, $model) {
                                if( Yii::$app->user->can('cliente') && $model["status"] == 0 ){
                                    return Html::a('<input type="button" class="btn btn_view btn-success" value="Ofertas" />',
                                    ['/oferta/index', 'pedido_id'=>$model["id"]],
                                    [   'title' => Yii::t('yii', 'Ofertas')]);
                                }  
                            },
                            'link' => function ($url, $model) {
                                if( Yii::$app->user->can('empresa') && (Yii::$app->user->identity->id != $model["cliente_id"]) ){
                                    return Html::a('<input type="button" class="btn btn_view btn-success" value="Ofertar" />',
                                    ['/oferta/create', 'cliente_id' => $model["cliente_id"], 'pedido_id'=>$model["id"]],
                                    [    'title' => Yii::t('yii', 'Ofertar')]);
                                }
                            },
                            'delete' => function ($url, $model) {
                                if( Yii::$app->user->can('cliente') && $model["status"] != 0 && $model["status"] != 1 && $model["status"] != 4){
                                    return Html::a('<input type="button" class="btn btn_view btn-success" value="Calificar" />',
                                    ['/calificacion/create', 'pedido_id' => $model["id"] ],
                                    [    'title' => Yii::t('yii', 'calificar')]);
                                }
                            },

                        ] 
                ],
            ],
        ])
         ?>
</div>

<div class="hidden">
    <input type="text" name="tipo" id="tipo" value="<?php  echo Yii::$app->user->identity->rol?>">
</div>
