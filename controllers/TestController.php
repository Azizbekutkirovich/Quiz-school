<?php
namespace app\controllers;
use Yii;
use app\models\Tests;
use app\models\UserDt;
use app\models\GetTest;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\excel\SimpleXLSX;

class TestController extends Controller
{
	public function behaviors() {
		return [
			"access" => [
				"class" => AccessControl::class,
				"only" => ["gettest", "endtest", "selecttest"],
				"rules" => [
					[
						"actions" => ["gettest", "endtest", "selecttest"],
						"allow" => true,
						"roles" => ["@"] 
					]
				]
			]
		];
	}

	public function beforeAction($action)
    {
    	Yii::$app->view->registerJs("sessionStorage.clear();");
        $actionName = Yii::$app->controller->action->id;
        if ($actionName !== 'gettest' && $actionName !== 'endtest') {
        	if (Yii::$app->session->has('selected')) {
	    		Yii::$app->session->remove('selected');
			}
        }
        return parent::beforeAction($action);
    }

	public function actionGettest(int $test_id, int $test_num) {
		$model = new GetTest();
		$test = Tests::findOne(['id' => $test_id]);
		if (empty($test)) {
			return $this->redirect(['main/index']);
		}
		$parsing_cache_key = "cache_".$test->name;
		$rows = json_decode(Yii::$app->cache->get($parsing_cache_key));
		if (!isset($rows)) {
			$src = "./../web/tests/".$test->name;
			$excel = SimpleXLSX::parse($src);
			$rows = $excel->rows();
			Yii::$app->cache->set($parsing_cache_key, json_encode($rows), 3600);
		}
		$start = 0;
		for ($i = 0; $i < count($rows); $i++) {
			if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№') {
				$start = $i + 1;
			}
		}
		$count_tests = $rows[count($rows) - 1][0];
		if (empty($_SESSION['selected'])) {
			$_SESSION['selected'] = [];
			$_SESSION['selected']['test_id'] = $test_id;
		}
		if ($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();
			$user_ans = $post['GetTest']['options'];
			$selected_test_number = $test_num;
			if ($user_ans === '') {
				$user_ans = 'k';
			}
			$_SESSION['selected'][$selected_test_number] = $user_ans;
			if ($selected_test_number == $count_tests) {
				return $this->redirect(['test/endtest']);
			} else {
				$test_num = $selected_test_number + 1;
				return $this->redirect(['test/gettest', 'test_id' => $test_id, 'test_num' => $test_num]);
			}
		} else {
			$test_name = $test->test_name;
			$time = $test->time;
			if ($test_num > $count_tests) {
				return $this->redirect(['main/index']);
			}
			$test_num_new = $start + $test_num - 1;
			return $this->render("test", [
				'rows' => $rows,
				'start' => $start,
				'test_num_new' => $test_num_new,
				'test_num' => $test_num,
				'test_id' => $test_id,
				'test_name' => $test_name,
				'time' => $time,
				'model' => $model
			]);
		}
	}

	public function actionEndtest() {
		if (empty($_SESSION['selected'])) {
			return $this->goBack();
		}
		$test_id = $_SESSION['selected']['test_id'];
		$user_dt = new UserDt();
		$test = Tests::findOne(['id' => $test_id]);
		$parsing_cache_key = "cache_".$test->name;
		$rows = json_decode(Yii::$app->cache->get($parsing_cache_key));
		if (!isset($rows)) {
			$src = "./../web/tests/".$test->name;
			$excel = SimpleXLSX::parse($src);
			$rows = $excel->rows();
			Yii::$app->cache->set($parsing_cache_key, json_encode($rows), 3600);
		}
		$correct = "";
		$wrong = "";
		$selected = "";
		$start = 0;
		for ($i = 0; $i < count($rows); $i++) {
			if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№') {
				$start = $i + 1;
			}
		}
		for ($i = $start; $i < count($rows); $i++) {
			if (empty($_SESSION['selected'][$rows[$i][0]]) || $_SESSION['selected'][$rows[$i][0]] === 'k') {
				$wrong .= $rows[$i][0].',';
				$selected .= 'k,';
			} else {
				if ($_SESSION['selected'][$rows[$i][0]] == $rows[$i][2]) {
					$correct .= $rows[$i][0].',';
					$selected .= $_SESSION['selected'][$rows[$i][0]].',';
				} else {
					$wrong .= $rows[$i][0].',';
					$selected .= $_SESSION['selected'][$rows[$i][0]].',';
				}
			}
		}
		if (empty($correct)) {
			$correct = "Barchasi xato!";
		}
		if (empty($wrong)) {
			$wrong = "Barchasi to'g'ri!";
		}
		$user_dt->user_id = Yii::$app->user->id;
		$user_dt->test_id = $test_id;
		$user_dt->correct = $correct;
		$user_dt->wrong = $wrong;
		$user_dt->selected = $selected;
		if ($user_dt->save()) {
			return $this->redirect(['users/detail-result', 'info' => $user_dt->id]);
		}
	}

	public function actionSelecttest() {
		if (empty(Yii::$app->request->get("sciense"))) {
			return $this->goHome();
		}
		$tests = Tests::find()
			->asArray()
			->where([
				'school' => Yii::$app->user->identity->school,
				'class' => Yii::$app->user->identity->class,
				'job' =>  Yii::$app->request->get("sciense"),
			])
			->all();
		return $this->render("select", compact("tests"));
	}
}