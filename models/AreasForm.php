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
            // address is required
            ['address', 'required'],
            // email has to be a valid email address
            ['address', 'string'],
        ];
    }
}
