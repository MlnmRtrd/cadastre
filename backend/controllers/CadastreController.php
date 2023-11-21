<?php

namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;

class CadastreController extends ActiveController {
    public $modelClass = "common/models/Cadastre";

    public function actionGet($number) {
        return Yii::$app->CadastreReader->getData($number);
    }
}