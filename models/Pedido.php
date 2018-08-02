<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "pedido".
 *
 * @property integer $id
 * @property string $origen
 * @property string $destino
 * @property string $tiempo
 * @property string $fecha
 * @property string $comentarios
 * @property integer $status
 * @property string $coords_origen
 * @property string $coords_destino
 * @property string $fecha_entrega
 * @property string $imagen_carga_entregada
 * @property string $firma_cliente
 * @property integer $cliente_id
 * @property integer $comuna_origen_id
 * @property integer $comuna_destino_id
 *
 * @property Oferta[] $ofertas
 * @property Cliente $cliente
 * @property Comuna $comunaOrigen
 * @property Comuna $comunaDestino
 */
class Pedido extends \yii\db\ActiveRecord
{
    public $region_origen;
    public $region_destino;
    public $provincia_origen;
    public $provincia_destino;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['origen', 'destino', 'tiempo', 'cliente_id', 'comuna_origen_id', 'comuna_destino_id'/*, 'coords_origen','coords_destino'*/], 'required', 'message'=>'Campo obligatorio'],
            [['tiempo', 'fecha', 'fecha_entrega', 'imagen_carga_entregada', 'firma_cliente'], 'safe'],
            [['comentarios', 'imagen_carga_entregada', 'firma_cliente'], 'string'],
            [['status', 'cliente_id', 'comuna_origen_id', 'comuna_destino_id'], 'integer'],
            [['origen', 'destino', 'coords_origen', 'coords_destino'], 'string', 'max' => 150],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['comuna_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['comuna_origen_id' => 'id']],
            [['comuna_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['comuna_destino_id' => 'id']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Pedido N°'),
            'origen' => Yii::t('app', 'Direccion de Inicio'),
            'destino' => Yii::t('app', 'Direccion de Destino'),
            'tiempo' => Yii::t('app', 'Tiempo de espera respuesta'),
            'fecha' => Yii::t('app', 'Fecha'),
            'comentarios' => Yii::t('app', 'Especificaciones de Envío'),
            'status' => Yii::t('app', 'Status'),
            'coords_origen' => Yii::t('app', 'Coords Origen'),
            'coords_destino' => Yii::t('app', 'Coords Destino'),
            'cliente_id' => Yii::t('app', 'Cliente ID'),
            'comuna_origen_id' => Yii::t('app', 'Comuna Origen'),
            'comuna_destino_id' => Yii::t('app', 'Comuna Destino'),
            'fecha_entrega' => Yii::t('app', 'Fecha de Entrega'),
            'imagen_carga_entregada' => Yii::t('app', 'Imagen de la Carga'),
            'firma_cliente' => Yii::t('app', 'Firma del Cliente'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Oferta::className(), ['pedido_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertaAprobada()
    {
        $ofertas = Oferta::find()->where(['pedido_id'=>$this->id])->all();
        foreach ($ofertas as $oferta) {
            if ( $oferta->aprobada == 1 ) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunaOrigen()
    {
        return $this->hasOne(Comuna::className(), ['id' => 'comuna_origen_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinciaOrigen()
    {
        return $this->hasOne(Provincia::className(), ['id' => $this->comunaOrigen->id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunaDestino()
    {
        return $this->hasOne(Comuna::className(), ['id' => 'comuna_destino_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'num_comunas']);
    }
    ///////////////////////
    public function getComunaPedido()
    {
        return $this->comunaOrigen->nombre." - ".  $this->comunaDestino->nombre;
    }
    ///////////////////////
    public function getOrigen()
    {
        return $this->comunaDestino->nombre;
    }
    ///////////////////////
    public function getDestino()
    {
        return $this->comunaOrigen->nombre;
    }
    ///////////////////////
    public function getName()
    {
        return $this->cliente->nombre.",".$this->cliente->apellidop." ".$this->cliente->apellidom;
    }
    ///////////////////////
    public function getRut()
    {
        return $this->cliente->rut."-".$this->cliente->rut_add;
    }
    ///////////////////////
    public function getEmpresa()
    {
        $empresa = Oferta::find()//->select(['empresas_id', 'rut', 'rut_add'])
                                 ->where(['pedido_id' => $this->id])
                                 //->andWhere(['aprobada'=>1])
                                 ->One(); 

        return Cliente::find()->where(['id'=>$empresa->empresas_id])->One();
    }
    ///////////////////
    public function getValor()
    {
        return Oferta::find()->select('oferta_serv')
                                      ->where(['pedido_id' => $this->id])
                                      ->andWhere(['aprobada' => 1])
                                      ->One();
    }
    ///////////////////////
     public function getOfertaId()
    {
        $ofertaId = Oferta::find()->select(['id'])
                              ->where(['pedido_id' => $this->id])
                              ->andWhere(['aprobada' => 1])
                              ->One();  
         return $ofertaId;
    }
    ///////////////////////
    public  function getEstado()
    {
        if ($this->status == 0) {
            $estado = "Ofertado";
        }
        if ($this->status == 1) {
            $estado = "Contratado";
        }
        if ($this->status == 2) {
            $estado = "Entregado";
        } 
        if ($this->status == 3) {
            $estado = "Concluido";
        }         
        return $estado;
    }
}
