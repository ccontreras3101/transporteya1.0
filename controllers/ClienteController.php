<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\models\Cliente2;
use app\models\Oferta;
use app\models\CalificacionSearch;
use app\models\Pedido;
use app\models\Calificacion;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
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
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewempresa($empresa_id)
    {

        $ofertas = Oferta::find()
                    ->where(['empresas_id'=> $empresa_id])
                    ->All();
        
        $_ceros = 0 ;
        $_unos = 0 ;
        $_dos = 0 ;

        $calificaciones = [];
        
        foreach ($ofertas as $oferta) {
            if ( $oferta->calificacions ) {
                $calificaciones[] = $oferta->calificacions[0];
                switch ($oferta->calificacions[0]->calificacion) {
                    case 0:
                        $_ceros += 1 ;
                        break;
                    case 1:
                        $_unos += 1 ;
                        break;
                    case 2:
                        $_dos += 1 ;
                        break;
                    
                    default:
                        break;
                }
            }
        }
    
        $total = $_ceros + $_unos + $_dos;

        $buenocant=$_ceros;
        $regularcant=$_unos;
        $malocant=$_dos;
        $buenoporc = ( $total > 0 ) ? round(($_ceros/$total) * 100, 2) ."%" : '';
        $regularporc = ( $total > 0 ) ? round(($_unos/$total) * 100, 2) ."%" : '';
        $maloporc = ( $total > 0 ) ? round(($_dos/$total) * 100, 2) ."%" : '';

        $recomendaciones = ( $total > 0 ) ? "El ".$buenoporc." de sus clientes lo recomienda" : "No posee calificaciones";
       
        ///////////////////////////////
        return $this->render('viewempresa', [
            'model' => $this->findModel($empresa_id),
            'buenocant'=>$buenocant,
            'regularcant'=>$regularcant,
            'malocant'=>$malocant,
            'buenoporc'=>$buenoporc,
            'regularporc'=>$regularporc,
            'maloporc'=>$maloporc,
            'total'=>$total,
            'recomendaciones' => $recomendaciones,
            'calificaciones' => $calificaciones
        ]);


    }

    /**
     * Displays a single Calificacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewnew($id)
    {
        return $this->render('viewnew', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tipo)
    {
        if($tipo == 0){
            $model = new Cliente();
        }
        if($tipo == 1){
            $model = new Cliente2();
        }
            $model->tipo = $tipo;

        if ($model->load(Yii::$app->request->post()) && !empty($_FILES) && $model->validate() ) {
            $model->password = sha1($model->password);
            
            if($model->tipo == 0 ){
                $band = move_uploaded_file($_FILES["Cliente"]["tmp_name"]["foto_perfil"], \Yii::getAlias('@app').'/web/imagenes_perfil/perfil_' . $_FILES["Cliente"]["name"]["foto_perfil"]);
                $model->imagen_perfil = '/web/imagenes_perfil/perfil_'. $_FILES["Cliente"]["name"]["foto_perfil"];
            }
            
            if($model->tipo == 1 ){
                $band = move_uploaded_file($_FILES["Cliente2"]["tmp_name"]["foto_perfil"], \Yii::getAlias('@app').'/web/imagenes_perfil/perfil_' . $_FILES["Cliente2"]["name"]["foto_perfil"]);
                $model->imagen_perfil = '/web/imagenes_perfil/perfil_'. $_FILES["Cliente2"]["name"]["foto_perfil"];
                $rollsii = move_uploaded_file($_FILES["Cliente2"]["tmp_name"]["roll_sii"], \Yii::getAlias('@app').'/web/imagenes_roll/roll_' . $_FILES["Cliente2"]["name"]["roll_sii"]);
                $model->roll_sii = '/web/imagenes_roll/roll_' . $_FILES["Cliente2"]["name"]["roll_sii"];
            }

            if (  $model->save() ){

                $auth=Yii::$app->authManager;
                $rol=$auth->getRole( ($model->tipo == 0) ? "cliente" : "empresa");
                $auth->assign($rol, $model->id);
                
                //setflash
                Yii::$app->getSession()->setFlash('success', [
                    'text' => 'Felicidades su Registro ha sido creado exitosamente',
                    'title' => 'Registro',
                    'type' => 'success',
                    'timer' => 4000,
                    'showConfirmButton' => false
                ]);
                // end set flash
                return $this->redirect(['site/login']);
                
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $cliente = Cliente::find()->where(['id'=>$model->id])->One();
        if ($model->load(Yii::$app->request->post()) ) {
                $cliente->rut = $model->rut;
                $cliente->rut_add = $model->rut_add;
                $cliente->nombre = $model->nombre;
                $cliente->apellidop = $model->apellidop;
                $cliente->apellidom = $model->apellidom;
                $cliente->direccion = $model->direccion;
                $cliente->fono = $model->fono;
                $cliente->email = $model->email;
                $cliente->reglas_condiciones = $model->reglas_condiciones;
                // $cliente->username = $model->username;
                // $model->password = sha1($model->password);
                $cliente->comuna_id = $model->comuna_id;
                $cliente->activo = $model->activo;
                $cliente->tipo = $model->tipo;

                $band = move_uploaded_file($_FILES["Cliente"]["tmp_name"]["foto_perfil"], \Yii::getAlias('@app').'/web/imagenes_perfil/perfil_' . $_FILES["Cliente"]["name"]["foto_perfil"]);

                $model->imagen_perfil = '/web/imagenes_perfil/perfil_' . $_FILES["Cliente"]["name"]["foto_perfil"];
                $model->save(false);


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cliente model.
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
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
