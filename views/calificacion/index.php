<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use aryelds\sweetalert\SweetAlert;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CalificacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Calificaciones');
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
<div class="calificacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?= Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success']) ?>
    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'', 
            'value'=>function($model){
                    if($model->calificacion == 0){
                        return 'Buena';
                    }
                    if($model->calificacion == 1){
                        return 'Regular';
                    }
                    if($model->calificacion == 2){
                        return 'Malo';
                    }
                },
            'label'=>'Calificación',
            ],
            [
            'attribute'=>'',
            'value'=>'comentario',
            'label'=>'Comentarios',
            ],
            [
            'attribute'=>'',
            'value'=>'fecha',
            'label'=>'Fecha',
            ],
            [
            'attribute'=>'Empresa',
            'value'=> 'empresa.nombre',
            'label'=> 'Empresa',
            ], 
            [
            'attribute'=>'',
            'value'=> 'Cliente',
            'label'=> 'Cliente',
            ], 
            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
