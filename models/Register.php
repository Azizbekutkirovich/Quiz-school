<?php

namespace app\models;
use yii\base\Model;

class Register extends Model
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
          [['name', 'surname'], 'string', 'max' => 255],
          ['login', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'Bu login band!'],
          ['login', 'string', 'min' => 6, "tooShort" => "Login kamida 6ta belgidan iborat bo'lishi kerak!"],
          ['password', 'string', 'min' => 8, "tooShort" => "Parol kamida 8ta belgidan iborat bo'lishi kerak!"],
          ['password', 'match',  'pattern' => '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', 'message' => 'Parolda katta harf, kichik harf, va raqam bo‘lishi shart!'],
          ['password', 'unique', 'targetClass' => '\app\models\Users', 'message' => "Bu parol band! Boshqa parol kiriting!"],
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
        $user->setPassword($this->password);
        return $user->save();
    }
    return false;
  }

  public function signup(){
    return $this->save();
  }
}