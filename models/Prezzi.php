<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prezzi".
 *
 * @property integer $id
 * @property string $datainiziovalidita
 * @property string $datafinevalidita
 * @property double $prezzofascia1
 * @property double $prezzofascia2
 * @property double $prezzofascia3
 */
class Prezzi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prezzi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datainiziovalidita', 'datafinevalidita'], 'safe'],
            [['prezzofascia1', 'prezzofascia2', 'prezzofascia3'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datainiziovalidita' => 'Datainiziovalidita',
            'datafinevalidita' => 'Datafinevalidita',
            'prezzofascia1' => 'Prezzofascia1',
            'prezzofascia2' => 'Prezzofascia2',
            'prezzofascia3' => 'Prezzofascia3',
        ];
    }
}
