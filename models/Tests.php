<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property int $id
 * @property int $test_id
 * @property int $school
 * @property string $job
 * @property int $class
 * @property int $teach_id
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
            [['test_id', 'school', 'job', 'class', 'teach_id'], 'required'],
            [['test_id', 'school', 'class', 'teach_id'], 'integer'],
            [['job'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'school' => 'School',
            'job' => 'Job',
            'class' => 'Class',
            'teach_id' => 'Teach ID',
        ];
    }
}
