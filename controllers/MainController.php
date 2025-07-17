<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\Register;
use app\models\Users;

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

	public function actions() {
		return [
			"error" => [
				"class" => 'yii\web\ErrorAction',
				'layout' => 'error'
			]
		];
	}

	public function actionLoginProfiling() {
		$login = "Javohhh";
		$password = "Java1234";
		Yii::beginProfile("LoginProcess");

		Yii::beginProfile("Find user by login");
		$user = Users::findByLogin($login);
		Yii::endProfile("Find user by login");

		Yii::beginProfile("Validate password");
		$is_valid = $user->validatePassword($password);
		Yii::endProfile("Validate password");

		Yii::beginProfile("User Login");
		if ($is_valid) {
			Yii::$app->user->login($user);
		}
		Yii::endProfile("User Login");				

		Yii::endProfile("LoginProcess");
		return $this->renderContent($is_valid ? 'Login OK' : 'Login FAIL');
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
            'model' => $model
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

		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			$login = new LoginForm();
			$login->login = $model->login;
			$login->password = $model->password;
			if ($login->login()) {
				return $this->redirect(['main/index']);
			}
			Yii::$app->session->setFlash("login-error-in-reg-action", "Ro'yxatdan o'tish muvofaqayatli amalga oshirildi. Faqat tizimga kirishda muammo yuzaga keldi! Login va parolni kiritib tizimga kiring");
			return $this->redirect(['main/login']);
		}

		return $this->render("register", compact("model"));
	}

	public function actionAbout() {
		return $this->render("about");
	}

	public function actionSettings() {
		return $this->render("settings");
	}
}