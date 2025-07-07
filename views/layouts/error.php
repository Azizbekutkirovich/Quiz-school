<?= $this->beginPage();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?= $this->head(); ?>
	<?php $this->registerCssFile(Yii::getAlias('@web').'/css/error.css'); ?>
</head>
<body>
	<?= $this->beginBody(); ?>
		<?=$content?>
	<?= $this->endBody(); ?>
</body>
</html>
<?= $this->endPage(); ?>