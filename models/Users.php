<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property int $school
 * @property string $name
 * @property string $surname
 * @property int $class
 * @property string $password
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'school', 'name', 'surname', 'class', 'password'], 'required'],
            [['school', 'class'], 'integer'],
            [['login', 'name', 'surname', 'password'], 'string', 'max' => 255],
            ['login', 'unique', 'message' => 'Bu login band!']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'school' => 'School',
            'name' => 'Name',
            'surname' => 'Surname',
            'class' => 'Class',
            'password' => 'Password',
        ];
    }

    public static function findIdentity($id)
    {
        return self::find()->select(["id", "login", "school", "name", "surname", "class"])->where(["id" => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return self::find()->where(['login' => $login])->select(["id", "login", "password"])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // return $this->authKey === $authKey;
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}