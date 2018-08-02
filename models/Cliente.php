<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property integer $rut
 * @property integer $rut_add
 * @property string $nombre
 * @property string $apellidop
 * @property string $apellidom
 * @property string $direccion
 * @property string $fono
 * @property string $email
 * @property integer $reglas_condiciones
 * @property string $username
 * @property string $password
 * @property integer $comuna_id
 * @property integer $activo
 * @property integer $tipo
 * @property integer $imagen_perfil
 * @property integer $roll_sii
 * @property Comuna $comuna
 * @property Oferta[] $ofertas
 * @property Pedido[] $pedidos
 */
class Cliente extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVO = 1;
    public $empresas_id;

    public $foto_perfil; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rut', 'rut_add', 'nombre', 'apellidop', 'apellidom', 'direccion', 'fono', 'email', 'reglas_condiciones', 'username', 'password', 'comuna_id', 'tipo', 'foto_perfil'],"safe"],
            [[ 'reglas_condiciones', 'comuna_id', 'activo', 'tipo'], 'integer'],
            [['rut'], 'number'],
            [['rut_add'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 120],
            [['apellidop', 'apellidom', 'email'], 'string', 'max' => 50],
            [['direccion'], 'string', 'max' => 250],
            [['fono'], 'number'],
            [['fono'], 'match', 'pattern' => '/^\d{11}/i', 'message'=>'Debe contener 11 caracteres.'],
            [['username'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'email', 'message'=> 'Debe Intoducir un email válido'],
            [['email'], 'unique'],
            [['comuna_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['comuna_id' => 'id']],
            [['foto_perfil'], 'file', 'extensions' => 'jpg, png', 'skipOnEmpty' => true],
            [['rut', 'rut_add'], 'rutvalidate'],
            [['rut'], 'rutunico'],
            [['rut', 'rut_add','nombre','apellidop','apellidom','direccion','fono','email','username','password','comuna_id'], 'required'],
        ];
    }

    public function rutvalidate() {
        $band = false;
        $rut = $this->rut.'-'.$this->rut_add;
        $suma = 0;
        if(strpos($rut,"-")==false){
            $RUT[0] = substr($rut, 0, -1);
            $RUT[1] = substr($rut, -1);
        }else{
            $RUT = explode("-", trim($rut));
        }
        $elRut = str_replace(".", "", trim($RUT[0]));
        $factor = 2;
        for($i = strlen($elRut)-1; $i >= 0; $i--):
            $factor = $factor > 7 ? 2 : $factor;
            $suma = $suma + $elRut{$i}*$factor++;
        endfor;
        $resto = $suma % 11;
        $dv = 11 - $resto;
        if($dv == 11){
            $dv=0;
        }else if($dv == 10){
            $dv="k";
        }else{
            $dv=$dv;
        }
        if($dv == trim(strtolower($RUT[1]))){
        }else{
           $this->addError('rut', 'Formato Invalido');
        }
    }

    public function rutunico() {
        $cliente = Cliente::find()->where(['rut' => $this->rut, 'rut_add' => $this->rut_add])->one();

        if ( count($cliente) > 0 || !empty($cliente) ) {
            $this->addError('rut', 'RUT registrado previamente.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rut' => Yii::t('app', 'Rut'),
            'rut_add' => Yii::t('app', '-'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidop' => Yii::t('app', 'Apellido Paterno'),
            'apellidom' => Yii::t('app', 'Apellido Materno'),
            'direccion' => Yii::t('app', 'Direccion'),
            'fono' => Yii::t('app', 'Teléfono +56'),
            'email' => Yii::t('app', 'Email'),
            'reglas_condiciones' => Yii::t('app', 'Acepto las Reglas y Condiciones'),
            'username' => Yii::t('app', 'Usuario'),
            'password' => Yii::t('app', 'Password'),
            'comuna_id' => Yii::t('app', 'Comuna'),
            'activo' => Yii::t('app', 'Activo'),
            'tipo' => Yii::t('app', 'Tipo Cliente'),
            'rutfull'=> Yii::t('app', 'Registo Único Tributario'),
            'imagen_perfil'=> Yii::t('app', 'Imagen Perfil'),
            'roll_sii'=> Yii::t('app', 'Roll SII'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComuna()
    {
        return $this->hasOne(Comuna::className(), ['id' => 'comuna_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Oferta::className(), ['cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['cliente_id' => 'id']);
    }
    /*validacion de nombre*/
    public function getFullname(){
        if ($this->tipo == 0){
            return  $this->nombre.",". $this->apellidop." ". $this->apellidom;
        }
        else{
             return $this->nombre;
        }
    }
    /*Rut*/

    public function getRutfull(){
        
        return $this->rut ."-". $this->rut_add;
    }
    //////////
    public function getRolid() {
        return $this->tipo;
    }
    //////////
    public function getRol() {
        return ( $this->tipo == 0 ) ? 'Cliente' : 'Empresa';
    }
    //////////
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'activo' => self::STATUS_ACTIVO]);
    }
    //////////

    public function getOfertaId()
    {
        $oferta =  Oferta::find()->select(['id'])
                                    ->where(['empresas_id'=> $this->id])
                                    ->andWhere(['aprobada'=>1])
                                    ->asArray()
                                    ->All();
        
        foreach ($oferta as $ofertaValue) {
            $ofertaKey = $ofertaValue['id'];
            return $ofertaKey;
        }
    }
    /////////////
    public function getClienteOferta()
    {
        $cliente =  Oferta::find()->select(['cliente_id'])
                                    ->where(['empresas_id'=> $this->id])
                                    ->andWhere(['aprobada'=>1])
                                    ->asArray()
                                    ->All();
        
        foreach ($cliente as $clienteValue) {
            $clienteKey = $clienteValue['cliente_id'];
            
            $clienteNombre = Cliente::find()->select(['nombre', 'apellidop', 'apellidom'])
                                            ->where(['id'=>$clienteKey])
                                            ->asArray()
                                            ->All();

            foreach ($clienteNombre as  $nombreFull) {
                $nombreKey = $nombreFull['nombre'].",".$nombreFull['apellidop']." ".$nombreFull['apellidom'];
                return $nombreKey;
            }
        }
    }
    
}
