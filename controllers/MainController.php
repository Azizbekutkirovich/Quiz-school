<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\TeacherForm;
use app\models\Signup;
use app\excel\SimpleXLSX;

class MainController extends Controller
{
	public function beforeAction($action) {
		Yii::$app->view->registerJs("sessionStorage.clear();");
		if (Yii::$app->session->has('selected')) {
			Yii::$app->session->remove('selected');
		}
		return parent::beforeAction($action);
	}

	public function actionIndex() {
		if (!Yii::$app->user->isGuest) {
			return $this->render("index");
		} else {
			return $this->redirect(['main/login']);
		}
	}

	public function actionLogin() {
		if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = "login";
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
	}

	public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

	public function actionRegister() {
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		$this->layout = "login";
		$model = new Signup();

		if ($model->load(Yii::$app->request->post())) {
			if (strlen($model->name) < 3) {
				Yii::$app->session->setFlash("error", "Ismingiz kamida 3ta harfdan iborat bo'lishi lozim!");
				return $this->render("register", compact("model"));
			}
			if (strlen($model->surname) < 5) {
				Yii::$app->session->setFlash("error", "Familyangiz kamida 5ta harfdan iborat bo'lishi lozim!");
				return $this->render("register", compact("model"));
			}
			if (strlen((string)$model->password) < 4) {
				Yii::$app->session->setFlash("error", "Parol kamida 4ta belgidan iborat bo'lishi kerak!");
				return $this->render("register", compact("model"));
			}
			if ($model->signup()) {
				$login = new LoginForm();
				$login->login = $model->login;
				$login->password = $model->password;
				if ($login->login()) {
					return $this->redirect(['main/index']);
				}
			}
		}

		return $this->render("register", compact("model"));
	}

	public function actionAbout() {
		if (Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		return $this->render("about");
	}

	public function actionSettings() {
		if (Yii::$app->user->isGuest) {
			return $this->goBack();
		}
		return $this->render("settings");
	}

	public function actionError() {
		$error = Yii::$app->response->statusCode;
		if ($error === 404) {
			return $this->render('error404');
		}
	}
}