<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OfertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mis Cargas Aprobadas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oferta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p><?php if( Yii::$app->user->can('empresa') ){ ?>
        <?= Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pedido_id',
            'pedido.origen',
            'pedido.destino',
            ['attribute'=>'', 
                  'value'=> 'pedido.fecha',
                  'label'=>'F / Publicación',  
            ],
            ['attribute'=>'', 
                  'value'=> 'pedido.tiempo',
                  'label'=>'F / Vencimiento',  
            ],
            ['attribute'=>'oferta_serv', 
                  'value'=> 'oferta_serv',
                  'label'=>'Valor $',  
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {link}',
                'buttons'=>[
                    'view' => function ($url, $model) {     
                        return Html::a('<span class="btn_ver" >Registrar Entrega</span>',['/pedido/entrega', 'id' => $model->pedido_id], [
                                /*'title' => Yii::t('yii', 'Ver'),*/
                        ]);  
                    },

                    // 'link' => function ($url, $model) {     
                    //         return Html::a('<span class="btn_ofertar" >Ofertar</span>',
                    //             ['/oferta/create', 'cliente_id' => $model->cliente_id, 'id'=>$model->id],
                    //             [ /*   'title' => Yii::t('yii', 'Ofertar'),*/]
                    //         );  
                    //     }

                    ]     
                ],
        ],
            
    ]); ?>
<?php Pjax::end(); ?></div>
<?php 
    $this->registerJs('
        $(".not-set").css("display","none");

        ')

?>


