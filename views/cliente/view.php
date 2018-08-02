<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = $model->nombre.",".$model->apellidop." ".$model->apellidom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>        
        <?=  Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success'])  ?>
    </p>

    <?= \Yii::$app->user->can('empresa') ? (
        DetailView::widget([
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
        ])
    ) : (
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'rutfull',
                'nombre',
                'apellidop',
                'apellidom',
                'direccion',
                'fono',
                'email:email',
                //'reglas_condiciones',
                'username',
                //'password',
                [
                  'value'=>$model->comuna->nombre,
                  'label'=>'Comuna',  
                ],
                //'activo',
                //'tipo',
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
        ]) 
    )

    ?>

</div>
