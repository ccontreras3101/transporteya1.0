<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OfertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if( Yii::$app->user->can('cliente') ){ 
    $this->title = Yii::t('app', 'Elección de Transporte');
}
if( Yii::$app->user->can('empresa') ){ 
    $this->title = Yii::t('app', 'Ofertas Activas');
}
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php if( Yii::$app->user->can('cliente') ) { ?>
        <div class="oferta-index-cliente">
    <?php } ?>
    <?php if( Yii::$app->user->can('empresa') ) { ?>
        <div class="oferta-index-empresa">
    <?php } ?>

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
        
                [
                    'attribute'=> '',
                    'value'=>'pedido_id',
                    'label'=> 'Pedido N°',
                    
                ],
                [
                    'attribute'=> '',
                    'value'=>'pedido.origen',
                    'label'=> 'Origen',
                    'contentOptions' => ['class' => 'grid-responsive'],
                    'headerOptions' => ['class' => 'grid-responsive'],
                    
                ],
                [
                    'attribute'=> '',
                    'value'=>'pedido.destino',
                    'label'=> 'Destino',
                    'contentOptions' => ['class' => 'grid-responsive'],
                    'headerOptions' => ['class' => 'grid-responsive'],
                    
                ],
                
                ['attribute'=>'fecha', 
                      'value'=> 'pedido.fecha',
                      'contentOptions' => ['class' => 'grid-responsive'],
                      'headerOptions' => ['class' => 'grid-responsive'],
                      'label'=>'F / Publicación',  
                ],
                ['attribute'=>'', 
                      'value'=> 'pedido.tiempo',
                      'label'=>'F / Vencimiento',  
                ],
                ['attribute'=>'oferta_serv', 
                      'value'=> 'oferta_serv',
                      'label'=>'Valor $',
                      'contentOptions' => ['class' => 'grid-responsive'],
                      'headerOptions' => ['class' => 'grid-responsive'],
                ],
                [ 
                    'attribute' => \Yii::$app->user->can('cliente') ? 'Transporte' : 'Cliente', 
                    'format' => 'raw',
                     'value'=>function ($model) {
                        if( Yii::$app->user->can('cliente') ){
                           return Html::a($model->empresa->fullname,['/cliente/viewempresa', 'empresa_id' => $model->empresaid], [
                                    'title' => Yii::t('yii', 'Ver detalle Transporte')
                            ]);
                        } else {
                           return Html::a($model->cliente->fullname,['/cliente/view', 'id' => $model->cliente_id], [
                                    'title' => Yii::t('yii', 'Ver detalle Transporte')
                            ]);
                        }
                    },
                ],                
                [
                    'attribute'=>'', 
                    'contentOptions' => ['class' => 'grid-responsive'],
                    'headerOptions' => ['class' => 'grid-responsive'],
                    'value'=>function($model){
                        if($model->pedido->status == 0){
                            return 'Evaluando Ofertas';
                        }
                        if($model->pedido->status == 1){
                            return 'Contratado';
                        }
                        if($model->pedido->status == 2){
                            return 'Entregado';
                        }
                        if($model->pedido->status == 3){
                            return 'Vencido';
                        }
                        if($model->pedido->status == 4){
                            return 'Concluido';
                        }
                    },
                    'label'=>'Status Pedido',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{view} {link} {update} {delete} ',
                    'buttons'=>[
                    'view' => function ($url, $model) 
                        {
                        if( Yii::$app->user->can('cliente') )
                            {    
                                return Html::a('<input type="button" class="btn btn_view btn-success choise" value="Elegir" />',['/oferta/aprobada', 'id' => $model->id, 'empresas_id'=>$model->empresas_id, 'pedido_id'=>$model->pedido_id, 'cliente_id'=>Yii::$app->user->identity->id], [
                                        'title' => Yii::t('yii', 'Elegir Oferta de: '.$model->empresa->nombre),
                                ]);  
                            }
                        },
                        'link' => function ($url, $model) {
                            if( Yii::$app->user->can('empresa') && $model->pedido->status != 1 ){
                                return Html::a('<input type="button" class="btn btn_view btn-success " value="Ofertar" />',
                                ['/oferta/create', 'cliente_id' => $model->cliente_id, 'pedido_id'=>$model->pedido_id, 'empresas_id'=>Yii::$app->user->identity->id, 'id'=>$model->id],
                                [    'title' => Yii::t('yii', 'Ofertar')]);
                            }
                        },
                        'update' => function ($url, $model) {
                            if( Yii::$app->user->can('empresa') && $model->pedido->status != 1 ){
                                return Html::a('<input type="button" class="btn btn_view btn-success " value="Ver" />',
                                ['/pedido/view', 'id'=>$model->pedido_id],
                                [    'title' => Yii::t('yii', 'Ofertar')]);
                            }
                        },
                        'delete' => function ($url, $model) {
                            if( Yii::$app->user->can('cliente') && $model->pedido->status == 1){
                                return Html::a('<input type="button" class="btn btn_view btn-success" value="Calificar" />',
                                ['/calificacion/create'/*, 'pedido_id' => $model->id */],
                                [    'title' => Yii::t('yii', 'calificar')]);
                            }
                        },
                    ]     
                ],
            ],
        
        ]); ?>
    </div>

<?php 
    $this->registerJs('
        $(".not-set").css("display","none");

        ')

?>


