<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'Oferta N°',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="oferta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
