<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap5\ActiveForm;
	// $rows[0] = 0;
	// echo '<pre>';
	// 	print_r($rows);
	// echo '</pre>';
	// foreach ($rows as $r) {
	// 	echo '<pre>';
	// 		print_r($r[1]);
	// 	echo '</pre>';
	// }
	// echo $rows[count($rows) - 1][0];
	// die;
	// echo '<pre>';
	// 	print_r($rows);
	// echo '</pre>';
	// echo '<br>';
?>
<div class="container" style="margin-top: 100px;">
	<div class="alert alert-secondary" style="text-align: center;">
		<h2><?=$test_name?></h2>
	</div>
	<div id="content">
		<div class="rows">
			<h3>Test tugashigacha qolgan vaqt: <span style="color: red;" id="time"></span></h3>
		</div><br>
		<div id="info_test">
			<div class="row" id="test_circle">
				<?php for($i = $start; $i < count($rows); $i++): ?>
				<div class="test rounded-circle" id="<?=$rows[$i][0]?>" onclick="window.location='<?=Url::to(['test/gettest', 'question_id' => $question_id, 'question_num' => $rows[$i][0]])?>'" type="submit" style="text-align: center;">
					<p style="margin-top: 1vw;"><?=$rows[$i][0]?></p>
				</div>
				<?php endfor; ?>
			</div><br>
			<!-- <div id="quiz"></div> -->
			<!-- <div class='button' id='prev' style="display: inline;"><a href='#' class="btn btn-info">Ortga</a></div>
			<div class='button' id='next' style="display: inline;"><a href='#' class="btn btn-success">Keyingisi</a></div> -->
			<div class="row">
				<?php $f = ActiveForm::begin(); ?>
					<p style="font-size: 20px;"><?=$question_num?>. <?=$rows[$question_num_new][1]?></p>
					<?php echo $f->field($model, 'options')->radioList([
					    'A' => 'A) '.$rows[$question_num_new][3],
					    'B' => 'B) '.$rows[$question_num_new][4],
					    'C' => 'C) '.$rows[$question_num_new][5],
					    'D' => 'D) '.$rows[$question_num_new][6]
					])->label(false);?>
					<?php if ($question_num !== '1'): ?>
						<a class="btn btn-info btn-lg" href="<?=Url::to(['test/gettest', 'question_id' => $question_id, 'question_num' => $question_num - 1])?>">Ortga</a>
					<?php endif; ?>
					<?php if($question_num != $rows[count($rows) - 1][0]): ?>
						<?= Html::submitButton("Keyingisi", ['class' => 'btn btn-success btn-lg']); ?>
					<?php else: ?>
						<?= Html::submitButton("Testni tugatish", ['class' => 'btn btn-success btn-lg']); ?>
					<?php endif; ?>
					<?php 
						if (!empty($_SESSION['selected']) && !empty($_SESSION['selected'][$question_num]) && $_SESSION['selected'][$question_num] !== 'k') {
							if ($_SESSION['selected'][$question_num] === 'A') {
								echo "<script>document.querySelector('#i0').checked = true;</script>";
							} else if ($_SESSION['selected'][$question_num] === 'B') {
								echo "<script>document.querySelector('#i1').checked = true;</script>";
							} else if ($_SESSION['selected'][$question_num] === 'C') {
								echo "<script>document.querySelector('#i2').checked = true;</script>";
							} else {
								echo "<script>document.querySelector('#i3').checked = true;</script>";
							}
						}
					?>
				<?php ActiveForm::end(); ?>
			</div>
			<br>
			<?php if ($question_num != $rows[count($rows) - 1][0]): ?>
				<a class="btn btn-primary btn-lg" href="<?=Url::to(['test/endtest'])?>">Testni tugatish</a>
			<?php endif; ?>
			<br><br><br>
		</div>
	</div>
</div>
<?php
	if (!empty($_SESSION['selected'])) {
		for ($i = $start; $i < count($rows); $i++) {
			$num = $rows[$i][0];
			if (!empty($_SESSION['selected'][$num]) && $_SESSION['selected'][$num] !== 'k') {
				echo "<script>
					var question_num_div = document.getElementById('".$num."');

					question_num_div.style.backgroundColor = '#3498db';
				</script>";
			}
		}
	}
?>
<br>
<style type="text/css">
	.test {
	  width: 50px;
	  height: 50px;
	  box-shadow: inset 0 0 5px #000000, 0 0 5px #000000;
	  display: inline;
	}
	.activ {
		background-color: orange;
	}
	.selected {
		background-color: blue;
	}
</style>
<script type="text/javascript">
	let num = document.getElementById('<?=$question_num?>');

	num.style.border = "2px solid #fc0202";

	var initialTime = <?=$time?> * 60;

	// Check if there is any stored time in sessionStorage
	var timeLeft = parseInt(sessionStorage.getItem('timeLeft<?=$question_id?>')) || initialTime;

	function updateTimer() {
	    var minutes = Math.floor(timeLeft / 60);
	    var seconds = timeLeft % 60;
	    document.getElementById("time").innerHTML = minutes + ":" + seconds;

	    if (timeLeft <= 0) {
	        clearInterval(timerInterval);
	        alert("Vaqt tugadi!");
	        window.location = 'http://localhost/quiz-school/test/endtest'
	    } else {
	        timeLeft--;
	        // Save the current state of the timer in sessionStorage
	        sessionStorage.setItem('timeLeft<?=$question_id?>', timeLeft);
	    }
	}

	// Start the countdown
	var timerInterval = setInterval(updateTimer, 1000);

	window.addEventListener('popstate', function() {
	    sessionStorage.removeItem('timeLeft<?=$question_id?>');
	});	
</script>