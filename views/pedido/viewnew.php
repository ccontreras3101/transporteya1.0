<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\Comuna */

$this->title = "Pedido N°: ".$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <!-- Flash message-->
    <?php foreach (Yii::$app->session->getAllFlashes() as $message) {
        echo SweetAlert::widget([
            'options' => [
                'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
                'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
                'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
                'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
            ]
        ]);
    } ?>
     
    <!-- end flash message-->
<div class="pedido-viewnew">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
              'value'=>$inicio,
              'label'=>'Origen',  
            ],
            [
              'value'=>$final,
              'label'=>'Destino',  
            ],
            'tiempo',
            'fecha',
            'comentarios',
            [
            'attribute'=>'', 
            'value'=>function($model){
                    if($model->status == 0){
                        return 'Ofertado';
                    }
                    if($model->status == 1){
                        return 'Contratado';
                    }
                    if($model->status == 2){
                        return 'Entregado';
                    }
                    if($model->status == 3){
                        return 'Vencido';
                    }
                    if($model->status == 4){
                        return 'Concluido';
                    }
                },
            'label'=>'Status',
            ],
            //'coords_origen',
           // 'coords_destino',
            
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Mis Pedidos'), ['index'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
