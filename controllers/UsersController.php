<?php
namespace app\controllers;

use Yii;
use app\models\Questions;
use app\models\UserDt;
use yii\web\Controller;
use app\excel\SimpleXLSX;

class UsersController extends Controller
{
	public function beforeAction($action) {
		if (Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		Yii::$app->view->registerJs("sessionStorage.clear();");
		if (Yii::$app->session->has('selected')) {
			Yii::$app->session->remove('selected');
		}
		return parent::beforeAction($action);
	}

	public function actionTestinfo() {
		$id = Yii::$app->request->get("info");
		$info = UserDt::findOne([
			'id' => $id
		]);
		if (empty($info) || $info->user_id !== Yii::$app->user->identity->id) {
			return $this->goBack();
		}
		$question = Questions::findOne(['id' => $info->question_id]);
		$src = "./../web/tests/".$question->name;
		$excel = SimpleXLSX::parse($src);
		$rows = $excel->rows();
		$start = 0;
		for ($i = 0; $i < count($rows); $i++) {
			if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№' || $rows[$i][0] == 'TP') {
				$start = $i + 1;
			}
		}
		$test_name = $question->test_name;
		return $this->render("info", [
			'info' => $info,
			'test_name' => $test_name,
			'rows' => $rows,
			'start' => $start 
		]);
	}

	public function actionSelect() {
		$info = UserDt::find()
			->asArray()
			->where([
				'user_id' => Yii::$app->user->identity->id,
			])
			->all();
		return $this->render("select", compact("info"));
	}
}