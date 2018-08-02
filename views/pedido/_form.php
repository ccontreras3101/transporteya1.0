<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
/*models*/
use app\models\Region;
use app\models\Comuna;
/*plugins*/
use kartik\datetime\DateTimePicker;
use kartik\depdrop\DepDrop;
/*end plugins*/

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">
    <?php $form = ActiveForm::begin(); ?>
       
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <?= $form->field($model, 'origen')->textInput() ?>
                <?= $form->field($model, 'region_origen')->dropDownList(ArrayHelper::map(Region::find()->orderBy(['nombre'=>SORT_ASC])->all(),'id', 'nombre'),['id'=>'reg-id','prompt'=>'seleccione la region de origen']) ?>
                <!--  $form->field($model, 'coords_origen')->textInput(['maxlength' => true]) ?> -->
                <div class="row">
                    <!-- pedido-coords_origen -->
                   <!--  <div class="col-lg-6 col-md-6  col-xs-12" >
                        <input id="btn-map-origen" type="button" class="btn  btn-success btn-view" value="COORDS Actuales" />
                    </div>
                    <div class="col-lg-6 col-md-6  col-xs-12">
                        <input id="btn-search-origen" type="button" class="btn  btn-success btn-view btn-view" value="Buscar..." />
                    </div> -->
                </div>
              
                <br>
                <?= $form->field($model, 'provincia_origen')->widget(DepDrop::classname(), [
                                                                                     'options' => ['id'=>'provincia_id','prompt'=>'seleccione la provincia de origen'],
                                                                                     'pluginOptions'=>[
                                                                                         'depends'=>['reg-id'],
                                                                                         'placeholder' => 'Provincia',
                                                                                         'url' => Url::to(['/pedido/provincia'])
                                                                                     ]
                                                                                 ]); 
                ?>
                <?= 
                    $form->field($model, 'comuna_origen_id')->widget(DepDrop::classname(), [
                                                                                    'options' => ['id'=>'comuna_origen_id','prompt'=>'seleccione la comuna de origen'],
                                                                                    'pluginOptions'=>[
                                                                                        'depends'=>['reg-id', 'provincia_id'],
                                                                                        'placeholder'=>'Comuna',
                                                                                        'url'=>Url::to(['/pedido/comuna'])
                                                                                    ]
                                                                                ]);
                ?>
                
                <?php $var = [ 1 => '24 Hrs', 2 => '48 Hrs']; ?>
                <?= $form->field($model, 'tiempo')->dropDownList($var, ['prompt' => 'Seleccione' ]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <?= $form->field($model, 'destino')->textInput() ?>
                <?= $form->field($model, 'region_destino')->dropDownList(ArrayHelper::map(Region::find()->orderBy(['nombre'=>SORT_ASC])->all(),'id', 'nombre'),['id'=>'reg_destino_id','prompt'=>'seleccione la region de destino']) ?>
                <!--  $form->field($model, 'coords_destino')->textInput(['maxlength' => true]) ?> -->
                <div class="row">
                    <!-- pedido-coords_destino -->
                    <!-- <div class="col-lg-6 col-md-6  col-xs-12" >
                        <input id="btn-map-destino" type="button" class="btn  btn-success btn-view" value="COORDS Actuales" />
                    </div>
                    <div class="col-lg-6 col-md-6  col-xs-12">
                        <input id="btn-search-destino" type="button" class="btn  btn-success btn-view" value="Buscar..." />
                    </div> -->
                </div>
                <br>
                <?= $form->field($model, 'provincia_destino')->widget(DepDrop::classname(), [
                                                                                     'options' => ['id'=>'provincia_destino_id','prompt'=>'seleccione la provincia de Destino'],
                                                                                     'pluginOptions'=>[
                                                                                         'depends'=>['reg_destino_id'],
                                                                                         'placeholder' => 'Provincia',
                                                                                         'url' => Url::to(['/pedido/provinciadestino'])
                                                                                     ]
                                                                                 ]); 
                ?>
                <?= $form->field($model,'comuna_destino_id')->widget(DepDrop::classname(), [
                                                                                    'options' => ['id'=>'comuna_destino_id','prompt'=>'seleccione la comuna de destino'],
                                                                                    'pluginOptions'=>[
                                                                                        'depends'=>['reg_destino_id', 'provincia_destino_id'],
                                                                                        'placeholder'=>'Comuna',
                                                                                        'url'=>Url::to(['/pedido/comunadestino'])
                                                                                    ]
                                                                                ]);
                ?>
                
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <?= $form->field($model, 'comentarios')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Ingresar') : Yii::t('app', 'Editar'), ['class' => $model->isNewRecord ? 'btn btn-success btn-view' : 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="comuna_start_id" id="comuna_start_id">
        <input type="hidden" name="comuna_end_id" id="comuna_end_id">
        <input type="hidden" name="fecha" id="fecha">
        <input type="hidden" name="status" id="status" value="0">
        <input type="hidden" name="tiempo" id="tiempo" value="0">
        <input type="hidden" name="bandera" id="bandera" value="origen">
    <?php ActiveForm::end(); ?>

</div>

<!-- Modal -->
<div id="map-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Seleccionar Origen</h4>
      </div>
      <div class="modal-body">
        <div id="map-canvas"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>


</div>
<script>
  var map;
  function initMap() {
    jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k", function(success) {
        apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
    })
    .fail(function(err) {
        alert("API Geolocation error!");
    }); 

    var apiGeolocationSuccess = function(position) {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: position.coords.latitude, lng: position.coords.longitude},
          zoom: 13,
           mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        google.maps.event.addListener(map, 'bounds_changed', function() {
            var lat1 = Number(position.coords.latitude) - 20;
            var lat2 = Number(position.coords.latitude) + 20;
            var lng1 = Number(position.coords.longitude) - 15;
            var lng2 = Number(position.coords.longitude) + 15;  

            var rectangle = new google.maps.Polygon({
                paths : [
                    new google.maps.LatLng(lat1, lng1),
                    new google.maps.LatLng(lat2, lng1),
                    new google.maps.LatLng(lat2, lng2),
                    new google.maps.LatLng(lat1, lng2)
                ],
                strokeOpacity: 0,
                fillOpacity : 0,
                map : map
            });
            google.maps.event.addListener(rectangle, 'click', function(args) {  

                switch ( $("#bandera").val() ) {
                    case "origen":
                        $("#pedido-coords_origen").val(args.latLng.lat()+"/"+args.latLng.lng());
                        $("#map-modal").modal("hide");
                        break;
                    case "destino":
                        $("#pedido-coords_destino").val(args.latLng.lat()+"/"+args.latLng.lng());
                        $("#map-modal").modal("hide");
                        break;
                    default:
                        $("#map-modal").modal("hide");
                        break;
                }

            });
        });

    }; 
  }
</script>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k&callback=initMap"> </script>
<?php 

    $this->registerJs('
            $("#btn-search-origen").click(function() {
                $("#bandera").val("origen");
                $("#map-modal").modal("show");
            });            
            $("#btn-search-destino").click(function() {
                $("#bandera").val("destino");
                $("#map-modal").modal("show");
            });

            $("#btn-map-origen").click( function(e) {
                jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k", function(success) {
                    apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
                })
                .fail(function(err) {
                    alert("API Geolocation error!");
                }); 

                var apiGeolocationSuccess = function(position) {
                    console.log("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
                    $("#pedido-coords_origen").val(position.coords.latitude+"/"+position.coords.longitude);
                };      
            });


            $("#btn-map-destino").click( function(e) {
                jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k", function(success) {
                    apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
                })
                .fail(function(err) {
                    alert("API Geolocation error!");
                }); 

                var apiGeolocationSuccess = function(position) {
                    console.log("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
                    $("#pedido-coords_destino").val(position.coords.latitude+"/"+position.coords.longitude);
                };      
            });

            $("#comuna_origen_id").change(function() {
                var comuna_origen = $("#comuna_origen_id option:selected").val();
                $("#comuna_start_id").val(comuna_origen);
            });
            
            $("#comuna_destino_id").change(function() {
                var comuna_destino = $("#comuna_destino_id option:selected").val();
                $("#comuna_end_id").val(comuna_destino);
            });

            var fullDate = new Date();
            var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : (fullDate.getMonth()+1);
            var currentDate = fullDate.getFullYear()  + "-" + twoDigitMonth + "-" + fullDate.getDate();
            $("#fecha").val(currentDate);
            
            $("#pedido-tiempo").change(function(){
                
                tiempo = $("#pedido-tiempo option:selected").val();
                var fecha = new Date(),
                dia = fecha.getDate(),
                mes = fecha.getMonth() + 1,
                anio = fecha.getFullYear(),
                addTime = parseInt(tiempo) * 86400; //Tiempo en segundos
                fecha.setSeconds(addTime); //Añado el tiempo
                    var final =  fecha.getFullYear()+ "/" +(fecha.getMonth() + 1) + "/" + fecha.getDate() + " " + fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
                        $("#tiempo").val(final);     
            
            });

$(".en").on("click", function (e) {
  $("#lang").val("en");
  $( "#form_lang" ).submit();
});

$(".es").on("click", function (e) {
  $("#lang").val("es");
  $( "#form_lang" ).submit();
});

 var Language = $("html").attr("lang");
 if Language = "es";
 $(".form-control").css("background-color", "yellow");

$(function () {
    $(".grid-stack").gridstack();
});


')



?>