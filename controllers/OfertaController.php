<?php

namespace app\controllers;

use Yii;
use app\models\Oferta;
use app\models\OfertaSearch;
use app\models\OfertaSearchmiscargas;
use app\models\OfertaSearchfree;
use app\models\Cliente;
use app\models\Comuna;
use app\models\Provincia;
use app\models\Ruta;
use app\models\Region;
use app\models\Pedido;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * OfertaController implements the CRUD actions for Oferta model.
 */
class OfertaController extends Controller
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
     * Lists all Oferta models.
     * @return mixed
     */
    public function actionIndex($pedido_id)
    {

        $searchModel = new OfertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,       
            
        ]);
    }

    /**
     * Lists all Oferta models.
     * @return mixed
     */
    public function actionIndexfree()
    {
        
        $searchModel = new OfertaSearchfree();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexfree', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,       
        ]);
    }
    
    /**
     * Lists all Oferta models.
     * @return mixed
     */
    public function actionIndexmiscargas()
    {
        
        $searchModel = new OfertaSearchmiscargas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('indexmiscargas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Oferta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Oferta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pedido_id, $cliente_id, $empresas_id, $id)
    {

        if(empty($empresas_id) && empty($id)){
            
                $cliente = Cliente::find()->where(['id'=>$cliente_id])->One();
                $pedido = Pedido::find()->where(['id'=>$pedido_id])->One();
                $competencia = Oferta::find()->where(['pedido_id' => $pedido_id])->orderBy(['oferta_serv' => SORT_DESC])->all();

                $comunaOrigen = Comuna::find()->where(['id'=>$pedido->comuna_origen_id])->One();
                $comunaDestino = Comuna::find()->where(['id'=>$pedido->comuna_destino_id])->One();
                $provinciaOrigen= Provincia::find()->where(['id'=>$comunaOrigen->provincia_id])->One();
                $provinciaDestino= Provincia::find()->where(['id'=>$comunaDestino->provincia_id])->One();
                $regionOrigen = Region::find()->where(['id'=>$provinciaOrigen->region_id])->One();
                $regionDestino = Region::find()->where(['id'=>$provinciaDestino->region_id])->One();
                $Inicio = "La Region de: ". $regionOrigen->nombre.", en la Provincia de: ".$provinciaOrigen->nombre.", en la Comuna  ".$comunaOrigen->nombre." de la Dirección ". $pedido->origen;
                $Final =  "La Region de: ".$regionDestino->nombre.", en la Provincia de:".$provinciaDestino->nombre.",  en la Comuna".$comunaDestino->nombre." en la Dirección ". $pedido->destino;

                $model = new Oferta();
                $model->cliente_id=$cliente->id;
                $model->pedido_id=$pedido->id;
                $model->cliente_nombre=$cliente->nombre.",".$cliente->apellidop." ".$cliente->apellidom;
                $model->pedido_datos = "N°: 00".$pedido->id." ".
                                       "Desde:".$Inicio.
                                       "- Hasta:".$Final;
                //$model->coordenadas_actuales = $pedido->coords_origen;


                if ($model->load(Yii::$app->request->post())) {
                   
                   // $pedido = new Pedido();
                    $cliente->id=$model->cliente_id;
                    $pedido->id=$model->id;
                    $model->aprobada= 0;
                    //$model->coordenadas_actuales=$model->coordenadas_actuales;
                    $model->oferta_serv=$model->oferta_serv;
                    $model->comentarios=$model->comentarios;
                    $model->empresas_id=Yii::$app->user->identity->id;
                        $model->save(false);

                    return $this->redirect(['view','id'=>$model->id]);

                } else {
                    return $this->render('create', [
                        'model' => $model,
                        'competencia' => $competencia,
                        'n_pedido' => $pedido_id
                    ]);
                }
            }else{

                $consulta = Oferta::find()->where(['empresas_id' => $empresas_id] && ['cliente_id'=>$cliente_id] && ['pedido_id'=>$pedido_id] )->all();
                if(!empty($consulta)){
                        $model = $this->findModel($id);
                        $oferta = Oferta::find()->where(['id'=> $id])->One();
                    if ($model->load(Yii::$app->request->post())) {
                        $oferta->comentarios = $model->comentarios;
                        $oferta->oferta_serv = $model->oferta_serv;
                            $oferta->save(false);
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                   
                }
            }
    }

    /**
     * Updates an existing Oferta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    
        $model = $this->findModel($id);
        $oferta = Oferta::find()->where(['id'=> $id])->One();
        if ($model->load(Yii::$app->request->post())) {
            $oferta->comentarios = $model->comentarios;
            $oferta->oferta_serv = $model->oferta_serv;
                $oferta->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Oferta model.
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
     * Finds the Oferta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Oferta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Oferta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*Aprobacióm de oferta*/

    public function actionAprobada($id, $pedido_id, $empresas_id, $cliente_id)
    {
       
        $ofertas = Oferta::find()->where(['pedido_id'=>$pedido_id])->All();
        $pedido = Pedido::find()->where(['id'=>$pedido_id])->One();
        $origen = Comuna::find()->where(['id'=>$pedido->comuna_origen_id])->One();
        $destino = Comuna::find()->where(['id'=>$pedido->comuna_destino_id])->One();
        $empresa = Cliente::find()->where(['id'=>$empresas_id])->One();
        $cliente = Cliente::find()->where(['id'=> $cliente_id])->One();
        $pedido->status = 1;
        $pedido->save(false);

        foreach ($ofertas as $oferta) {
            if ( $oferta->id == $id  ) {
                $oferta->aprobada = 1;
                $oferta->save(false);  
        
            } else {
                $oferta->aprobada = 2;
                $oferta->save(false);
            }
        }

        $formato = strpos( $pedido->coords_origen , "/");
        if ( $formato !== false ) {
            $ruta = new Ruta();
            $ruta->oferta_id = $id;
            $ruta->lat = explode("/", $pedido->coords_origen)[0];
            $ruta->lng = explode("/", $pedido->coords_origen)[1];
            $ruta->save();
        }
    
        $content = '<h1>BIENVENIDO A TRANSPORTE YA</h1>';
        $content .= '<p>Nos complece informarle que su oferta para transportar nuestro envío desde:</p>'. $origen->nombre.
        '<p> hasta: </p>'. $destino->nombre. '<p> por favor comuniquese con nosotros por el teléfono: +56 </p>'. $cliente->fono.
        '<p> o por email</p>'. $cliente->email. '<p>a la brevedad posible</p>';

        Yii::$app->mailer->compose("@app/mail/layouts/html", ["content" => $content])
               ->setTo($empresa->email)
               ->setFrom([ Yii::$app->params['adminEmail'] => Yii::$app->user->identity->fullname ])
               ->setSubject('Oferta Aprobada')
               ->send();

        return $this->redirect(['view','id'=>$id]);
    }

    /*Oferta vencida*/

    public function actionVencida($id, $pedido_id)
    {
        $model = $this->findModel($id);
            $model->aprobada = 0;
            $model->save(false);

        $pedido = Pedido::find()->where(['id'=>$pedido_id])->One();
                $pedido->status = 0;
                $pedido->save(false);

        return $this->redirect(['indexfree']);
    }



}
