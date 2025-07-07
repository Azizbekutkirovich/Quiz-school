<?php
  use yii\helpers\Url;

?>
<div class="container" style="margin-top: 100px;">
  <h2 class="text-center">Sozlamalar</h2>

    <div class="settings-section">
        <div class="card">
            <div class="card-header">
                <h5>Shaxsiy ma'lumotlar</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label class="form-label">Login: <?=Yii::$app->user->identity->login?></label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ism: <?=Yii::$app->user->identity->name?></label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Familya: <?=Yii::$app->user->identity->surname?></label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Maktab: <?=Yii::$app->user->identity->school?></label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sinf: <?=Yii::$app->user->identity->class?></label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="settings-section">
        <div class="card">
            <div class="card-header">
                <h5>Platforma sozlamalari</h5>
            </div>
            <div class="card-body">
            <a href="<?=Url::to(['main/about'])?>"><img src="./../web/images/teamwork.png" style="width: 50px; height: 50px;"> Platforma asoschilari</a>
              <a href="<?=Url::to(['main/logout'])?>"><img src="./../web/images/logout.png" style="width: 50px; height: 50px;"> Accountdan chiqish</a>
            </div>
        </div>
    </div>
</div>
<br><br>