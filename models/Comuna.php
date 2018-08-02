<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comuna".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $provincia_id
 *
 * @property Cliente[] $clientes
 * @property Provincia $provincia
 * @property Pedido[] $pedidos
 * @property Pedido[] $pedidos0
 */
class Comuna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comuna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'provincia_id'], 'required'],
            [['provincia_id'], 'integer'],
            [['nombre'], 'string', 'max' => 250],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provincia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'provincia_id' => Yii::t('app', 'Provincia ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['comuna_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provincia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['comuna_origen_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos0()
    {
        return $this->hasMany(Pedido::className(), ['comuna_destino_id' => 'id']);
    }
}
