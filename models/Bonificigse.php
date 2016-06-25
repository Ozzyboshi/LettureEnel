<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonificigse".
 *
 * @property integer $id
 * @property string $data
 * @property string $causale
 * @property double $importo
 */
class Bonificigse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonificigse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'required'],
            [['data'], 'safe'],
            [['importo'], 'required'],
            [['importo'], 'number'],
            [['causale'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'causale' => 'Causale',
            'importo' => 'Importo',
        ];
    }
}
