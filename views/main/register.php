<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap5\ActiveForm;
?>
<div class="form_wrapper">
    <div class="form_container" id="title">
      <div class="title_container">
        <h2><span style="color: orange;">Quiz school</span> platformasiga ro'yhatdan o'tish</h2>
      </div>
      <?php $f = ActiveForm::begin(); ?>
        <div class="row clearfix">
          <div class="col_half">
            <label>Login</label>
            <div class="input_field">
              <!-- <input type="text" name="login" id="login" placeholder="Login o'ylab toping" required/> -->
              <?=$f->field($model, 'login')->textInput(['placeholder' => "Login o'ylab toping"])->label(false);?>
            </div>
          </div>
          <div class="col_half">
            <label>Ism</label>
            <div class="input_field">
              <?=$f->field($model, 'name')->textInput(['placeholder' => "Ismingizni kiriting"])->label(false);?>
            </div>
            <p id="text_n"></p>
          </div>
          <div class="col_half">
            <label>Familiya</label>
            <div class="input_field">
              <?=$f->field($model, 'surname')->textInput(['placeholder' => "Familya kiriting"])->label(false);?>
            </div>
            <p id="text_s"></p>
          </div>
          <div class="col_half">
            <label>Maktabni tanlang</label>
            <div class="input_field">
              <?=$f->field($model, 'school')->dropDownList([
                '1' => '1-maktab',
                '2' => '2-maktab',
                '3' => '3-maktab',
                '4' => '4-maktab',
                '8' => '8-maktab',
                '10' => '10-maktab',
                '11' => '11-maktab',
                '12' => '12-maktab',
                '13' => '13-maktab'
              ],['prompt'=>'Tanlang'])->label(false);?>
            </div>
            <p id="text_sch"></p>
          </div>
          <div class="col_half">
            <labeL>Sinfingizni tanlang</label>
            <div class="input_field">
              <?=$f->field($model, 'class')->dropDownList([
                '1' => '1-sinf',
                '2' => '2-sinf',
                '3' => '3-sinf',
                '4' => '4-sinf',
                '5' => '5-sinf',
                '6' => '6-sinf',
                '7' => '7-sinf',
                '8' => '8-sinf',
                '9' => '9-sinf',
                '10' => '10-sinf',
                '11' => '11-sinf',
              ],['prompt'=>'Tanlang'])->label(false);?>
            </div>
            <p id="text_c"></p>
          </div>
          <div class="col_half">
            <label>Parol</label>
            <div class="input_field">
              <?=$f->field($model, 'password')->passwordInput(['placeholder' => "Parol o'ylab toping"])->label(false);?>
            </div>
            <p id="text_pa" style="color: blue;">Parol kamida 8ta belgidan iborat bo'lishi kerak</p>
          </div>
        </div>
        <?php
          echo Html::submitButton("Kirish", ['class' => 'rg', 'style' => 'background-color: orange; width: 100%;']);
        ?>
        <h3>Agar ro'yxatdan o'tgan bo'lsangiz quyidagi login linkiga bosing! <a href="<?=Url::to(['main/login'])?>" style="margin-top: 20px; width: 100%;">Login</a></h3>
      <?php ActiveForm::end(); ?>
  </div>
</div>