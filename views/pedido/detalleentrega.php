<?php 

	use yii\helpers\Html;

	$this->title = Yii::t('app', "Detalle entrega pedido N° ". $model->id);
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedido'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= "Detalle entrega pedido N° ". $model->pedido->id ?></h1>
<br>
<ul class="list-group">
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Cliente</b></div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= $model->pedido->cliente->fullname ?></div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Fecha de Solicitud</b></div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= $model->pedido->fecha ?></div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Empresa de transporte</b></div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= $model->empresa->fullname ?></div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Fecha de Entrega</b></div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= $model->pedido->fecha_entrega ?></div>
		</div>
	</li>
	<?php if ( $model->calificacions ) { 
		foreach ($model->calificacions as $key => $calificacion) {
		?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Calificacion</b></div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<?php 
					if($calificacion->calificacion == 0){
					echo "Excelente";
					}elseif ($calificacion->calificacion == 1) {
					echo "Regular";
					} elseif ($calificacion->calificacion == 2) {
					echo "Malo";
					} 
					?>
					
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Comentario</b></div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= $calificacion->comentario ?></div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><b>Imprimir Certificado</b></div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= Html::a('Imprimir', ['/pedido/pdf', 'id' => $model->pedido_id], ['class'=>'btn btn_view btn-success', 'title'=>'Imprimir Certificado de entrega', 'target'=>'_blank']) ?></div>
			</div>
		</li>
	<?php }
		} else { ?>
		<?php if(Yii::$app->user->can('cliente')){ ?>
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">No posee calificación</div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?= Html::a('Calificar', ['/calificacion/create', 'pedido_id' => $model->pedido_id], ['class'=>'btn btn_view btn-success', 'title'=>'Calificar transporte']) ?></div>
				</div>
			</li>
		<?php }?>
	<?php } ?>
</ul>
