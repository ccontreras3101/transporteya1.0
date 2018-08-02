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
<?php if( Yii::$app->user->can('cliente') ) { ?>
    <div class="pedido-index-cliente">
<?php } ?>
<?php if( Yii::$app->user->can('empresa') ) { ?>
    <div class="pedido-index-empresa">
<?php } ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if( Yii::$app->user->can('cliente') ) { ?>
            <?= Html::a(Yii::t('app', 'Nuevo Pedido'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
        <!-- <?php if( Yii::$app->user->can('empresa') ) { ?>
            <?= Html::a(Yii::t('app', 'Crear Pedido'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?> -->
    </p>
    <?= ( \Yii::$app->user->can('cliente') ) ? (
        GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',


                    ['attribute'=>'id', 
                          'value'=> 'comunaPedido',
                          'label'=>'Pedido',  
                    ],
                    ['attribute'=>'fecha', 
                          'value'=> 'fecha',
                          'format'=>'raw',
                          'filter'=>DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'fecha',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-m-d',
                                ]
                            ]),
                    ],                   
                    [
                        'attribute'=>'status', 
                        'label' => 'Status',
                        'filter' => array( 0 => "Ofertado", 1 => "Contratado", 2 => "Entregado", 3 => "Vencido", 4 => "Concluido" ),
                        'value'=> function($model){
                            switch ($model->status) {
                                case 0:
                                    return 'Ofertado';
                                case 1:
                                    return 'Contratado';
                                case 2:
                                    return 'Entregado';
                                case 3:
                                    return 'Vencido';
                                case 4:
                                    return 'Concluido';
                                default:
                                    return '';
                            }
                        }
                    ],

                    ['attribute'=>'', 
                          'value'=> 'name',
                          'label'=>'Cliente', 
                          'contentOptions' => ['class' => 'grid-responsive'],
                          'headerOptions' => ['class' => 'grid-responsive'], 
                    ],
                   
                   [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {link} {delete}',
                        'buttons'=>[
                                    'view' => function ($url, $model) {
                                        //if( Yii::$app->user->can('cliente') ){
                                            return Html::a('<input type="button" class="btn btn_view btn-success" value="Ver" />',
                                            ['/pedido/view', 'id' => $model->id], 
                                            ['title' => Yii::t('yii', 'Ver')]);
                                       // }
                                    },
                                    'update' => function ($url, $model) {
                                        if( Yii::$app->user->can('cliente') && $model->status == 0 ){
                                            return Html::a('<input type="button" class="btn btn_view btn-success" value="Ofertas" />',
                                            ['/oferta/index', 'pedido_id'=>$model->id],
                                            [   'title' => Yii::t('yii', 'Ofertas')]);
                                        }  
                                    },
                                    'link' => function ($url, $model) {
                                        if( Yii::$app->user->can('empresa') ){
                                            return Html::a('<input type="button" class="btn btn_view btn-success" value="Ofertar" />',
                                            ['/oferta/create', 'cliente_id' => $model->cliente_id, 'pedido_id'=>$model->id],
                                            [    'title' => Yii::t('yii', 'Ofertar')]);
                                        }
                                    },
                                    'delete' => function ($url, $model) {
                                        if( Yii::$app->user->can('cliente') && $model->status != 0 && $model->status != 1 && $model->status != 4){
                                            return Html::a('<input type="button" class="btn btn_view btn-success" value="Calificar" />',
                                            ['/calificacion/create', 'pedido_id' => $model->id ],
                                            [    'title' => Yii::t('yii', 'calificar')]);
                                        }
                                    },

                            ]     
                        ],
                ],
            ])
        ) : (
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
                                    ['/oferta/create', 'cliente_id' => $model["cliente_id"], 'pedido_id'=>$model["id"], 'empresas_id'=>"", 'id'=> "" ],
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
        ) ?>
</div>

<div class="hidden">
    <input type="text" name="tipo" id="tipo" value="<?php  echo Yii::$app->user->identity->rol?>">
</div>
