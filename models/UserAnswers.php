<?php


namespace app\models;

use Yii;
use yii\base\Model;

class UserAnswers extends Model
{
	public $answers = [];

	public function rules() {
		return [
			['answers', 'safe']
		];
	}
}