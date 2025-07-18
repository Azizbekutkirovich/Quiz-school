<?php
namespace app\controllers;

use Yii;
use app\models\Tests;
use app\models\Teachers;
use app\models\UserDt;
use app\excel\TestParser;
use yii\filters\AccessControl;
use yii\web\Controller;

class UsersController extends Controller
{
	public function behaviors() {
		return [
			'access' => [
				"class" => AccessControl::class,
				"only" => ["detail-result", "results"],
				"rules" => [
					[
						"actions" => ["detail-result", "results"],
						"allow" => true,
						"roles" => ['@']
					]
				]
			]
		];	
	}

	public function actionDetailResult($info) {
		$info = UserDt::find()
			->select(["user_id", "test_id", "correct", "wrong", "selected"])
			->where([
				'id' => $info
			])
			->one();
		if (empty($info) || $info->user_id !== Yii::$app->user->id) {
			return $this->goBack();
		}
		$test = Tests::find()
			->select(["name", "test_name"])
			->where(['id' => $info->test_id])
			->one();
		$test_name = $test->test_name;
		$rows = TestParser::getParsedData($test->name);
		$start = 0;
		for ($i = 0; $i < count($rows); $i++) {
			if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№' || $rows[$i][0] == 'TP') {
				$start = $i + 1;
			}
		}
		return $this->render("detail", [
			'info' => $info,
			'test_name' => $test_name,
			'rows' => $rows,
			'start' => $start 
		]);
	}

	public function actionResults() {
		$info = UserDt::find()
			->asArray()
			->where([
				'user_id' => Yii::$app->user->id,
			])
			->select(["id", "test_id", "date"])
			->all();
		$test_ids = array_column($info, "test_id");
		$tests = Tests::find()
			->select(["id", "test_name", "teach_id"])
			->where(["id" => $test_ids])
			->indexBy("id")
			->asArray()
			->all();
		$teach_ids = array_column($tests, "teach_id");
		$teachers = Teachers::find()
			->select(["id", "name", "surname"])
			->where(["id" => $teach_ids])
			->indexBy("id")
			->asArray()
			->all();
		return $this->render("results", [
			"info" => $info,
			"tests" => $tests,
			"teachers" => $teachers
		]);
	}
}