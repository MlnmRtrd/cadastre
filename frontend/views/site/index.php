<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<h1><?= Html::encode('Получение кадастровых данных') ?></h1>
<div class="site-index">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->hint('Введите кадастровые номера через запятую. Например, "69:27:0000022:1306,
69:27:0000022:1307"') ?>
    
    <div class="form-group mt-2">
        <?= Html::submitButton('Получить данные', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
