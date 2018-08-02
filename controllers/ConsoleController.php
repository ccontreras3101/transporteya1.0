<?php
 
namespace app\controllers;
 
use yii\console\Controller;
use yii\db\Query;
use yii;
use app\models\Pedido;


class ConsoleController extends Controller {
    public function actionTest() {
      echo "sirve";
    }
    
    public function actionDeshabilitar(){
      $pedidos = Pedido::find()->all();

      $fecha_actual = date("Y-m-d H:i:s");

      echo $fecha_actual . "\n\n";
 
      foreach ($pedidos as $pedido) {
      	echo $pedido->fecha_entrega . "\n";
        echo ( $pedido->fecha_entrega >= $fecha_actual ) ? "vigente" : "vencida";
      	echo "\n";

      	if ( $fecha_actual >= $pedido->fecha_entrega ) {
      		$pedido->status = 3;
      		$pedido->save();
      	}
      }
    }  
 
}

?>