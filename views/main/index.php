<?php
	use yii\helpers\Url;
  // use yii\widgets\Pjax;
  // $ans = "";
  // for ($i = 0; $i < 4; $i++)  {
  //   $ans .= $i.',';
  // }
  // echo $ans;
  // die;
  // $content = "1, 2";
  // $num = 1;
  // $ans = $num.",";
  // $num2 = 2;
  // $ans1 = $num2.",";
  // $content = $ans.$ans1;
?>
<div class="container">
	<h3 style="text-align: center; margin-top: 10vw;">Xush kelibsiz <span style="color: red;"><?=Yii::$app->user->identity->surname?> <?=Yii::$app->user->identity->name?></span></h3>
	<h4 style="text-align: center;">Siz qaysi <span style="color: orange;">fan</span>dan test ishlashni xohlaysiz</h4>
	<div class="row">
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'matematika'])?>" id="matem" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #34568b; border-radius: 20px;">
          <i class="fa-solid fa-calculator"></i>
          <img src="<?=Url::base()?>/images/matematika.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">MATEMATIKA</p>
        </div>
      </a>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'fizika'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #6B5B95; border-radius: 20px;">
          <i class="fa-solid fa-atom"></i>
          <img src="<?=Url::base()?>/images/fizika.png" style="width: 100px; height: 100px; border-radius: 50px;">
          <p style="font-size: 20px; color: white;">FIZIKA</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'ona tili'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #FF6F61; border-radius: 20px;">
          <i class="fa-solid fa-pen"></i>
          <img src="<?=Url::base()?>/images/onatili.avif" style="width: 100px; height: 100px; border-radius: 50px;">
          <p style="font-size: 20px; color: white;">ONA TILI</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'adabiyot'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #88B04B; border-radius: 20px;">
          <i class="fa-solid fa-book" style="color: black;"></i>
          <img src="<?=Url::base()?>/images/adabiyor.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">ADABIYOT</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'rus tili'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #92A8D1; border-radius: 20px;">
          <i class="fa-solid fa-book" style="color: black;"></i>
          <img src="<?=Url::base()?>/images/rustili.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">RUS TILI</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'ingliz tili'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #F7CAC9; border-radius: 30px;">
          <i class="fa-solid fa-book"></i>
          <img src="<?=Url::base()?>/images/ingliztili.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">INGLIZ TILI</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => "o'zbekiston tarixi"])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #009B77; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/tarix1.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">O'ZBEKISTON TARIXI</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'jahon tarixi'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #DD4124; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/tarix2.jpg" style="width: 100px; height: 100px; border-radius: 20px;">
          <p style="font-size: 20px; color: white;">JAHON TARIXI</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'informatika'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #7FCDCD; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/informatika.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">INFORMATIKA</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'huquq'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #EFC050; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/huquq.svg" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">HUQUQ</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'geografiya'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #FF6F61; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/geografiya.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">GEOGRAFIYA</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'kimyo'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #92A8D1; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/kimyo.png" style="width: 100px; height: 100px; border-radius: 30px;">
          <p style="font-size: 20px; color: white;">KIMYO</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'iqtisodiyot'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #6B5B95; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/iqtisodiyot.png" style="width: 100px; height: 100px; border-radius: 30px;">
          <p style="font-size: 20px; color: white;">IQTISODIYOT</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'biologiya'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #88B04B; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/biologiya.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">BIOLOGIYA</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'chizmachilik'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #009B77; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/chizmachilik.png" style="width: 100px; height: 100px;">
          <p style="font-size: 20px; color: white;">CHIZMACHILIK</p>
        </div>
      </a><br>
      <a class="four col-md-6" href="<?=Url::to(['test/selecttest', 'sciense' => 'tarbiya'])?>" id="cash" type="submit" style="margin-top: 30px;">
        <div class="counter-box" style="background-color: #34568b; border-radius: 20px;">
          <i class="fa fa-book"></i>
          <img src="<?=Url::base()?>/images/chizma.avif" style="width: 100px; height: 100px; border-radius: 30px;">
          <p style="font-size: 20px; color: white;">TARBIYA</p>
        </div>
      </a><br>
    </div>
</div>
<br><br><br><br>