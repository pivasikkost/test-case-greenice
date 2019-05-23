<?php

namespace app\models;

use yii\base\Model;

/**
 * AreasForm is the model behind the areas page.
 */
class AreasForm extends Model
{
    public $address;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // address has to be a valid
            ['address', 'string'],
        ];
    }
}
