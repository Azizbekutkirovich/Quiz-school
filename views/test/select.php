<?php
	use yii\helpers\Url;
	use app\models\Teachers;
    // echo '<pre>';
    //     print_r($tests);
    // echo '</pre>';
    // for ($i = count($tests) - 1; $i >= 0; $i--) {
    //     echo $tests[$i]['id'];
    // }
    // die;
?>
<div class="container" style="margin-top: 100px;">
	<?php if (!empty($tests)): ?>
	<div class="row">
		<?php for ($i = count($tests) - 1; $i >= 0; $i--): ?>
			<?php
				$teacher = Teachers::findOne(['id' => $tests[$i]['teach_id']]);
			?>
      	<div class="four col-md-6" id="matem" style="margin-top: 30px;">
	        <div class="counter-box bget" style="border-radius: 20px;">
	          	<i class="fa-solid fa-calculator"></i>
	          	<p style="color: white;">Test muallifi: <span style="color: red;"><?=$teacher->surname?> <?=$teacher->name?></span></p>
	          	<p style="color: white;"><span style="color: red;"><?=$tests[$i]['date']?></span> da yuklangan</p>
	        	<h3 style="color: white; display: block;"><?=$tests[$i]['test_name']?></h3>
	        	<!-- <br><br>
	        	<div> -->
	        		<a href="<?=Url::to(['test/gettest', 'test_id' => $tests[$i]['id'], 'test_num' => 1])?>" class="btn btn-danger">Testni boshlash</a>
	        	<!-- </div> -->
	        </div>
      	</div>
      <?php endfor; ?>
    </div>
	<?php else: ?>
		<!-- <div class="row" style="margin-top: 100px;"> -->
			<h4>Testlar mavjud emas!</h4>
			<a class="btn btn-info" href="<?=Url::to(['main/index'])?>">Ortga qaytish</a>
		<!-- </div> -->
	<?php endif; ?>
</div>
<style type="text/css">
	.product-sorting {
		-webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;
    --blue: #007bff;
    --indigo: #6610f2;
    --purple: #6f42c1;
    --pink: #e83e8c;
    --red: #dc3545;
    --orange: #fd7e14;
    --yellow: #ffc107;
    --green: #28a745;
    --teal: #20c997;
    --cyan: #17a2b8;
    --white: #fff;
    --gray: #6c757d;
    --gray-dark: #343a40;
    --primary: #007bff;
    --secondary: #6c757d;
    --success: #28a745;
    --info: #17a2b8;
    --warning: #ffc107;
    --danger: #dc3545;
    --light: #f8f9fa;
    --dark: #343a40;
    --breakpoint-xs: 0;
    --breakpoint-sm: 576px;
    --breakpoint-md: 768px;
    --breakpoint-lg: 992px;
    --breakpoint-xl: 1200px;
    --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    font-family: "helveticaneuemedium";
    font-size: 16px;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    display: flex!important;
	}
</style>