<?php
  use yii\helpers\Url;
  $this->title = "Sozlamalar";
?>
<div class="container" style="margin-top: 100px;">
  <h2 class="text-center">Sozlamalar</h2>

    <div class="settings-section">
        <div class="card">
            <div class="card-header">
                <h5>Shaxsiy ma'lumotlar</h5>
            </div>
            <div class="card-body">
                <div>
                    <p>Login: <?=Yii::$app->user->identity->login?></p>
                </div>
                <div>
                    <p>Ism: <?=Yii::$app->user->identity->name?></p>
                </div>
                <div>
                    <p>Familya: <?=Yii::$app->user->identity->surname?></p>
                </div>
                <div>
                    <p>Maktab: <?=Yii::$app->user->identity->school?></p>
                </div>
                <div>
                    <p>Sinf: <?=Yii::$app->user->identity->class?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="settings-section">
        <div class="card">
            <div class="card-header">
                <h5>Platforma sozlamalari</h5>
            </div>
            <div class="card-body">
            <a href="<?=Url::to(['main/about'])?>"><img src="<?=Url::base()?>/images/teamwork.png" style="width: 50px; height: 50px;"> Platforma asoschilari</a>
              <a href="<?=Url::to(['main/logout'])?>"><img src="<?=Url::base()?>/images/logout.png" style="width: 50px; height: 50px;"> Accountdan chiqish</a>
            </div>
        </div>
    </div>
</div>
<br><br>