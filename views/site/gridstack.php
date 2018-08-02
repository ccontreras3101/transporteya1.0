<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use kartik\file\FileInput;

use app\models\Region;
use app\models\Comuna;
/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('app', 'Gridstack');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
	<h1><?= Html::encode($this->title) ?></h1>
	<input type="text" name="">

<?php
	$this->registerJs('
		$(function () {
    var options = {
        cellHeight: 180,
        cellWidth : 200,
        verticalMargin: 10
    };
    $(".grid-stack").gridstack(options);
});
'); 

?>