<?php
	$this->title = "Batafsil ma'lumot";
	$correct = $info->correct !== 'Barchasi xato!' ? explode(",", $info->correct) : 0;
	$wrong = $info->wrong !== "Barchasi to'g'ri!" ? explode(",", $info->wrong) : 0;
	$selected = explode(",", $info->selected);
	$correct_count = $correct !== 0 ? count($correct) - 1 : 0;
	$wrong_count = $wrong !== 0 ? count($wrong) - 1 : 0;
	$skip_count = 0;
	for ($i = 0; $i < count($selected); $i++) {
		if ($selected[$i] === 'k') {
			$skip_count += 1;
		}
	}
	$question_count = count($selected) - 1;
	$percent = floor($correct_count * 100 / $question_count);
?>
<div class="container" style="margin-top: 100px;">
	<h2 style="text-align: center;">Siz <span style="color: blue;"><?php echo count($rows) - $start; ?></span> ta savoldan <span style="color: blue;"><?=$correct_count?></span> tasiga to'g'ri javob berdingiz. Foiz ko'rsatkichi <span style="color: blue;"><?=$percent?>%</span></h2>
	<div class="alert alert-secondary" style="text-align: center;">
		<h4 style="display: inline;"><?=$test_name?></h4>
	</div>
	<?php if ($correct_count !== 0): ?>
		<h3 style="color: green;">Siz to'g'ri javob berganlar: </h3>
		<?php for ($i = 0; $i < count($correct) - 1; $i++): ?>
			<?php
				$question_num_new = $start + intval($correct[$i]) - 1;
			?>
			<p style='font-size: 20px;'><?=$rows[$question_num_new][0]?>-savol: <?=$rows[$question_num_new][1]?></p>
			<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>A">A) <?=$rows[$question_num_new][3]?></div>
			<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>B">B) <?=$rows[$question_num_new][4]?></div>
			<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>C">C) <?=$rows[$question_num_new][5]?></div>
			<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>D">D) <?=$rows[$question_num_new][6]?></div>
		<?php endfor; ?>
		<br><br>
	<?php endif; ?>
	<?php if ($wrong_count !== 0 && $wrong_count !== $skip_count): ?>
		<h3 style="color: red;">Siz noto'g'ri javob berganlar: </h3>
		<?php for ($i = 0; $i < count($wrong) - 1; $i++): ?>
			<?php if ($selected[$wrong[$i] - 1] !== 'k'): ?>
				<?php
					$question_num_new = $start + intval($wrong[$i]) - 1;
				?>
				<p style='font-size: 20px;'><?=$rows[$question_num_new][0]?>-savol: <?=$rows[$question_num_new][1]?></p>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>A">A) <?=$rows[$question_num_new][3]?></div>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>B">B) <?=$rows[$question_num_new][4]?></div>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>C">C) <?=$rows[$question_num_new][5]?></div>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>D">D) <?=$rows[$question_num_new][6]?></div>
			<?php endif; ?>
		<?php endfor; ?>
		<br><br>
	<?php endif; ?>
	<?php if ($skip_count !== 0): ?>
		<h3 style="color: blue;">Siz javob bermagan savollar: </h3>
		<?php for ($i = 0; $i < count($wrong) - 1; $i++): ?>
			<?php if ($selected[$wrong[$i] - 1] === 'k'): ?>
				<?php
					$question_num_new = $start + intval($wrong[$i]) - 1;
				?>
				<p style='font-size: 20px;'><?=$rows[$question_num_new][0]?>-savol: <?=$rows[$question_num_new][1]?></p>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>A">A) <?=$rows[$question_num_new][3]?></div>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>B">B) <?=$rows[$question_num_new][4]?></div>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>C">C) <?=$rows[$question_num_new][5]?></div>
				<div class='alert alert-dark' id="<?=$rows[$question_num_new][0]?>D">D) <?=$rows[$question_num_new][6]?></div>
			<?php endif; ?>
		<?php endfor; ?>
	<?php endif; ?>
</div><br><br><br>
<script type="text/javascript">
	function addTrueImage(div) {
		var div1 = document.getElementById(div);
		var image = div1.getElementsByTagName("img")[0]; 
      	if (image) {
      		div1.removeChild(image)
      	}
      	div1.innerHTML += '<img style="width: 50px; height: 50px;" src="./../../web/images/check-mark.png">';
    }

    function addFalseImage(div) {
    	var div2 = document.getElementById(div);
    	div2.innerHTML += '<img style="width: 50px; height: 50px;" src="./../../web/images/cancel.png">';
    }
</script>
<?php
	for ($i = 0; $i < count($selected) - 1; $i++) {
		$test_num = (string) $i + 1;
		if ($selected[$i] !== 'k') {
			$id = $test_num.$selected[$i];
			echo "<script>
					document.getElementById('$id').classList.remove('alert-dark');
					document.getElementById('$id').classList.add('alert-danger');
					addFalseImage('$id')	
				</script>";
		}
	}
	for ($i = $start; $i < count($rows); $i++) {
		$id = $rows[$i][0].$rows[$i][2];
		echo "<script>
				document.getElementById('$id').classList.remove('alert-danger');
				document.getElementById('$id').classList.remove('alert-dark');
				document.getElementById('$id').classList.add('alert-success');
				addTrueImage('$id')
			</script>";
	}
?>