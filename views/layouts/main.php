<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/gridstack/dist/gridstack.css" />
        
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <div class="row">
        <div class=""></div>
    </div>
<?php $this->beginBody() ?>

<div class="wrap">
       
    <?php
     NavBar::begin([
        'brandLabel' => Html::img('@web/image/logo2.png', ['class'=>'', 'id'=>'']),
    //       'brandOptions' => ['class' => 'myclass'],//options of the brand
           'options' => ['class' => 'navbar navbar-fixed-top']//options of the navbar
     ]);
    /*menu clientes*/
    if( Yii::$app->user->can('cliente') ){
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right ', 'id'=>'cssmenu'],
            'items' => [
                ['label' => Yii::t('app', 'Inicio'), 'url' => ['/site/index']],
                ['label' => 'Conocenos', 'url' => ['/site/about']],
                ['label' => 'Contacto', 'url' => ['/site/contact']],
                ['label' => 'Pedidos ', 'items' => [
                    ['label' => 'Mis Pedidos', 'url' => ['/pedido/index']],
                    ['label' => 'Nuevo Pedido', 'url' => ['/pedido/create']],            
                    ['label' => 'Pedidos Finalizados', 'url' => ['/pedido/indexcargasentregadas']]            
                 ]],
                 ['label' => 'Ofertas', 'url' => ['/oferta/indexfree']],
                 ['label' => 'Idiomas ', 'items' => [
                    '<li>'
                    . Html::submitButton( 'English ',['class' => 'btn btn-link en'])
                    . '</li>'
                    .'<li>'
                    . Html::submitButton( 'Spanish ',['class' => 'btn btn-link es'])
                    . '</li>'  
                    .'<li>'
                    . Html::submitButton( 'Russian ',['class' => 'btn btn-link ru'])
                    . '</li>'             
                 ]],
                 ['label' => 'Gridstack', 'url' => ['/site/gridstack']],
                 // ['label' => 'Empresas Ofertantes', 'url' => ['/oferta/index']],
                //  ['label' => 'Calificación de Empresas ', 'url' => ['/calificacion/index']],
                  //['label' => 'calificar', 'url' => ['/calificacion/index']],
                  //['label' => 'usuarios', 'url' => ['/cliente/index']],
                //['label' => 'Empresas', 'url' => ['#']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->fullname . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
    }
    /*end menu clientes*/ 
    /*menu empresas*/
    if( Yii::$app->user->can('empresa') ){
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right' , 'id'=>'cssmenu'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Conocenos', 'url' => ['/site/about']],
                ['label' => 'Contacto', 'url' => ['/site/contact']],
                ['label' => 'Pedidos ', 'items' => [
                    ['label' => 'Pedidos', 'url' => ['/pedido/index']],
                    ['label' => 'Mis Pedidos', 'url' => ['/pedido/indexmispedidos']],
                    ['label' => 'Nuevo Pedido', 'url' => ['/pedido/create']],            
                    ['label' => 'Pedidos Finalizados', 'url' => ['/pedido/indexcargasentregadas']]            
                 ]],
                ['label' => 'Ofertas', 'url' => ['/oferta/indexfree']],
                ['label' => 'Mis Cargas', 'url' => ['oferta/indexmiscargas']],
                ['label' => 'Certificados', 'url' => ['/pedido/indexcargasentregadas']],
                
                  //['label' => 'calificar', 'url' => ['/calificacion/index']],
                  //['label' => 'usuarios', 'url' => ['/cliente/index']],
                //['label' => 'Empresas', 'url' => ['#']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->fullname . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
    }
    /*end menu empresas*/ 
    ?>

    <div class="container"> 
    <div class="languag">   
       <?php 
       // $form = ActiveForm::begin(['action' =>['/site/language'], 'id' => 'form_lang', 'method' => 'post',]);
       //      $languages = Yii::$app->params['languages'];
       //      echo  Html::dropDownList('lang', null, $languages, 
       //          ['prompt'=>'Select Option', 'class'=>'_lang form-control']
       //        );
       //  ActiveForm::end();
         $form = ActiveForm::begin(['action' =>['/site/language'], 'id' => 'form_lang', 'method' => 'post']);
          echo Html::hiddenInput('lang', '', ['id'=>'lang']);
        ActiveForm::end();
        
       ?> 
    </div>
        
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>

</div>

<footer class="footer">
   <!--  <div class="container"> -->

        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <?= Html::img('@web/image/logo2.png', ['class'=>'img_footer', 'id'=>'']) ?>
                <br>
                <br>
                    <a href="https://www.facebook.com">Facebook</a>
                    <a href="#"> - </a>
                    <a href="https://www.twitter.com">Twitter</a>

            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <?= Html::img('@web/image/visa.png', ['class'=>'img_pay', 'id'=>'']) ?>
                <?= Html::img('@web/image/mastercard.png', ['class'=>'img_pay', 'id'=>'']) ?>
                <?= Html::img('@web/image/paypal.png', ['class'=>'img_pay', 'id'=>'']) ?>
                <?= Html::img('@web/image/secure.png', ['class'=>'img_pay', 'id'=>'']) ?>
                <br>
                <br>
                <h5>Made in Chile · Copyright 2017 · All rights reserved.</h5>
            </div>
            
        </div>
    <!-- </div> -->
        
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!--loguin responsive -->
