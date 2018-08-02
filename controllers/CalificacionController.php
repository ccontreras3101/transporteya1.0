<?php

namespace app\controllers;

use Yii;
use app\models\Calificacion;
use app\models\Cliente;
use app\models\Pedido;
use app\models\Oferta;
use app\models\CalificacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CalificacionController implements the CRUD actions for Calificacion model.
 */
class CalificacionController extends Controller
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
     * Lists all Calificacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CalificacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Calificacion model.
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
     * Creates a new Calificacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pedido_id)
    {

        $ofertaId = Oferta::find()->where(['pedido_id'=>$pedido_id])
                                  ->andWhere(['aprobada'=> 1])
                                  ->One();
       
        $pedido = Pedido::find()->where(['id'=>$pedido_id])->One();
        $model = new Calificacion();

        if ($model->load(Yii::$app->request->post())) {

            $validate = Calificacion::find()->where(['oferta_id'=> $ofertaId->id])->One();
            

            if(empty($validate) ){
                    $pedido->status = 4;
                        $pedido->save(false);
                    $model->oferta_id = $ofertaId->id;
                        $model->save(false);
                //setflash
                Yii::$app->getSession()->setFlash('success', [
                    'text' => 'Ha Calificado a su Proveedor de Servicio ',
                    'title' => 'Calificacion',
                    'type' => 'success',
                    'timer' => 4000,
                    'showConfirmButton' => false
                ]);
                // end set flash
                return $this->redirect(['site/index']);
            }else{
                if($validate->oferta_id == $ofertaId->id){
                    return $this->redirect(['site/index']);
                }
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Calificacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Calificacion model.
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
     * Finds the Calificacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Calificacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Calificacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
