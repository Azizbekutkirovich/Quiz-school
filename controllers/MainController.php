<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\Register;

class MainController extends Controller
{
	public function behaviors() {
		return [
			'access' => [
				"class" => AccessControl::class,
                'only' => ['index', 'login', 'register', 'logout', 'about', 'settings'],
                'rules' => [
                    [
                        'actions' => ['index', 'about', 'settings', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
			],
		];
	}

	public function beforeAction($action) {
		Yii::$app->view->registerJs("sessionStorage.clear();");
		if (Yii::$app->session->has('selected')) {
			Yii::$app->session->remove('selected');
		}
		return parent::beforeAction($action);
	}

	public function actionIndex() {
		return $this->render("index");
	}

	public function actionLogin() {
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
		$this->layout = "login";
		$model = new Register();

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
		return $this->render("about");
	}

	public function actionSettings() {
		return $this->render("settings");
	}

	public function actionError() {
		$error = Yii::$app->response->statusCode;
		if ($error === 404) {
			return $this->render('error404');
		}
	}
}