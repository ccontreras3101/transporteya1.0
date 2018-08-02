<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Calificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calificacion-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php  $list = [0 => 'Si tu experiencia es satisfactoria', 
    				1 => 'Si se preesenta algún problema o incoveniente con tu experiencia',
    				2 => 'Si tu experiencia fuen insatisfactoria'];
		   echo $form->field($model, 'calificacion')->radioList($list); ?>


   

    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Calificar') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
	$this->registerJs('
		var fullDate = new Date();
            var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
            var currentDate = fullDate.getFullYear()  + "-" + twoDigitMonth + "-" + fullDate.getDate();
            $("#calificacion-fecha").val(currentDate);
            $(".field-calificacion-fecha").css("display","none");
            //$(".field-calificacion-oferta_id").css("display","none");
	')
?>