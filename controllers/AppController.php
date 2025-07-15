<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
	public function beforeAction($action) {
		Yii::$app->view->registerJs("sessionStorage.clear();");
		if (Yii::$app->session->has('selected')) {
			Yii::$app->session->remove('selected');
		}
		return parent::beforeAction($action);
	}
}