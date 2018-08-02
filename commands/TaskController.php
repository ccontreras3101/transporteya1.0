<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Pedido;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TaskController extends Controller
{
    public function actionDeshabilitar(){
		$pedidos = Pedido::find()->all();

		$fecha_actual = date("Y-m-d H:i:s");

		foreach ($pedidos as $pedido) {
			if ( ($fecha_actual >= $pedido->tiempo) && !$pedido->ofertaAprobada ) {
                $pedido->status = 3;
				$pedido->save();
			}
		}
    } 
}
