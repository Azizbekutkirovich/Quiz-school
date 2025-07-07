<?php
	use yii\helpers\Url;
	use app\excel\SimpleXLSX;
	$excel = SimpleXLSX::parse($src);
	$rows = $excel->rows();
	// echo '<pre>';
	// 	print_r($rows);
	// echo '</pre>';
	// die;
	$start = 0;
	for ($i = 0; $i < count($rows); $i++) {
		if ($rows[$i][0] == 'T/r' || $rows[$i][0] == '№' || $rows[$i][0] == 'TP') {
			$start = $i + 1;
		} else if ($rows[$i][1] == 'Savollar' || $rows[$i][1] == 'Savol') {
			$start = $i + 1;
		}
	}
?>
<div class="container" style="margin-top: 100px;">
	<?php
		$count = 0;
		for ($i = 0; $i < strlen($info->correct); $i++) {
			if ($info->correct[$i] == ',') {
				$count++;
			}
		}
	?>
	<h2 style="text-align: center;">Siz <span style="color: red;"><?php echo count($rows) - $start; ?> ta savoldan <?=$count?>tasiga</span> to'g'ri javob berdingiz</h2>
	<div class="alert alert-secondary" style="text-align: center;">
		<h4 style="display: inline;"><?=$test_name?></h4>
	</div>
	<?php
		$question_info = "";
		for ($i = 0; $i < strlen($info->selected); $i++) {
			if ($i == 0 || $i % 2 == 0) {
				$question_info .= $info->selected[$i];
			}
		}
		$ok = true;
		$tek = count($rows) - $start;
		if (strlen($question_info) != $tek) {
			$ok = false;
		}
	?>
	<?php for ($i = $start; $i < count($rows); $i++): ?>
		<?php if ($info->correct != '0'): ?> 
			<?php for ($j = 0; $j < strlen($info->correct); $j++): ?>
			 	<?php if ($info->correct[$j] != ',' && $info->correct[$j + 1] != ','): ?>
					<?php
						$n = $info->correct[$j].$info->correct[$j + 1];
					?>
					<?php if ($rows[$i]['0'] == $n): ?>
						<p style='font-size: 20px;'><?=$rows[$i]['0']?>-savol: <?=$rows[$i][1]?></p>
						<?php if ($rows[$i][2] == '1'): ?>
							<div class='alert alert-success'><?=$rows[$i][3]?></div>
							<div class='alert alert-dark'><?=$rows[$i][4]?></div>
							<div class='alert alert-dark'><?=$rows[$i][5]?></div>
							<div class='alert alert-dark'><?=$rows[$i][6]?></div>
						<?php elseif ($rows[$i][2] == '2'): ?>
							<div class='alert alert-dark'><?=$rows[$i][3]?></div>
							<div class='alert alert-success'><?=$rows[$i][4]?></div>
							<div class='alert alert-dark'><?=$rows[$i][5]?></div>
							<div class='alert alert-dark'><?=$rows[$i][6]?></div>
						<?php elseif ($rows[$i][2] == '3'): ?>
							<div class='alert alert-dark'><?=$rows[$i][3]?></div>
							<div class='alert alert-dark'><?=$rows[$i][4]?></div>
							<div class='alert alert-success'><?=$rows[$i][5]?></div>
							<div class='alert alert-dark'><?=$rows[$i][6]?></div>
						<?php elseif($rows[$i][2] == '4'): ?>								
							<div class='alert alert-dark'><?=$rows[$i][3]?></div>
							<div class='alert alert-dark'><?=$rows[$i][4]?></div>
							<div class='alert alert-dark'><?=$rows[$i][5]?></div>
							<div class='alert alert-success'><?=$rows[$i][6]?></div>
						<?php endif; ?>
						<?php
							break;
						?>
					<?php endif; ?>
				<?php elseif ($info->correct[$j - 1] == ',' && $info->correct[$j] != ',' && $info->correct[$j + 1] == ','): ?>
					<?php if ($rows[$i][0] == $info->correct[$j]): ?>
						<p style='font-size: 20px;'><?=$info->correct[$j]?>-savol: <?=$rows[$i][1]?></p>
						<?php if ($rows[$i][2] == '1'): ?>
							<div class='alert alert-success'><?=$rows[$i][3]?></div>
							<div class='alert alert-dark'><?=$rows[$i][4]?></div>
							<div class='alert alert-dark'><?=$rows[$i][5]?></div>
							<div class='alert alert-dark'><?=$rows[$i][6]?></div>
						<?php elseif ($rows[$i][2] == '2'): ?>
							<div class='alert alert-dark'><?=$rows[$i][3]?></div>
							<div class='alert alert-success'><?=$rows[$i][4]?></div>
							<div class='alert alert-dark'><?=$rows[$i][5]?></div>
							<div class='alert alert-dark'><?=$rows[$i][6]?></div>
						<?php elseif ($rows[$i][2] == '3'): ?>
							<div class='alert alert-dark'><?=$rows[$i][3]?></div>
							<div class='alert alert-dark'><?=$rows[$i][4]?></div>
							<div class='alert alert-success'><?=$rows[$i][5]?></div>
							<div class='alert alert-dark'><?=$rows[$i][6]?></div>
						<?php elseif($rows[$i][2] == '4'): ?>
							<div class='alert alert-dark'><?=$rows[$i][3]?></div>
							<div class='alert alert-dark'><?=$rows[$i][4]?></div>
							<div class='alert alert-dark'><?=$rows[$i][5]?></div>
							<div class='alert alert-success'><?=$rows[$i][6]?></div>
						<?php endif; ?>
						<?php
							break;
						?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endfor; ?>
		<?php endif; ?>
		<?php if ($info->wrong != '0'): ?>
			<?php for ($k = 0; $k < strlen($info->wrong); $k++): ?>
				<?php if ($info->wrong[$k - 1] == ',' && $info->wrong[$k] != ',' && $info->wrong[$k + 1] == ','): ?>
					<?php if ($rows[$i][0] == $info->wrong[$k]): ?>
						<?php if ($ok == true): ?>
							<?php
								$question_n = (int) $rows[$i]['0'];
								$num = $question_n - 1;
								$user_select = (int) $question_info[$num];
							?>
							<!-- 0,0,2,0,2,0,1,2,1,2 -->
							<!-- 0020201212 -->
							<p style='font-size: 20px;'><?=$rows[$i][0]?>-savol: <?=$rows[$i][1]?></p>
							<?php if ($user_select == '0' && $rows[$i][2] == '2'): ?>
								<div class="alert alert-danger"><?=$rows[$i][3]?></div>
								<div class="alert alert-success"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '0' && $rows[$i][2] == '3'): ?>
								<div class="alert alert-danger"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-success"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '0' && $rows[$i][2] == '4'): ?>
								<div class="alert alert-danger"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-success"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '1' && $rows[$i][2] == '1'): ?>
								<div class="alert alert-success"><?=$rows[$i][3]?></div>
								<div class="alert alert-danger"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '1' && $rows[$i][2] == '3'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-danger"><?=$rows[$i][4]?></div>
								<div class="alert alert-success"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '1' && $rows[$i][2] == '4'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-danger"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-success"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '2' && $rows[$i][2] == '1'): ?>
								<div class="alert alert-success"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-danger"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '2' && $rows[$i][2] == '2'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-success"><?=$rows[$i][4]?></div>
								<div class="alert alert-danger"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '2' && $rows[$i][2] == '4'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-danger"><?=$rows[$i][5]?></div>
								<div class="alert alert-success"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '3' && $rows[$i][2] == '1'): ?>
								<div class="alert alert-success"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-danger"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '3' && $rows[$i][2] == '2'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-success"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-danger"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '3' && $rows[$i][2] == '3'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-success"><?=$rows[$i][5]?></div>
								<div class="alert alert-danger">
									<?=$rows[$i][6]?>	
									</div>
							<?php endif; ?>
							<?php
								break;
							?>
						<?php else: ?>
							<h3>Siz ushbu savolga javob bermagansiz!</h3>
							<p style='font-size: 20px;'><?=$rows[$i][0]?>-savol: <?=$rows[$i][1]?></p>
							<?php if ($rows[$i][2] == '1'): ?>
								<div class='alert alert-success'><?=$rows[$i][3]?></div>
								<div class='alert alert-dark'><?=$rows[$i][4]?></div>
								<div class='alert alert-dark'><?=$rows[$i][5]?></div>
								<div class='alert alert-dark'><?=$rows[$i][6]?></div>
							<?php elseif ($rows[$i][2] == '2'): ?>
								<div class='alert alert-dark'><?=$rows[$i][3]?></div>
								<div class='alert alert-success'><?=$rows[$i][4]?></div>
								<div class='alert alert-dark'><?=$rows[$i][5]?></div>
								<div class='alert alert-dark'><?=$rows[$i][6]?></div>
							<?php elseif ($rows[$i][2] == '3'): ?>
								<div class='alert alert-dark'><?=$rows[$i][3]?></div>
								<div class='alert alert-dark'><?=$rows[$i][4]?></div>
								<div class='alert alert-success'><?=$rows[$i][5]?></div>
								<div class='alert alert-dark'><?=$rows[$i][6]?></div>
							<?php elseif($rows[$i][2] == '4'): ?>
								<div class='alert alert-dark'><?=$rows[$i][3]?></div>
								<div class='alert alert-dark'><?=$rows[$i][4]?></div>
								<div class='alert alert-dark'><?=$rows[$i][5]?></div>
								<div class='alert alert-success'><?=$rows[$i][6]?></div>
							<?php endif; ?>
							<?php
								break;
							?>
						<?php endif; ?>
					<?php endif; ?>
				<?php elseif ($info->wrong[$k] != ',' && $info->wrong[$k + 1] != ','): ?>
					<?php
						$wrong_num = $info->wrong[$k].$info->wrong[$k + 1];
					?>
					<?php if ($rows[$i]['0'] == $wrong_num): ?>
						<?php if ($ok == true): ?>
							<?php
								$question_n = (int) $rows[$i]['0'];
								$num = $question_n - 1;
								$user_select = (int) $question_info[$num];
							?>
							<!-- 0,0,2,0,2,0,1,2,1,2 -->
							<!-- 0020201212 -->
							<p style='font-size: 20px;'><?=$rows[$i][0]?>-savol: <?=$rows[$i][1]?></p>
							<?php if ($user_select == '0' && $rows[$i][2] == '2'): ?>
								<div class="alert alert-danger"><?=$rows[$i][3]?></div>
								<div class="alert alert-success"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '0' && $rows[$i][2] == '3'): ?>
								<div class="alert alert-danger"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-success"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '0' && $rows[$i][2] == '4'): ?>
								<div class="alert alert-danger"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-success"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '1' && $rows[$i][2] == '1'): ?>
								<div class="alert alert-success"><?=$rows[$i][3]?></div>
								<div class="alert alert-danger"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '1' && $rows[$i][2] == '3'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-danger"><?=$rows[$i][4]?></div>
								<div class="alert alert-success"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '1' && $rows[$i][2] == '4'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-danger"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-success"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '2' && $rows[$i][2] == '1'): ?>
								<div class="alert alert-success"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-danger"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '2' && $rows[$i][2] == '2'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-success"><?=$rows[$i][4]?></div>
								<div class="alert alert-danger"><?=$rows[$i][5]?></div>
								<div class="alert alert-dark"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '2' && $rows[$i][2] == '4'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-danger"><?=$rows[$i][5]?></div>
								<div class="alert alert-success"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '3' && $rows[$i][2] == '1'): ?>
								<div class="alert alert-success"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-danger"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '3' && $rows[$i][2] == '2'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-success"><?=$rows[$i][4]?></div>
								<div class="alert alert-dark"><?=$rows[$i][5]?></div>
								<div class="alert alert-danger"><?=$rows[$i][6]?></div>
							<?php elseif ($user_select == '3' && $rows[$i][2] == '3'): ?>
								<div class="alert alert-dark"><?=$rows[$i][3]?></div>
								<div class="alert alert-dark"><?=$rows[$i][4]?></div>
								<div class="alert alert-success"><?=$rows[$i][5]?></div>
								<div class="alert alert-danger"><?=$rows[$i][6]?></div>
							<?php endif; ?>
							<?php
								break;
							?>
						<?php else: ?>
							<h3>Siz ushbu savolga javob bermagansiz!</h3>
							<p style='font-size: 20px;'><?=$rows[$i][0]?>-savol: <?=$rows[$i][1]?></p>
							<?php if ($rows[$i][2] == '1'): ?>
								<div class='alert alert-success'><?=$rows[$i][3]?></div>
								<div class='alert alert-dark'><?=$rows[$i][4]?></div>
								<div class='alert alert-dark'><?=$rows[$i][5]?></div>
								<div class='alert alert-dark'><?=$rows[$i][6]?></div>
							<?php elseif ($rows[$i][2] == '2'): ?>
								<div class='alert alert-dark'><?=$rows[$i][3]?></div>
								<div class='alert alert-success'><?=$rows[$i][4]?></div>
								<div class='alert alert-dark'><?=$rows[$i][5]?></div>
								<div class='alert alert-dark'><?=$rows[$i][6]?></div>
							<?php elseif ($rows[$i][2] == '3'): ?>
								<div class='alert alert-dark'><?=$rows[$i][3]?></div>
								<div class='alert alert-dark'><?=$rows[$i][4]?></div>
								<div class='alert alert-success'><?=$rows[$i][5]?></div>
								<div class='alert alert-dark'><?=$rows[$i][6]?></div>
							<?php elseif($rows[$i][2] == '4'): ?>
								<div class='alert alert-dark'><?=$rows[$i][3]?></div>
								<div class='alert alert-dark'><?=$rows[$i][4]?></div>
								<div class='alert alert-dark'><?=$rows[$i][5]?></div>
								<div class='alert alert-success'><?=$rows[$i][6]?></div>
							<?php endif; ?>
							<?php
								break;
							?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endfor; ?>
		<?php endif; ?>
	<?php endfor; ?>
	<!-- <div class="alert alert-dark"><input type="radio" name="answer" value="0">a*b</div> -->
</div>