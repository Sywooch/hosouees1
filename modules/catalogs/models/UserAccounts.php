<?php

namespace app\modules\catalogs\models;

use Yii;

/**
 * This is the model class for table "user_accounts".
 *
 * @property integer $id
 * @property string $login
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $administrator
 * @property integer $creator
 * @property string $creator_ip
 * @property string $confirm_token
 * @property string $recovery_token
 * @property integer $blocked_at
 * @property integer $confirmed_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Asistencia[] $asistencias
 * @property Comunicacion[] $comunicacions
 * @property Horas[] $horas
 * @property Persona[] $personas
 */
class UserAccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'username', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['administrator', 'creator', 'blocked_at', 'confirmed_at', 'created_at', 'updated_at'], 'integer'],
            [['login', 'username', 'password_hash', 'auth_key', 'confirm_token', 'recovery_token'], 'string', 'max' => 255],
            [['creator_ip'], 'string', 'max' => 40],
            [['login'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'administrator' => Yii::t('app', 'Administrator'),
            'creator' => Yii::t('app', 'Creator'),
            'creator_ip' => Yii::t('app', 'Creator Ip'),
            'confirm_token' => Yii::t('app', 'Confirm Token'),
            'recovery_token' => Yii::t('app', 'Recovery Token'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistencias()
    {
        return $this->hasMany(Asistencia::className(), ['IdUsuarioRegistro' => 'id'])->inverseOf('idUsuarioRegistro');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunicacions()
    {
        return $this->hasMany(Comunicacion::className(), ['IdUsuarioRegistro' => 'id'])->inverseOf('idUsuarioRegistro');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoras()
    {
        return $this->hasMany(Horas::className(), ['IdUsuarioRegistro' => 'id'])->inverseOf('idUsuarioRegistro');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['UserId' => 'id'])->inverseOf('user');
    }    
    
    /**
     * @inheritdoc
     * @return UserAccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserAccountsQuery(get_called_class());
    }
}
