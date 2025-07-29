<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap5\ActiveForm;
  $this->title = "Ro'yxatdan o'tish";
?>
<div class="form_wrapper">
    <div class="form_container" id="title">
      <div class="title_container">
        <h2><span style="color: orange;">Quiz school</span> platformasiga ro'yxatdan o'tish</h2>
      </div>
      <?php $f = ActiveForm::begin(); ?>
        <div class="row clearfix">
          <div class="col_half">
            <label>Login</label>
            <div class="input_field">
              <?=$f->field($model, 'login')->textInput(['placeholder' => "Login o'ylab toping"])->label(false);?>
            </div>
          </div>
          <div class="col_half">
            <label>Ism</label>
            <div class="input_field">
              <?=$f->field($model, 'name')->textInput(['placeholder' => "Ismingizni kiriting"])->label(false);?>
            </div>
          </div>
          <div class="col_half">
            <label>Familiya</label>
            <div class="input_field">
              <?=$f->field($model, 'surname')->textInput(['placeholder' => "Familya kiriting"])->label(false);?>
            </div>
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
          </div>
          <div class="col_half">
            <label>Parol</label>
            <div class="input_field">
              <?=$f->field($model, 'password')->passwordInput(['placeholder' => "Parol o'ylab toping"])->label(false);?>
            </div>
            <p id="text_pa" style="color: blue;">Parol kamida 8ta belgidan iborat bo'lishi kerak. Parolda katta harf, kichik harf va raqam bo'lishi shart!</p>
          </div>
        </div>
        <?php
          echo Html::submitButton("Ro'yxatdan o'tish", ['class' => 'rg', 'style' => 'background-color: orange; width: 100%;']);
        ?>
        <h3>Agar ro'yxatdan o'tgan bo'lsangiz quyidagi login linkiga bosing! <a href="<?=Url::to(['main/login'])?>" style="margin-top: 20px; width: 100%;">Login</a></h3>
      <?php ActiveForm::end(); ?>
  </div>
</div>