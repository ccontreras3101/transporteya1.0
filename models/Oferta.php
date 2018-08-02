<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oferta".
 *
 * @property integer $id
 * @property double $oferta_serv
 * @property string $comentarios
 * @property integer $aprobada
 * @property integer $empresas_id
 * @property integer $pedido_id
 * @property integer $cliente_id
 * @property string $coordenadas_actuales
 *
 * @property Cliente $cliente
 * @property Pedido $pedido
 */
class Oferta extends \yii\db\ActiveRecord
{
    public $cliente_nombre;
    public $pedido_datos;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oferta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oferta_serv', 'comentarios', 'empresas_id', 'pedido_id', 'cliente_id'], 'required', 'message'=>'Campo obligatorio'],
            [['oferta_serv'], 'number'],
            [['aprobada', 'empresas_id', 'pedido_id', 'cliente_id'], 'string'],
            [['comentarios'], 'string', 'max' => 250],
            [['coordenadas_actuales'], 'string', 'max' => 150],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'oferta_serv' => Yii::t('app', 'Oferta'),
            'comentarios' => Yii::t('app', 'Comentarios'),
            'aprobada' => Yii::t('app', 'Aprobada'),
            'empresas_id' => Yii::t('app', 'Empresa N°'),
            'pedido_id' => Yii::t('app', 'Pedido N°'),
            'cliente_id' => Yii::t('app', 'Cliente'),
            'coordenadas_actuales' => Yii::t('app', 'Coordenadas Actuales'),
            'pedido_datos' => Yii::t('app', 'Datos del Pedido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }
    
    public function getEmpresaid()
    {
        return  $this->empresas_id;
    }

    public function getEmpresa()
    {
        $empresaid = $this->empresas_id;
        $nombre = Cliente::find()->where(['id'=>$empresaid])->One();
        return $nombre;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCalificacions() 
    { 
        return $this->hasMany(Calificacion::className(), ['oferta_id' => 'id']); 
    }
    ///////////////////
    public function getOrigen()
    {
        return $this->hasMany(Comuna::className(), ['id'=>$pedido->comuna_origen_id]);
    }
     public function getDestino()
    {
        return $this->hasMany(Comuna::className(), ['id'=>$pedido->comuna_destino_id]);
    }
    public function getRutas() {
        return $this->hasMany(Ruta::className(), ['oferta_id' => 'id']);
    }
}
