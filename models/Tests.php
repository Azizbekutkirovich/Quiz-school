<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $teach_id
 * @property int $school
 * @property int $class
 * @property string $job
 * @property string $name
 * @property string $test_name
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teach_id', 'school', 'class', 'job', 'name', 'test_name'], 'required'],
            [['teach_id', 'school', 'class'], 'integer'],
            [['job', 'name', 'test_name'], 'string', 'max' => 255],
        ];
    }
}
