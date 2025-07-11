<?php
namespace app\controllers;

use Yii;
use app\models\Tests;
use app\models\UserDt;
use yii\web\Controller;
use app\excel\SimpleXLSX;
use yii\filters\AccessControl;

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

	public function beforeAction($action) {
		Yii::$app->view->registerJs("sessionStorage.clear();");
		if (Yii::$app->session->has('selected')) {
			Yii::$app->session->remove('selected');
		}
		return parent::beforeAction($action);
	}

	public function actionDetailResult($info) {
		$info = UserDt::findOne([
			'id' => $info
		]);
		if (empty($info) || $info->user_id !== Yii::$app->user->identity->id) {
			return $this->goBack();
		}
		$test = Tests::findOne(['id' => $info->test_id]);
		$cache_key = "cache_".$test->name;
		$rows = json_decode(Yii::$app->cache->get($cache_key));
		if (!isset($rows)) {
			$src = "./../web/tests/".$test->name;
			$excel = SimpleXLSX::parse($src);
			$rows = $excel->rows();
			Yii::$app->cache->set($cache_key, json_encode($rows), 3600);
		}
		$start = 0;
		for ($i = 0; $i < count($rows); $i++) {
			if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№' || $rows[$i][0] == 'TP') {
				$start = $i + 1;
			}
		}
		$test_name = $test->test_name;
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
				'user_id' => Yii::$app->user->identity->id,
			])
			->all();
		return $this->render("results", compact("info"));
	}
}