<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Entrega extends Model
{
    public $imagen;
    public $firma;
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imagen','firma'], 'safe'],
            [['imagen'], 'file', 'extensions' => 'jpg, png', 'skipOnEmpty' => false],
            [['firma'], 'string'],

        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'imagen' => 'Foto Carga',
            'firma' => 'Firma Cliente',
        ];
    }

    
}
