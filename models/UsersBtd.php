<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_btd".
 *
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 * @property int $test_id
 * @property int $question_num
 * @property int $ans
 * @property int $selected
 */
class UsersBtd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_btd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'question_id', 'test_id', 'question_num', 'ans', 'selected'], 'required'],
            [['user_id', 'question_id', 'test_id', 'question_num', 'ans', 'selected'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'question_id' => 'Question ID',
            'test_id' => 'Test ID',
            'question_num' => 'Question Num',
            'ans' => 'Ans',
            'selected' => 'Selected',
        ];
    }
}
