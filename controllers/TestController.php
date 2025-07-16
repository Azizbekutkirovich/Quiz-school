<?php
namespace app\controllers;
use Yii;
use app\models\Tests;
use app\models\UserDt;
use app\models\UserAnswers;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\excel\TestParser;

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

    public function actionTest(int $test_id) {
    	$model = new UserAnswers();
    	$test = Tests::findOne(['id' => $test_id]);
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
    		$correct = "";
    		$wrong = "";
    		$selected = "";
    		for ($i = $start; $i < count($rows); $i++) {
    			$question_num = $rows[$i][0];
    			$user_answer = $model->answers[$question_num];
    			if (empty($user_answer)) {
    				$selected .= "k,";
    				$wrong .= $question_num.",";
    			} else if ($user_answer === $rows[$i][2]) {
    				$selected .= $user_answer.",";
    				$correct .= $question_num.",";
    			} else {
    				$selected .= $user_answer.",";
    				$wrong .= $question_num.",";
    			}
    		}
    		if (empty($correct)) {
    			$correct = "Barchasi xato!";
    		}
    		if (empty($wrong)) {
    			$wrong = "Barchasi to'g'ri!";
    		}
    		$user_dt = new UserDt();
    		$user_dt->user_id = Yii::$app->user->id;
			$user_dt->test_id = $test_id;
			$user_dt->correct = $correct;
			$user_dt->wrong = $wrong;
			$user_dt->selected = $selected;
			if ($user_dt->save()) {
				return $this->redirect(['users/detail-result', 'info' => $user_dt->id]);
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

	public function actionSelecttest($sciense) {
		$tests = Tests::find()
			->asArray()
			->where([
				'school' => Yii::$app->user->identity->school,
				'class' => Yii::$app->user->identity->class,
				'job' =>  $sciense,
			])
			->all();
		return $this->render("select", [
			"tests" => $tests,
			"sciense" => $sciense
		]);
	}
}