<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OfertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mis Cargas Aprobadas');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if( Yii::$app->user->can('cliente') ) { ?>
        <div class="oferta-index-cliente">
    <?php } ?>
    <?php if( Yii::$app->user->can('empresa') ) { ?>
        <div class="oferta-index-empresa">
    <?php } ?>

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p><?php if( Yii::$app->user->can('empresa') ){ ?>
        <?= Html::a(Yii::t('app', 'Inicio'), ['site/index'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pedido_id',
            [
                'attribute'=>'pedido.origen',
                'value'=>'pedido.origen',
                'label'=>'Pedido N°',
                'contentOptions' => ['class' => 'grid-responsive'],
                'headerOptions' => ['class' => 'grid-responsive'],
            ],
            [
                'attribute'=>'pedido.destino',
                'value'=>'pedido.destino',
                'label'=>'Pedido N°',
                'contentOptions' => ['class' => 'grid-responsive'],
                'headerOptions' => ['class' => 'grid-responsive'],
            ],
            ['attribute'=>'', 
                  'value'=> 'pedido.fecha',
                  'label'=>'F / Publicación',
                  'contentOptions' => ['class' => 'grid-responsive'],
                  'headerOptions' => ['class' => 'grid-responsive'],  
            ],
            ['attribute'=>'', 
                  'value'=> 'pedido.tiempo',
                  'label'=>'F / Vencimiento',
                  'contentOptions' => ['class' => 'grid-responsive'],
                  'headerOptions' => ['class' => 'grid-responsive'],  
            ],
            [
            'attribute'=>'', 
            'value'=>function($model){
                    if($model->pedido->status == 0){
                        return 'Ofertado';
                    }
                    if($model->pedido->status == 1){
                        return 'Contratado';
                    }
                    
                },
            'label'=>'Status',
            ],
            ['attribute'=>'oferta_serv', 
                  'value'=> 'oferta_serv',
                  'label'=>'Valor $',  
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {link} {posicion}',
                'buttons'=>[
                    'view' => function ($url, $model) {   
                        if( $model->pedido->status == 1 ){  
                            return Html::a('<input type="button" class="btn btn_view btn-success" value="Registrar Entrega" />',['/pedido/entrega', 'id' => $model->pedido_id], [
                                    /*'title' => Yii::t('yii', 'Ver'),*/
                            ]);
                        }
                    },

                    'link' => function ($url, $model) {     
                            return Html::a('<input type="button" class="btn btn_view btn-success" value="Ver" />',
                                ['/pedido/view', 'id' => $model->pedido->id],
                                [ 'title' => Yii::t('yii', 'Ver')]
                            );  
                        }
                    // 'posicion' => function ($url, $model) {
                    //     return '<div>
                    //                <input type="button" class="btn btn_view btn-success link latlngUpdate" value="Act. Posición" />
                                    
                    //                 <input type="hidden" value="'.$model->id.'"/>
                    //             </div>';
                    // }

                ]     
            ],
        ],
            
    ]); ?>
<?php Pjax::end(); ?></div>
<?php 
    $this->registerJs('

        $("body").on("click", ".latlngUpdate", function(e){

            e.preventDefault(); 
            var lat;
            var lng;
            var id = e.target.parentNode.children[1].value;

            $.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k").done(function(success) {
                apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
            }).fail(function(err) {
                alert("API Geolocation error!");
            }); 

            var apiGeolocationSuccess = function(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
    
                $.get("'.\Yii::$app->getUrlManager()->createUrl("pedido/coords").'", {
                    id: id,
                    lat: lat,
                    lng: lng
                }, function(data){
                    swal({
                      title: "Enhorabuena!",
                      text: "Coordenadas Actualizadas!",
                      icon: "success",
                      button: "Continuar!",
                    });
                }).fail(function(err){
                    console.log("err",err);
                });
            }; 

        });

    ')

?>


