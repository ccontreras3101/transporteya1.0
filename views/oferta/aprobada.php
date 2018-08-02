<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = Yii::t('app', 'Oferta Aprobada');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oferta-aprobada">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('view', [
        'model' => $model,
    ]) ?>

</div>
