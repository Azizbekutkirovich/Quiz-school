<?php

use app\assets\LoginAsset;
use yii\helpers\Html;

LoginAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
	<title><?= Html::encode($this->title) ?></title>
	<link rel="icon" href="https://w7.pngwing.com/pngs/399/491/png-transparent-quiz-computer-icons-general-knowledge-question-others-blue-game-angle.png">
	<?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?=$content?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>