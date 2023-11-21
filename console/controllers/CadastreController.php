<?php

namespace console\controllers;

use Yii;

use yii\console\Controller;
use yii\helpers\Console;
use yii\console\ExitCode;

class CadastreController extends Controller {

    public function actionGet( $number) {
        $cadastralData = Yii::$app->CadastreReader->getData($number);
        Console::stdout(" id | cadastralNumber    | address                                                                                                     | price  | area \n");
        Console::stdout("----|--------------------|-------------------------------------------------------------------------------------------------------------|--------|-----\n");
        foreach ($cadastralData as $data) {
            Console::stdout(sprintf(" %2d | %-18s | %-100s | %6d | %4d \n", $data->id, $data->cadastralNumber, $data->address, $data->price, $data->area));
        }
        if (!$cadastralData) {
            Console::stdout("Произошла ошибка. Код: ". ExitCode::UNSPECIFIED_ERROR);
        }
        Console::stdout("Процесс завершился с кодом: ". ExitCode::OK);
    }

}