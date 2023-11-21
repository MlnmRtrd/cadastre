<?php

namespace frontend\models;

use yii\base\Model;

class CadastreForm extends Model {
    public $number;

    public function attributeLabels() {
        return [
            'number' => 'Кадастровый номер',
        ];
    }

    public function rules() {
        return [
            ['number', 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['number'], 'required', 'message' => 'Поле обязательно для заполнения']
        ];
    }
}