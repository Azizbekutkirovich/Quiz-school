<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use app\assets\AppAsset;
	AppAsset::register($this);
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <?php $this->head(); ?>
</head>
<body id="body-pd">
<?php $this->beginBody(); ?>
<div id="preloder">
    <div class="loader"></div>
</div>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="<?=Url::home()?>" class="nav__logo"><span style="color: gold;">Quiz</span><span style="color: red;">-school</span>.uz</a>

            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a id="home" href="<?=Url::to(['main/index'])?>" class="nav__link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                          <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                        </svg>
                            <span class="nav__name" style="font-size: 13px;">Bosh sahifa</span>
                        </a>
                    </li>
                    
                    <li class="nav__item">
                        <a id="info" href="<?=Url::to(['users/results'])?>" class="nav__link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
                            </svg>
                            <span class="nav__name" style="font-size: 13px;">Mening natijalarim</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a id="about" href="<?=Url::to(['main/settings'])?>" class="nav__link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                        </svg>
                            <span class="nav__name" style="font-size: 13px;">Sozlamalar</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!--<img style="width: 70px; height: 70px; border-radius: 20px;" src="https://img.favpng.com/17/0/10/flat-design-vector-graphics-test-portable-network-graphics-png-favpng-51KGUKYzw0m5DdgaPMPR7M8Qa.jpg" alt="">-->
        </nav>
    </header>
    <?=$content?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
