<?php
namespace app\controllers;
use Yii;
use app\models\Tests;
use app\models\UserDt;
use app\models\UserAnswers;
use app\models\Teachers;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\excel\TestParser;

class TestController extends Controller
{
	public function behaviors() {
		return [
			"access" => [
				"class" => AccessControl::class,
				"only" => ["test", "selecttest"],
				"rules" => [
					[
						"actions" => ["test", "selecttest"],
						"allow" => true,
						"roles" => ["@"]
					]
				]
			]
		];
	}

    public function actionTest(int $test_id) {
    	$model = new UserAnswers();
    	$test = Tests::find()
    		->select(["name", "test_name", "time"])
    		->where(['id' => $test_id])
    		->one();
    	if (empty($test)) {
    		return $this->goBack();
    	}
    	$rows = TestParser::getParsedData($test->name);
    	$start = 0;
    	$rows_count = count($rows);
    	for ($i = 0; $i < $rows_count; $i++) {
    		if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№') {
				$start = $i + 1;
			}
    	}
    	$count_tests = $rows_count - $start;
    	if ($model->load(Yii::$app->request->post())) {
    		$data = $this->checkingAnswers($start, $rows, $model->answers);
    		$saved = $this->saveUserResult($test_id, $data["correct"], $data["wrong"], $data["selected"]);
    		if ($saved["saved"]) {
    			return $this->redirect(["users/detail-result", "info" => $saved["id"]]);
    		}
    	}
    	return $this->render("test", [
    		"model" => $model,
    		"rows" => $rows,
    		"start" => $start,
    		"test_name" => $test->test_name,
    		"count_tests" => $count_tests,
    		"timer" => $test->time
    	]);
    }

    private function checkingAnswers(int $start, array $rows, array $answers) {
    	$correctArr = [];
    	$wrongArr = [];
    	$selectedArr = [];
    	for ($i = $start; $i < count($rows); $i++) {
    		$question_num = $rows[$i][0];
    		$user_answer = $answers[$question_num];
    		if (empty($user_answer)) {
    			$selectedArr[] = 'k';
    			$wrongArr[] = $question_num;
    		} else if ($user_answer === $rows[$i][2]) {
    			$selectedArr[] = $user_answer;
    			$correctArr[] = $question_num;
    		} else {
    			$selectedArr[] = $user_answer;
    			$wrongArr[] = $question_num;
    		}
    	}
    	$correct = !empty($correctArr) ? implode(",", $correctArr) : "Barchasi xato!";
    	$wrong = !empty($wrongArr) ? implode(",", $wrongArr) : "Barchasi to'g'ri!";
    	$selected = implode(",", $selectedArr);
    	return [
    		"correct" => $correct.",",
    		"wrong" => $wrong.",",
    		"selected" => $selected.","
    	];
    }

    private function saveUserResult(int $test_id, $correct, $wrong, $selected) {
    	$user_dt = new UserDt();
    	$user_dt->user_id = Yii::$app->user->id;
    	$user_dt->test_id = $test_id;
    	$user_dt->correct = $correct;
    	$user_dt->wrong = $wrong;
    	$user_dt->selected = $selected;
    	return [
    		"saved" => $user_dt->save(),
    		"id" => $user_dt->id
    	];
    }

	public function actionSelecttest($sciense) {
		$tests = Tests::find()
			->asArray()
			->select(["id", "teach_id", "test_name", "date"])
			->where([
				'school' => Yii::$app->user->identity->school,
				'class' => Yii::$app->user->identity->class,
				'job' =>  $sciense,
			])
			->all();
		if (empty($tests)) {
			return $this->render("select", [
				"tests" => $tests,
				"sciense" => $sciense
			]);
		}
		$teacher_ids = array_column($tests, "teach_id");
		$teachers = Teachers::find()
			->select(["id", "name", "surname"])
			->where(["id" => $teacher_ids])
			->indexBy("id")
			->asArray()
			->all();
		return $this->render("select", [
			"tests" => $tests,
			"teachers" => $teachers,
			"sciense" => $sciense
		]);
	}
}