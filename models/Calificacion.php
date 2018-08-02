<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calificacion".
 *
 * @property integer $id
 * @property integer $calificacion
 * @property string $comentario
 * @property string $fecha
 * @property integer $oferta_id
 *
 * @property Oferta $oferta
 */
class Calificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calificacion', 'comentario', 'oferta_id'], 'required'],
            [['calificacion', 'oferta_id'], 'integer'],
            [['comentario'], 'string'],
            [['fecha'], 'safe'],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Oferta::className(), 'targetAttribute' => ['oferta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'calificacion' => Yii::t('app', 'Calificacion'),
            'comentario' => Yii::t('app', 'Comentario'),
            'fecha' => Yii::t('app', 'Fecha'),
            'oferta_id' => Yii::t('app', 'Oferta ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOferta()
    {
        return $this->hasOne(Oferta::className(), ['id' => 'oferta_id']);
    }
    //////////////
    public function getEmpresa()
    {
        $empresa_id = Oferta::find()->where(['id'=>$this->oferta_id])->One();
        return Cliente::find()->where(['id'=> $empresa_id->empresas_id])->One();  
    }
    //////////////
    public function getCliente()
    {
        $cliente_id = Oferta::find()->where(['id'=>$this->oferta_id])->One();
        $cliente_nombre = Cliente::find()->where(['id'=> $cliente_id->cliente_id])->One(); 
        return $cliente_nombre->nombre.",".$cliente_nombre->apellidop." ".$cliente_nombre->apellidom;
    }

    public function getImagen() {
        switch ($this->calificacion) {
            case 0:
                return "bueno.png";
                break;
            case 1:
                return "regular.png";
                break;
            case 2:
                return "malo.png";
                break;
            
            default:
                return '';
                break;
        }
    }


}
