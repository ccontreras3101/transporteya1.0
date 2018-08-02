<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $romano
 * @property integer $num_provincias
 * @property integer $num_comunas
 *
 * @property Provincia[] $provincias
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'romano', 'num_provincias', 'num_comunas'], 'required'],
            [['num_provincias', 'num_comunas'], 'integer'],
            [['nombre'], 'string', 'max' => 60],
            [['romano'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', ''),
            'nombre' => Yii::t('app', 'Nombre'),
            'romano' => Yii::t('app', 'Romano'),
            'num_provincias' => Yii::t('app', 'Num Provincias'),
            'num_comunas' => Yii::t('app', 'Num Comunas'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincias()
    {
        return $this->hasMany(Provincia::className(), ['region_id' => 'id']);
    }
}
