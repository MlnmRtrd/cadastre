<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>
<h1><?= Html::encode('Получение кадастровых данных') ?></h1>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'number')->hint('Введите кадастровые номера через запятую. Например, "69:27:0000022:1306,
69:27:0000022:1307"') ?>
    <div class="form-group mt-2">
        <?= Html::submitButton('Получить данные', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
<hr>
<?php 

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'Кадастровый номер',
            'value' => 'cadastralNumber'
        ],
        [
            'attribute' => 'Адрес',
            'value' => 'address'
        ],
        [
            'attribute' => 'Цена',
            'value' => 'price'
        ],
        [
            'attribute' => 'Площадь',
            'value' => 'area'
        ]
    ]
]); 