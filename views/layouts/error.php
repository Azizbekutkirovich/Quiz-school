<?php
    use yii\helpers\Html;
?>
<?= $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
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