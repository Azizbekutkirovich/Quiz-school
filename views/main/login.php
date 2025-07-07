<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap5\ActiveForm;
?>
<div class="form_wrapper">
    <div class="form_container" id="title">
      <div class="title_container">
        <h2><span style="color: orange;">Quiz school</span> platformasiga kirish</h2>
      </div>
      <?php $f = ActiveForm::begin(); ?>
        <div class="row clearfix">
          <div class="col_half">
            <label>Login</label>
            <div class="input_field"><span style="width: 2rem; height: 2.8rem;"><i class="fa fa-user"></i></span>
              <?=$f->field($model, 'login')->textInput(['placeholder' => "Loginni kiriting"])->label(false);?>
            </div>
          </div>
          <div class="col_half">
            <label>Parol</label>
            <div class="input_field"><span style="width: 2rem; height: 2.8rem;"><i class="fa fa-lock"></i></span>
              <?=$f->field($model, 'password')->textInput(['placeholder' => "Parolni kiriting"])->label(false);?>
            </div>
          </div>
        </div>
        <!-- <input class="button" id="login" type="submit" value="Kirish" /> -->
        <?php
          echo Html::submitButton("Kirish", ['class' => 'rg', 'style' => 'background-color: orange; width: 100%;']);
        ?>
        <h3>Agar ro'yhatdan o'tmagan bo'lsangiz quyidagi ro'yhatdan o'tish linkiga bosing! <a href="<?=Url::to(['main/register'])?>" style="margin-top: 20px; width: 100%;"/>Ro'yhatdan o'tish</a></h3>
      <?php ActiveForm::end(); ?>
    </div>
  </div>