<?php
    use yii\helpers\Html;
    use app\assets\AppAsset;
    AppAsset::register($this);
?>
<?= $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
    <style>
        body { background: blue; font-family: sans-serif; padding: 20px; }
        .error-box { background: #fff; border-left: 5px solid red; padding: 20px; }
    </style>
</head>
<body>
    <?= $this->beginBody(); ?>
    <div class="error-box">
        <?= $content ?>
    </div>
    <?= $this->endBody(); ?>
</body>
</html>
<?= $this->endPage(); ?>