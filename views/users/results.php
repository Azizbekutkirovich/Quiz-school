<?php
	use yii\helpers\Url;
	use app\models\Tests;
	use app\models\Teachers;
	$this->title = "Mening natijalarim";
?>
<div class="container" style="margin-top: 100px;">
	<?php if (!empty($info)): ?>
	<h3 style="text-align: center;">Siz yechgan testlar: </h3>
	<div class="row">
		<?php for ($i = count($info) - 1; $i >= 0; $i--): ?>
			<?php
				$test = $tests[$info[$i]["test_id"]];
				$teacher = $teachers[$test["teach_id"]];
			?>
      	<div class="four col-md-6" id="matem" style="margin-top: 30px;">
	        <div class="counter-box" style="background-color: #34568b; border-radius: 20px;">
	          	<i class="fa-solid fa-calculator"></i>
	          	<p style="color: white;">Test muallifi: <span style="color: red;"><?=$teacher['surname']?> <?=$teacher['name']?></span></p>
	        	<h3 style="color: white; display: block;"><?=$test['test_name']?></h3>
	        	<p style="color: white;"><?=$info[$i]['date']?>da ishlab tugatilgan</p>
	        		<a href="<?=Url::to(['users/detail-result', 'info' => $info[$i]['id']])?>" class="btn btn-danger">Natijani ko'rish</a>
	        </div>
      	</div>
      <?php endfor; ?>
    </div>
	<?php else: ?>
	<h3 style="text-align: center;">Siz hali bironta ham test yechmagansiz!</h3>
	<?php endif; ?>
</div>