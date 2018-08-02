<?php
use yii\helpers\Html;
use kartik\mpdf\Pdf;
use app\models\Pedido;
use app\models\Comuna;
use app\models\Oferta;
use app\models\Cliente;



$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Certificado', 'url' => ['index']];


// http response
$response = Yii::$app->response;
$response->format = \yii\web\Response::FORMAT_RAW;
$headers = Yii::$app->response->headers;
$headers->add('Content-Type', 'application/pdf');
?>

<div class="certificado-form margin-table">
	
    <table >
    	<tr>
	        <td colspan="4" class="center-block">
	            <h1>Transporte Ya!</h1>
	            <h5>Certificado de Entrega</h5>
                <br>
	            <?= Html::img('@web/image/logo.jpg', ['title' => 'Logo', 'class'=>'logo'] ); ?>
    
	        </td>    
	    </tr>
        <tr><td class="white">q</td></tr>
        <tr>
            <td colspan="4" class="font justify"><h4>Se certifica que la empresa de transporte: 
                <span class="bold"><?= $model->empresa->nombre ?></span>,  Rut: <span class="bold"> <?= $model->empresa->rut."-".$model->empresa->rut_add ?></span>, que tiene oficina en:<span class="bold"> <?= $model->empresa->direccion ?></span> , Prestó servicio de Transporte a : <span class="bold"><?= $model->cliente->nombre ?></span> , Rut: <span class="bold"><?= $model->cliente->rut."-".$model->cliente->rut_add ?></span>, Para transladar mercancia desde: <span class="bold"><?= $model->origen ?></span>, hasta:<span class="bold"> <?= $model->destino ?></span>.</h4></td>
        </tr>
        <tr><td></td></tr>
       <tr><td class="white">q</td></tr>
        <tr >
            <td colspan="4"><h4>Siendo recibido satisactoriamente por el Cliente:</h4></td>
        </tr>
        <tr><td class="white">q</td></tr>
        <tr >
            <td colspan="2" class="center-block border">
                <h4 class="bold">Imagen de la carga entregada</h4><br>
                <?= $img_new = Html::img('@web/'.$model->imagen_carga_entregada,['class'=>'img_pdf']); ?>
            </td>

            <td colspan="2" class="center-block border">
                <h4 class="bold">Firma del Receptor</h4><br>
                <?= $img_new = Html::img('@web/'.$model->firma_cliente,['class'=>'firma_pdf']); ?>
            </td>
        
        </tr>
        <tr><td class="white">q</td></tr>
        <tr><td class="white">q</td></tr>
        <tr>
            <td colspan="2" class="center-block border_bottom"><h4>Firma:</h4></td>

            <td colspan="2" class="rigth"><?= Html::img('@web/image/logo_pdf.png', ['title' => 'Logo', 'class'=>''] ); ?>
            </td>
        </tr>

    </table>

</div>
