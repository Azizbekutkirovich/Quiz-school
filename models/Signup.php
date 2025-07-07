<?php

namespace app\models;
use yii\base\Model;

class Signup extends Model
{
  public $login;
  public $school;
  public $name;
  public $surname;
  public $class;
  public $password;

  public function rules()
  {
      return [
          [['login', 'school', 'name', 'surname', 'class', 'password'], 'required', 'message' => "Maydonni to'ldirish shart!"],
          [['school', 'class'], 'integer'],
          [['login', 'name', 'surname', 'password'], 'string', 'max' => 255],
          ['login', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'Bu login band!'],
          ['password', 'unique', 'targetClass' => '\app\models\Users', 'message' => "Bu parol band! Boshqa parol kiriting!"]
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

  protected function save() {
    if ($this->validate()) {
        $user = new Users();
        $user->login = $this->login;
        $user->school = $this->school;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->class = $this->class;
        $user->password = $this->password;
        return $user->create();
    }
  }

  public function signup(){
    return $this->save();
  }
}