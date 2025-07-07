<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kirish</title>
	<link rel="icon" href="https://w7.pngwing.com/pngs/399/491/png-transparent-quiz-computer-icons-general-knowledge-question-others-blue-game-angle.png">
	<link rel="stylesheet" type="text/css" href="/quiz-school/css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;display=swap'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<!-- <script  src="script.js" defer></script> -->
	<?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?=$content?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="/quiz-school/js/jquery.js" type="text/javascript"></script>
<script src="/quiz-school/js/login_app.js" type="text/javascript"></script>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>