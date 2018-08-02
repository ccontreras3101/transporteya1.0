<?php

namespace app\models;
use app\models\Cliente;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $rut;
    public $rut_add;
    public $nombre;
    public $apellidop;
    public $apellidom;
    public $direccion;
    public $fono;
    public $email;
    public $reglas_condiciones;
    public $username;
    public $password;
    public $comuna_id;
    public $activo;
    public $tipo;
    public $imagen_perfil;
    public $roll_sii;

    // public $id;
    // public $username;
    // public $password;
    public $authKey;
    public $accessToken;


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $usuario = Cliente::find()->where(['id'=>$id])->one();

        return isset( $usuario ) ? new static( $usuario ) : null;
        
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $usuarios = Cliente::find()->where(['username' => $username])->all();
        foreach ($usuarios as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    public function getFullname()
    {
        if ($this->tipo == 0){
            return  $this->nombre.",". $this->apellidop." ". $this->apellidom;
        }
        else{
             return $this->nombre;
        }
    }

    public function getUsuario()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFono()
    {
        return $this->fono;
    }

    public function getComuna()
    {
        return $this->comuna_id;
    }

    public function getImagenPerfil()
    {
        return substr($this->imagen_perfil, 4);
    }
    public function getRollsii()
    {
        return substr($this->roll_sii, 4);
    }

    public function getRolid() {
        return $this->tipo;
    }

    public function getRol() {
        return ( $this->tipo == 0 ) ? 'Cliente' : 'Empresa';
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }
}
