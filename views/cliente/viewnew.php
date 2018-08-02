<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comuna */

$this->title = "Cliente: ".$model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-viewnew">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'rutfull',
            'nombre',
            'apellidop',
            'apellidom',
            'direccion',
            'fono',
            'email',
            [
              'value'=>$model->comuna->nombre,
              'label'=>'Comuna',  
            ],
            [
              'label'=>'Tipo de Registro', 
              'attribute'=>'tipo',
              'filter'=>'id',
              'value'=> function($model)
                {   
                    if($model->tipo == 0){
                        return 'Cliente';
                    }
                    if($model->tipo == 1){
                        return 'Empresa';
                    }
                },
               
            ],
        ],
    ]) ?>

</div>
