<?php
namespace common\components;

use Yii;
use yii\base\Component;
use common\models\Cadastre;
use yii\httpclient\Client;

class CadastreReader extends Component {

    public function getData($cadastralNumbers) {
        $numbers = explode(",", $cadastralNumbers);
        $validData = [];
        $invalidData = [];
        foreach ($numbers as $number) {
            $land = Cadastre::findByCadastralNumber($number);
            if ($land && $land->isValid($land->last_update)) {
                $validData[] = $land;
            } else {
                $invalidData[] = trim($number);
            }
        }
        
        if (empty($invalidData)) { return $validData; }
        
        return $this->updateInvalidData($invalidData, $validData);
    }

    private function updateInvalidData($invalidData, $validData) {
        $apiData = $this->getApiData($invalidData);

        if (empty($apiData)) { return $this->getOldData($invalidData, $validData); }
        
        foreach ($apiData as $data) {
            $model = Cadastre::findByCadastralNumber($data["cadastralNumber"]);
            if (!$model) {
                $model = new Cadastre();
                $model->cadastralNumber = $data["cadastralNumber"];
                $model->last_update = $data["last_update"];
                $model->address = $data["address"];
                $model->price = $data["price"];
                $model->area = $data["area"];
            } else {
                $model->last_update = date('Y-m-d H:i:s');
            }
            $model->save();
            $validData[] = $model;
        }
        return $validData;
    }

    private function getApiData ($invalidData) {
        $client = new Client(['baseUrl' => 'https://api.pkk.bigland.ru/test/plots']);
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.pkk.bigland.ru/test/plots')
            ->addHeaders(['content-type' => 'application/json'])
            ->setContent('{
                "collection": {
                    "plots": '.json_encode($invalidData).'
                }
            }')
            ->send();
           
        if ($response->isOk) {
            return $this->parseApiData($response->data);
        }

        return array();
    }

    private function parseApiData($apiData): array {
        $result = [];
        foreach ($apiData as $data) {
            $entry['cadastralNumber'] = $data['number'];
            $entry['last_update'] = date("Y-m-d H:i:s");
            $entry['address'] = $data['attrs']['plot_address'];
            $entry['price'] = $data['attrs']['plot_price'];
            $entry['area'] = $data['attrs']['plot_area'];
            $result[] = $entry;
        }
        return $result;
    }
    
    private function getOldData($invalidData, $validData) {
        foreach ($invalidData as $data) {
            $land = Cadastre::findByCadastralNumber($data);            
            $validData[] = $land;
        }
        return $validData;
    }
}