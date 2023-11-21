<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Cadastre model
 *
 * @property integer $id
 * @property string  $cadastralNumber
 * @property string  $address
 * @property float   $price
 * @property float   $area
 * @property string  $last_update
 */

class Cadastre extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cadastre}}';
    }

    /**
     * Finds land by cadastral number
     * @param string $cadastralNumber
     * @return static|null
     */
    public static function findByCadastralNumber($cadastralNumber) {
        return static::findOne(['cadastralNumber' => $cadastralNumber]);
    }

    /**
     * Check last update and current datetime
     * @param string $last_update
     * @return bool|null
     */
    public static function isValid($last_update) {
        $time = strtotime('-1 hour');
        $date = date('Y-m-d H:i:s', $time); 
       
        if ($last_update > $date) {
            return true;
        }
    }
}