<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use app\models\Cliente;
use app\models\Pedido;
use app\models\Region;
use app\models\Provincia;
use app\models\Comuna;
use app\models\Oferta;
use app\models\Entrega;
use app\models\Ruta;
use app\models\RegionSearch;
use app\models\PedidoSearch;
use app\models\Pedidocargasentregadas;
use app\models\Pedidomispedidos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\MarkerOptions;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        exec("php " . \Yii::$app->basePath . "/yii task/deshabilitar");

        if ( \Yii::$app->user->can('cliente') ) {
            $searchModel = new PedidoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {

            $totalCount = Yii::$app->db->createCommand('SELECT COUNT(id) FROM pedido
                    WHERE (status = 0)
                    AND id NOT IN (
                    SELECT DISTINCT(p.id) FROM pedido as p LEFT JOIN oferta as o ON o.pedido_id = p.id WHERE o.empresas_id = :empresa AND o.aprobada = 0
                    )', [':empresa' => Yii::$app->user->identity->id])->queryScalar();

            $query = 'SELECT * FROM pedido
                    WHERE (status = 0)
                    AND id NOT IN (
                    SELECT DISTINCT(p.id) FROM pedido as p LEFT JOIN oferta as o ON o.pedido_id = p.id WHERE o.empresas_id = :empresa AND o.aprobada = 0
                    )';

            $dataProvider = new SqlDataProvider([
                'sql' => $query,
                'params' => [':empresa' => Yii::$app->user->identity->id],
                'totalCount' => $totalCount,
                //'sort' =>false, to remove the table header sorting
                'sort' => [
                    'attributes' => [
                        'id' => [
                            'asc' => ['id' => SORT_ASC],
                            'desc' => ['id' => SORT_DESC],
                            'default' => SORT_DESC,
                            'label' => 'Pedido N°',
                        ],                        
                        'origen' => [
                            'asc' => ['origen' => SORT_ASC],
                            'desc' => ['origen' => SORT_DESC],
                            'default' => SORT_DESC,
                            'label' => 'Dir. Origen',
                        ],
                        'destino' => [
                            'asc' => ['destino' => SORT_ASC],
                            'desc' => ['destino' => SORT_DESC],
                            'default' => SORT_DESC,
                            'label' => 'Dir. Destino',
                        ],
                        'fecha' => [
                            'asc' => ['F. Solicitud' => SORT_ASC],
                            'desc' => ['F. Solicitud' => SORT_DESC],
                            'default' => SORT_DESC,
                            'label' => 'Dir. Origen',
                        ],
                        'tiempo' => [
                            'asc' => ['tiempo' => SORT_ASC],
                            'desc' => ['tiempo' => SORT_DESC],
                            'default' => SORT_DESC,
                            'label' => 'F. Estimada',
                        ],
                        'status' => [
                            'asc' => ['status' => SORT_ASC],
                            'desc' => ['status' => SORT_DESC],
                            'default' => SORT_DESC,
                            'label' => 'Estado',
                        ],
                    ],
                ],
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            $searchModel = [];

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        exec("php " . \Yii::$app->basePath . "/yii task/deshabilitar");

        $pedido = Pedido::find()->where(['id'=>$id])->One();
        $comunaOrigen = Comuna::find()->where(['id'=>$pedido->comuna_origen_id])->One();
        $comunaDestino = Comuna::find()->where(['id'=>$pedido->comuna_destino_id])->One();
        $provinciaOrigen= Provincia::find()->where(['id'=>$comunaOrigen->provincia_id])->One();
        $provinciaDestino= Provincia::find()->where(['id'=>$comunaDestino->provincia_id])->One();
        $regionOrigen = Region::find()->where(['id'=>$provinciaOrigen->region_id])->One();
        $regionDestino = Region::find()->where(['id'=>$provinciaDestino->region_id])->One();
        $inicio = "La Region de: ". $regionOrigen->nombre.", en la Provincia de: ".$provinciaOrigen->nombre.", en la Comuna  ".$comunaOrigen->nombre." de la Dirección ". $pedido->origen;
        $final =  "La Region de: ".$regionDestino->nombre.", en la Provincia de:".$provinciaDestino->nombre.",  en la Comuna".$comunaDestino->nombre." en la Dirección ". $pedido->destino;
        
        $validate = Oferta::find()->select(['empresas_id'])
                                 ->where(['pedido_id'=>$id])
                                 ->andWhere(['aprobada'=>1])
                                 ->One();
       
       if (!empty($validate->empresas_id)) {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'inicio' => $inicio,
            'final' => $final,
        ]);            
       }else{
        return $this->redirect(['viewofertado', 'id' => $id]);
       }
       
    }
    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewofertado($id)
    {
       exec("php " . \Yii::$app->basePath . "/yii task/deshabilitar");

       $pedido = Pedido::find()->where(['id'=>$id])->One();
        $comunaOrigen = Comuna::find()->where(['id'=>$pedido->comuna_origen_id])->One();
        $comunaDestino = Comuna::find()->where(['id'=>$pedido->comuna_destino_id])->One();
        $provinciaOrigen= Provincia::find()->where(['id'=>$comunaOrigen->provincia_id])->One();
        $provinciaDestino= Provincia::find()->where(['id'=>$comunaDestino->provincia_id])->One();
        $regionOrigen = Region::find()->where(['id'=>$provinciaOrigen->region_id])->One();
        $regionDestino = Region::find()->where(['id'=>$provinciaDestino->region_id])->One();
        $inicio = "La Region de: ". $regionOrigen->nombre.", en la Provincia de: ".$provinciaOrigen->nombre.", en la Comuna  ".$comunaOrigen->nombre." de la Dirección ". $pedido->origen;
        $final =  "La Region de: ".$regionDestino->nombre.", en la Provincia de:".$provinciaDestino->nombre.",  en la Comuna".$comunaDestino->nombre." en la Dirección ". $pedido->destino;

        return $this->render('viewofertado', [
            'model' => $this->findModel($id),
            'inicio' => $inicio,
            'final' => $final,
        ]);            
       
       
    }
    /**
     * Displays a single Calificacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewnew($id)
    {
        $pedido = Pedido::find()->where(['id'=>$id])->One();
        $comunaOrigen = Comuna::find()->where(['id'=>$pedido->comuna_origen_id])->One();
        $comunaDestino = Comuna::find()->where(['id'=>$pedido->comuna_destino_id])->One();
        $provinciaOrigen= Provincia::find()->where(['id'=>$comunaOrigen->provincia_id])->One();
        $provinciaDestino= Provincia::find()->where(['id'=>$comunaDestino->provincia_id])->One();
        $regionOrigen = Region::find()->where(['id'=>$provinciaOrigen->region_id])->One();
        $regionDestino = Region::find()->where(['id'=>$provinciaDestino->region_id])->One();
        $inicio = "La Region de: ". $regionOrigen->nombre.", en la Provincia de: ".$provinciaOrigen->nombre.", en la Comuna  ".$comunaOrigen->nombre." de la Dirección ". $pedido->origen;
        $final =  "La Region de: ".$regionDestino->nombre.", en la Provincia de:".$provinciaDestino->nombre.",  en la Comuna".$comunaDestino->nombre." en la Dirección ". $pedido->destino;
        
        return $this->render('viewnew', [
            'model' => $this->findModel($id),
            'inicio' => $inicio,
            'final' => $final,
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
   
        $model = new Pedido();
        // $map = $this->setMap();

        if($model->load(Yii::$app->request->post())){

            $pedido = new Pedido();
            $pedido->cliente_id = Yii::$app->user->identity->id ;
            $pedido->origen = $_POST['Pedido']['origen'];
            $pedido->destino = $_POST['Pedido']['destino'];
            $pedido->tiempo = $_POST['tiempo'];
            $pedido->fecha = $_POST['fecha'];
            $pedido->comentarios = $_POST['Pedido']['comentarios'];
            $pedido->status = 0;
            //$pedido->coords_origen = $_POST['Pedido']['coords_origen'];
            //$pedido->coords_destino = $_POST['Pedido']['coords_destino'];
            $pedido->comuna_origen_id = $_POST['comuna_start_id'];
            $pedido->comuna_destino_id = $_POST['comuna_end_id'];

            $pedido->save(false);
            //setflash
            Yii::$app->getSession()->setFlash('success', [
                'text' => 'Felicidades su pedido ha sido creado exitosamente',
                'title' => 'Nuevo Pedido',
                'type' => 'success',
                'timer' => 4000,
                'showConfirmButton' => false
            ]);
            // end set flash

            return $this->redirect(['viewnew', 'id' => $pedido->id]);
        }  else{
            return $this->render('create', [
                'model' => $model,
                // 'map' => $map,
            ]);
        }

        
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $pedido = Pedido::find()->where(['id'=>$id])->One();

        if ($model->load(Yii::$app->request->post())) {
            $pedido->origen = $model->origen;
            $pedido->destino = $model->destino;
            $pedido->comentarios = $model->comentarios;
            $pedido->status = 0;
            //$pedido->coords_origen = $model->coords_origen;
            //$pedido->coords_destino = $model->coords_destino;
            $pedido->comuna_origen_id = $model->comuna_origen_id;
            $pedido->comuna_destino_id = $model->comuna_destino_id;
                $pedido->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                
            ]);
        }
    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*enlazar select de regiones y comunas*/
    public function actionProvincia() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $reg_id = $parents[0];
                $out = Provincia::find()->select(['id','nombre as name'])->where(['region_id' => $reg_id])->asArray()->All();
                
                return json_encode(['output'=>$out, 'selected'=>'']);
                
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    /*enlace de provincias con comunas*/
    public function actionComuna() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if (!empty($parents)) {
                $reg_id = (!empty($parents[0])) ? $parents[0] : null;
                $provincia_id = (!empty($parents[1])) ? $parents[1] : null;
                if($reg_id !== null && $provincia_id !== null){
                    $out = Comuna::find()->select(['id','nombre as name'])->where(['provincia_id' => $provincia_id])->asArray()->All();
                    return json_encode(['output'=>$out, 'selected'=>'']);
                }
                
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }
    /*select provincia de destino*/
    public function actionProvinciadestino() {
        $out_ = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $reg_destino_id = $parents[0];
                $out_ = Provincia::find()->select(['id','nombre as name'])->where(['region_id' => $reg_destino_id])->asArray()->All();
                
                return json_encode(['output'=>$out_, 'selected'=>'']);
                
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }
    /*enlace de provincias con comunas de destino*/
    public function actionComunadestino() {
        $out_ = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if (!empty($parents)) {
                $reg_destino_id = (!empty($parents[0])) ? $parents[0] : null;
                $provincia_destino_id = (!empty($parents[1])) ? $parents[1] : null;
                if($reg_destino_id !== null && $provincia_destino_id !== null){
                    $out_ = Comuna::find()->select(['id','nombre as name'])->where(['provincia_id' => $provincia_destino_id])->asArray()->All();
                    return json_encode(['output'=>$out_, 'selected'=>'']);
                }
                
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }
    /*Registrar entrega*/
    public function actionEntrega($id)
    {
       $model = $this->findModel($id);
       $entrega = new Entrega;

        if ($entrega->load(Yii::$app->request->post())) {
            $imagen = $_FILES['Entrega'];

            $band = move_uploaded_file($_FILES["Entrega"]["tmp_name"]["imagen"], \Yii::getAlias('@app').'/web/imagenes_cargas/' . $_FILES["Entrega"]["name"]["imagen"]);

            $firma = $entrega->firma;
            $firma = str_replace('data:image/png;base64,', '', $firma);
            $firma = str_replace(' ', '+', $firma);
            $data = base64_decode($firma);
            $file = \Yii::getAlias('@app')."/web/firmas/Firma_" . $model->id . '.png';
            $band = $band && file_put_contents($file, $data);

            $model->fecha_entrega = date("Y-m-d H:i:s");
            $model->imagen_carga_entregada = '/imagenes_cargas/' . $_FILES["Entrega"]["name"]["imagen"];
            $model->firma_cliente = "/firmas/Firma_" . $model->id . '.png';
            $model->status = 2;

            $oferta = Oferta::find()->where(['pedido_id' => $id])->one();
            $oferta->aprobada = 2;

            $model->save(false);

            if ( strpos("/", $model->coords_destino) !== false ) {
                $ruta = new Ruta();
                $ruta->lat = explode("/", $model->coords_destino)[0];
                $ruta->lng = explode("/", $model->coords_destino)[1];
                $ruta->oferta_id = $model->ofertaId;
                $ruta->save();
            }


            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('entrega', [
                'model' => $model,
                'entrega' => $entrega
            ]);
        }
    }
    ///////////////////////////////
    public function actionIndexcargasentregadas()
    {
        $searchModel = new Pedidocargasentregadas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexcargasentregadas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    ///////////////////////////////////////
    public function actionDetalleentrega( $id )
    {
        $model = Oferta::find()->where(['pedido_id' => $id])->one();

        return $this->render('detalleentrega', [
            'model' => $model
        ]);
    }
    ///////////////////////////////
    public function actionIndexmispedidos()
    {
        $searchModel = new Pedidomispedidos();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexmispedidos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //////////////////////////////
    public function actionPdf($id) {
        // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($id);
        $content = $this->renderPartial('pdf', [
            'model' => $model,
        ]);
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_LETTER, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => 
            '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
            
            // any css to be embedded if required
            //'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Certificado Transporter Ya'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>[''], 
                'SetFooter'=>[''],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionCoords( $id, $lat, $lng ) {

        $oferta = Oferta::find()
                    ->where(['id' => $id])
                    ->andWhere(['aprobada' => 1])
                    ->one();

        $oferta->coordenadas_actuales = $lat . '/' . $lng;

        $ruta = new Ruta();
        $ruta->lat = $lat;
        $ruta->lng = $lng;
        $ruta->oferta_id = $id;

        //email
        $content = '<h1>NOTIFICACION DE TRANSPORTE YA</h1>';
        $content .= '<p>Nos complece informarle que su  envío se encuentra en este momento en las siguientes coordenadas:</p>'. $oferta->coordenadas_actuales.
        '<br /><a href="https://maps.googleapis.com/maps/api/staticmap?center='.$lat.','.$lng.'&zoom=12&size=400x400&key=AIzaSyCYQXqbWqTTom-RRV6hWGoyUXeAf5dbZ4k">Ver mapa</a><p> nos comunicaremos con Ud. tan pronto su pedido llegue a destino.</p> <br>
        <p>Muchas Gracias por preferirnos</p>';
        Yii::$app->mailer->compose("@app/mail/layouts/html", ["content" => $content])
               ->setTo($oferta->cliente->email)
               ->setFrom([ Yii::$app->params['adminEmail'] => $oferta->empresa->email ])
               ->setSubject('Ubicación de Pedido')
               ->send(); 
        //end email

        return $oferta->save(false) && $ruta->save();
    }

    public function actionVerubicacion( $id = '' ) {

        $pedido = Pedido::findOne( $id );
        $oferta = Oferta::find()
                    ->where(['pedido_id' => $id])
                    ->andWhere(['aprobada' => 1])
                    ->one();
        $rutas = Ruta::find()->where(['oferta_id' => $oferta->id])->all();


        if ( $oferta->coordenadas_actuales != '' ) {
            $lat_actual = explode('/',$oferta->coordenadas_actuales)[0];
            $lng_actual = explode('/',$oferta->coordenadas_actuales)[1];  
            $coord_actual = new LatLng(['lat' => $lat_actual, 'lng' => $lng_actual]);

            $map = new Map([
                'center' => $coord_actual,
                'zoom' => 12,
            ]);
        }

        if ( $pedido->coords_origen != '' ) {        
            $lat_origen = explode('/',$pedido->coords_origen)[0];
            $lng_origen = explode('/',$pedido->coords_origen)[1];
            $coord_origen = new LatLng(['lat' => $lat_origen, 'lng' => $lng_origen]);

            // Lets add a marker now
            $marker_origen = new Marker([
              'position' => $coord_origen,
              'title' => 'Origen',
            ]);

            $marker_origen->attachInfoWindow(
              new InfoWindow([
                  'content' => '<p>Origen</p>'
              ])
            );

            $options_origen = new MarkerOptions();
            $options_origen->clickable = false;
            $options_origen->visible = true;

            $marker_origen->setOptions( $options_origen );

            $map->addOverlay($marker_origen);  
        }      

        foreach ($rutas as $key => $coords) {
            $coord_actual = new LatLng(['lat' => $coords->lat, 'lng' => $coords->lng]);

            $marker_actual = new Marker([
                'position' => $coord_actual,
                'title' => 'Punto '. $key + 1,
            ]);

            $marker_actual->attachInfoWindow(
                new InfoWindow([
                    'content' => '<p>Punto '.($key + 1).'</p>'
                ])
            );

            $options_actual = new MarkerOptions();
            $options_actual->clickable = false;
            $options_actual->visible = true;

            $marker_actual->setOptions( $options_actual );
    
            // Add marker to the map
            $map->addOverlay($marker_actual);
        }

        if ( $pedido->coords_destino != '' ) {   
            $lat_destino = explode('/',$pedido->coords_destino)[0];
            $lng_destino = explode('/',$pedido->coords_destino)[1];
            $coord_final = new LatLng(['lat' => $lat_destino, 'lng' => $lng_destino]);

            // Lets add a marker now
            $marker_destino = new Marker([
                'position' => $coord_final,
                'title' => 'Destino',
            ]);

            $marker_destino->attachInfoWindow(
                new InfoWindow([
                    'content' => '<p>Destino</p>'
                ])
            );

            $options_destino = new MarkerOptions();
            $options_destino->clickable = false;
            $options_destino->visible = true;

            $marker_destino->setOptions( $options_destino );

            // Add marker to the map
            $map->addOverlay($marker_destino);
        }

        $miMapa = $map->display();


        return $this->render('showmap', ['map'=> $miMapa, 'pedido' => $pedido, 'oferta'=> $oferta]);
    }


    public function setMap() {

        $coord = new LatLng(['lat' => 45.515624, 'lng' => -73.569296]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 12,
        ]);

        return $map->display();
    }



}


