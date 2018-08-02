<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = Yii::t('app', 'Nueva Oferta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index', 'pedido_id'=>$model->pedido->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ( count($competencia) <= 0 ) { ?>
<div class="alert alert-info">
  <strong>Info!</strong> Ningúna empresa ha ofertado aún por este pedido.
</div>
<?php } else { ?>
<div class="row ofertas-competencia"> 
    <div>
        <h2>Ofertas de otras empresas para el pedido N° <?= $n_pedido ?></h2>
    </div>       
    <table class="table table-responsive table-striped table-ofertas">
        <thead>
            <tr>
                <th>#</th>
                <th>Empresa</th>
                <th>Dirección Inicio</th>
                <th>Dirección Destino</th>
                <th class="th-responsive">F/ Publicación</th>
                <th >F/ Vencimiento</th>
                <th class="th-responsive">Status</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competencia as $key => $oferta) { ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $oferta->empresa->fullname ?></td>
                <td><?= $oferta->pedido->origen ?></td>
                <td><?= $oferta->pedido->destino ?></td>
                <td class="td-responsive"><?= $oferta->pedido->fecha ?></td>
                <td ><?= $oferta->pedido->tiempo ?></td>
                <td class="td-responsive"><?= ($oferta->pedido->status == 0) ? 'Ofertado' : 'Contratado' ?></td>
                <td style="text-align: right;"><?= $oferta->oferta_serv . ' $' ?></td>
            </tr> 
            <?php } ?>     
        </tbody>
    </table>
</div>
<?php } ?>
<div class="oferta-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
