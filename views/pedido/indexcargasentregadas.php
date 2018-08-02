<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entrega de Certificados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'',
                'value'=> 'id',
                'label'=>'N° de Pedido',
            ],
            [
                'attribute'=>'',
                'value'=> 'origen',
                'label'=>'Origen',
                'contentOptions' => ['class' => 'grid-responsive'],
                'headerOptions' => ['class' => 'grid-responsive'], 
            ],
            [
                'attribute'=>'',
                'value'=> 'destino',
                'label'=>'Destino',
                'contentOptions' => ['class' => 'grid-responsive'],
                'headerOptions' => ['class' => 'grid-responsive'], 
            ],
            [
                'attribute'=>'',
                'value'=> 'cliente.fullname',
                'label'=>'Cliente',
            ],
            [
                'attribute'=>'',
                'value'=> 'fecha_entrega',
                'label'=>'Fecha de Entrega',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{detalle} {print}',
                'buttons'=>[
                    'detalle' => function ($url, $model) {     
                        return Html::a('Ver Detalle',['/pedido/detalleentrega', 'id' => $model->id], [
                                'title' => Yii::t('yii', 'Ver Detalle'),
                                'class' => "btn btn_view btn-success"
                        ]);  
                    },
                    'print' => function ($url, $model) {     
                        return Html::a('Imprimir',['/pedido/pdf', 'id' => $model->id], [
                                'title' => Yii::t('yii', 'Imprimir Certificado de:'),
                                'class' => "btn btn_view btn-success imprimirCertificado",
                                'target'=>'_blank' 
                        ]);  
                    }
            
                ]     
            ],
            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<div class="hidden">
    <input type="text" name="tipo" id="tipo" value="<?php  echo Yii::$app->user->identity->rol?>">
</div>
