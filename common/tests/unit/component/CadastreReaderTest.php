<?php 
namespace common\tests\unit\component;

use Yii;
use common\models\Cadastre;

class CadasterReaderTest extends \Codeception\Test\Unit {
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function testGetDataSingleNumber() {
        $number = '69:27:0000022:1306';
        $cadastralData = Yii::$app->CadastreReader->getData($number);
        verify(isset($cadastralData[1]))->false();
    }

    public function testGetDataTwoNumbers() {    
        $number = '69:27:0000022:1306, 69:27:0000022:1307';
        $cadastralData = Yii::$app->CadastreReader->getData($number);
        verify(isset($cadastralData[1]))->true();
    }

    public function testGetData() {    
        $number = '69:27:0000022:1306, 69:27:0000022:1307';
        $cadastralData = Yii::$app->CadastreReader->getData($number);
        verify($cadastralData[0]->cadastralNumber == "69:27:0000022:1306")->true();
        verify($cadastralData[1]->cadastralNumber == "69:27:0000022:1307")->true();
    }
}