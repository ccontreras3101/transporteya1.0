<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ruta".
 *
 * @property integer $id
 * @property string $lat
 * @property string $lng
 * @property integer $oferta_id
 *
 * @property Oferta $oferta
 */
class Ruta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat', 'lng', 'oferta_id'], 'required'],
            [['oferta_id'], 'integer'],
            [['lat', 'lng'], 'string', 'max' => 45],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Oferta::className(), 'targetAttribute' => ['oferta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'oferta_id' => 'Oferta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOferta()
    {
        return $this->hasOne(Oferta::className(), ['id' => 'oferta_id']);
    }
}
