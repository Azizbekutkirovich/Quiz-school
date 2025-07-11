<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap5\ActiveForm;
  $this->title = "Login";
?>
<div class="form_wrapper">
  <div class="form_container" id="title">
    <div class="title_container">
      <?php if (Yii::$app->session->hasFlash("login-error-in-reg-action")): ?>
        <h1 class="alert alert-danger"><?=Yii::$app->session->getFlash("login-error-in-reg-action");?></h1>
        <?php endif; ?>
      <h2><span style="color: orange;">Quiz school</span> platformasiga kirish</h2>
    </div>
    <?php $f = ActiveForm::begin(); ?>
      <div class="row clearfix">
        <div class="col_half">
          <label>Login</label>
          <div class="input_field">
            <?=$f->field($model, 'login')->textInput(['placeholder' => "Loginni kiriting"])->label(false);?>
          </div>
        </div>
        <div class="col_half">
          <label>Parol</label>
          <div class="input_field">
            <?=$f->field($model, 'password')->passwordInput(['placeholder' => "Parolni kiriting"])->label(false);?>
          </div>
        </div>
      </div>
      <?php
        echo Html::submitButton("Kirish", ['class' => 'rg', 'style' => 'background-color: orange; width: 100%;']);
      ?>
      <h3>Agar ro'yxatdan o'tmagan bo'lsangiz quyidagi ro'yxatdan o'tish linkiga bosing! <a href="<?=Url::to(['main/register'])?>" style="margin-top: 20px; width: 100%;"/>Ro'yxatdan o'tish</a></h3>
    <?php ActiveForm::end(); ?>
  </div>
</div>