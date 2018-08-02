<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comuna */

$this->title = Yii::t('app', 'Create Comuna');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comunas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comuna-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
