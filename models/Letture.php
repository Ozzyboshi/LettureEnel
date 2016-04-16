<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letture".
 *
 * @property integer $id
 * @property string $data
 * @property integer $consumofascia1
 * @property integer $consumofascia2
 * @property integer $consumofascia3
 * @property integer $produzionefascia1
 * @property integer $produzionefascia2
 * @property integer $produzionefascia3
 * @property integer $immissionefascia1
 * @property integer $immissionefascia2
 * @property integer $immissionefascia3
 */
class Letture extends \yii\db\ActiveRecord
{

    private $prev;
    private $prezzo;

    public $consumodelta1;
    public $consumodelta2;
    public $consumodelta3;

    public $produzionedelta1;
    public $produzionedelta2;
    public $produzionedelta3;

    public $immissionedelta1;
    public $immissionedelta2;
    public $immissionedelta3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'letture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['data'],'match','pattern'=>'%\b[0-9]{4}[/.-](?:1[0-2]|0[1-9])[/.-](?:3[01]|[12][0-9]|0[1-9])\b%'],
            [['consumofascia1', 'consumofascia2', 'consumofascia3', 'produzionefascia1', 'produzionefascia2', 'produzionefascia3', 'immissionefascia1', 'immissionefascia2', 'immissionefascia3'], 'required'],
            [['consumofascia1', 'consumofascia2', 'consumofascia3', 'produzionefascia1', 'produzionefascia2', 'produzionefascia3', 'immissionefascia1', 'immissionefascia2', 'immissionefascia3'], 'integer']
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
            'consumofascia1' => 'F 1',
            'consumofascia2' => 'F 2',
            'consumofascia3' => 'F 3',
            'consumodelta1' => 'F 1',
            'consumodelta2' => 'F 2',
            'consumodelta3' => 'F 3',
            'produzionefascia1' => 'F 1',
            'produzionefascia2' => 'F 2',
            'produzionefascia3' => 'F 3',
            'produzionedelta1' => 'F 1',
            'produzionedelta2' => 'F 2',
            'produzionedelta3' => 'F 3',
            'immissionedelta1' => 'F 1',
            'immissionedelta2' => 'F 2',
            'immissionedelta3' => 'F 3',
            'immissionefascia1' => 'F 1',
            'immissionefascia2' => 'F 2',
            'immissionefascia3' => 'F 3',
            'deltaconsumofascia1' => 'Delta Consumo F 1',
            'deltaconsumofascia2' => 'Delta Consumo F 2'
        ];
    }
}
