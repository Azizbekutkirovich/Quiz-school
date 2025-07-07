<?php
namespace app\controllers;
use Yii;
use app\models\Questions;
use app\models\UsersBtd;
use app\models\UserDt;
use app\models\GetTest;
use yii\web\Controller;
use app\excel\SimpleXLSX;

class TestController extends Controller
{
	public function beforeAction($action)
    {
    	if (Yii::$app->user->isGuest) {
			return $this->goHome();
		}
        Yii::$app->view->registerJs('sessionStorage.clear();');
        $actionName = Yii::$app->controller->action->id;
        if ($actionName !== 'gettest' && $actionName !== 'endtest') {
        	if (Yii::$app->session->has('selected')) {
	    		Yii::$app->session->remove('selected');
			}
        }

        return parent::beforeAction($action);
    }

	public function actionGettest() {
		$model = new GetTest();
		$question_id = Yii::$app->request->get("question_id");
		$question_num = Yii::$app->request->get("question_num");
		if (empty($question_id) || empty($question_num) || !is_numeric($question_num) || $question_num[0] === '0') {
			return $this->redirect(['main/index']);
		}
		$question = Questions::findOne(['id' => $question_id]);
		if (!empty($question)) {
			$src = "./../web/tests/".$question->name;
			$excel = SimpleXLSX::parse($src);
			$rows = $excel->rows();
			$start = 0;
			for ($i = 0; $i < count($rows); $i++) {
				if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№') {
					$start = $i + 1;
				}
			}
		} else {
			return $this->redirect(['main/index']);
		}
		$count_questions = $rows[count($rows) - 1][0];
		if (empty($_SESSION['selected'])) {
			$_SESSION['selected'] = [];
			$_SESSION['selected']['question_id'] = $question_id;
		}
		if ($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();
			$user_ans = $post['GetTest']['options'];
			$selectqnum = $question_num;
			if ($user_ans === '') {
				$user_ans = 'k';
			}
			$_SESSION['selected'][$selectqnum] = $user_ans;
			if ($selectqnum == $count_questions) {
				return $this->redirect(['test/endtest']);
			} else {
				$question_num = $selectqnum + 1;
				return $this->redirect(['test/gettest', 'question_id' => $question_id, 'question_num' => $question_num]);
			}
		} else {
			$test_name = $question->test_name;
			$time = $question->time;
			if ($question_num > $count_questions) {
				return $this->redirect(['main/index']);
			}
			$question_num_new = $start + $question_num - 1;
			return $this->render("test", [
				'rows' => $rows,
				'start' => $start,
				'question_num_new' => $question_num_new,
				'question_num' => $question_num,
				'question_id' => $question_id,
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
		$question_id = $_SESSION['selected']['question_id'];
		$user_dt = new UserDt();
		$question = Questions::findOne(['id' => $question_id]);
		$src = "./../web/tests/".$question->name;
		$excel = SimpleXLSX::parse($src);
		$rows = $excel->rows();
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
		$user_dt->question_id = $question_id;
		$user_dt->correct = $correct;
		$user_dt->wrong = $wrong;
		$user_dt->selected = $selected;
		if ($user_dt->save()) {
			return $this->redirect(['users/testinfo', 'info' => $user_dt->id]);
		}
	}

	public function actionSelecttest() {
		if (empty(Yii::$app->request->get("sciense"))) {
			return $this->goHome();
		}
		$tests = Questions::find()
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