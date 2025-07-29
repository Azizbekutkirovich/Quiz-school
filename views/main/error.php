<?php
use yii\helpers\Html;

$this->title = $name;
?>

<div style="text-align: center; padding: 50px; font-family: Arial, sans-serif; background-color: #f9f9f9; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #444;">
    
    <img src="<?=Yii::$app->homeUrl?>/web/images/error.png" alt="Siniq robot" style="width: 200px; margin-bottom: 30px;">

    <p><?=Html::encode($name)?></p>

    <h1 style="font-size: 32px; margin-bottom: 10px;"><?= nl2br(Html::encode($message)) ?></h1>

    <a href="<?= Yii::$app->homeUrl ?>" style="margin-top: 25px; display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 6px; text-decoration: none; font-size: 16px;">
        Ortga qaytish
    </a>

</div>