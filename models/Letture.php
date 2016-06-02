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

    public $euroconsumo1;
    public $euroconsumo2;
    public $euroconsumo3;

    public $europroduzione1;
    public $europroduzione2;
    public $europroduzione3;

    public $euroimmissione1;
    public $euroimmissione2;
    public $euroimmissione3;

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
            //'consumofascia1' => 'F 1',
            'consumofascia1' => 'Consumo Fascia 1',
            'consumofascia2' => 'Consumo Fascia 2',
            'consumofascia3' => 'Consumo Fascia 3',
            'consumodelta1' => 'F 1',
            'consumodelta2' => 'F 2',
            'consumodelta3' => 'F 3',
            'produzionefascia1' => 'Produzione fascia 1',
            'produzionefascia2' => 'Produzione fascia 2',
            'produzionefascia3' => 'Produzione fascia 3',
            'produzionedelta1' => 'F 1',
            'produzionedelta2' => 'F 2',
            'produzionedelta3' => 'F 3',
            'immissionedelta1' => 'F 1',
            'immissionedelta2' => 'F 2',
            'immissionedelta3' => 'F 3',
            'immissionefascia1' => 'Immissione fascia 1',
            'immissionefascia2' => 'Immissione fascia 2',
            'immissionefascia3' => 'Immissione fascia 3',
            'deltaconsumofascia1' => 'Delta Consumo F 1',
            'deltaconsumofascia2' => 'Delta Consumo F 2',
            'consumodelta1witheuro' => 'F1',
            'consumodelta2witheuro' => 'F2',
            'consumodelta3witheuro' => 'F3',
            'produzionedelta1witheuro' => 'F1',
            'produzionedelta2witheuro' => 'F2',
            'produzionedelta3witheuro' => 'F3',
            'immissionedelta1witheuro' => 'F1',
            'immissionedelta2witheuro' => 'F2',
            'immissionedelta3witheuro' => 'F3',
            'consumodeltatotalewitheuro' => 'TOT',
            'produzionedeltatotalewitheuro' => 'TOT',
            'immissionedeltatotalewitheuro' => 'TOT',
            'consumicasafotovoltaico' => 'Da fotovoltaico',
            'consumicasatotali' => 'Totali',
            'consumicasapercentuale' => '%',
        ];
    }

    public function getConsumodelta1witheuro()
    {
        return $this->consumodelta1." \n(".$this->euroconsumo1."€)";
    }

    public function getConsumodelta2witheuro()
    {
        return $this->consumodelta2." \n(".$this->euroconsumo2."€)";
    }

    public function getConsumodelta3witheuro()
    {
        return $this->consumodelta3." \n(".$this->euroconsumo3."€)";
    }

    public function getConsumodeltatotalewitheuro()
    {
        return (string)((int)$this->consumodelta1+(int)$this->consumodelta2+(int)$this->consumodelta3)." \n(".(string)((float)$this->euroconsumo1+(float)$this->euroconsumo2+(float)$this->euroconsumo3)."€)";
    }

    public function getProduzionedelta1witheuro()
    {
        return $this->produzionedelta1." \n(".$this->europroduzione1."€)";
    }

    public function getProduzionedelta2witheuro()
    {
        return $this->produzionedelta2." \n(".$this->europroduzione2."€)";
    }

    public function getProduzionedelta3witheuro()
    {
        return $this->produzionedelta3." \n(".$this->europroduzione3."€)";
    }

    public function getProduzionedeltatotalewitheuro()
    {
        return (string)((int)$this->produzionedelta1+(int)$this->produzionedelta2+(int)$this->produzionedelta3)." \n(".(string)((float)$this->europroduzione1+(float)$this->europroduzione2+(float)$this->europroduzione3)."€)";
    }

    public function getImmissionedelta1witheuro()
    {
        return $this->immissionedelta1." \n(".$this->euroimmissione1."€)";
    }

    public function getImmissionedelta2witheuro()
    {
        return $this->immissionedelta2." \n(".$this->euroimmissione2."€)";
    }

    public function getImmissionedelta3witheuro()
    {
        return $this->immissionedelta3." \n(".$this->euroimmissione3."€)";
    }

    public function getImmissionedeltatotalewitheuro()
    {
        return (string)((int)$this->immissionedelta1+(int)$this->immissionedelta2+(int)$this->immissionedelta3)." \n(".(string)((float)$this->euroimmissione1+(float)$this->euroimmissione2+(float)$this->euroimmissione3)."€)";
    }

    public function getConsumicasafotovoltaico()
    {
        return ((int)$this->produzionedelta1+(int)$this->produzionedelta2+(int)$this->produzionedelta3) - ((int)$this->immissionedelta1+(int)$this->immissionedelta2+(int)$this->immissionedelta3);
    }

    public function getConsumicasatotali()
    {
        return ((int)$this->consumodelta1+(int)$this->consumodelta2+(int)$this->consumodelta3)+(((int)$this->produzionedelta1+(int)$this->produzionedelta2+(int)$this->produzionedelta3) - ((int)$this->immissionedelta1+(int)$this->immissionedelta2+(int)$this->immissionedelta3));
    }

    public function getConsumicasapercentuale()
    {
        return round($this->getConsumicasafotovoltaico()*100/$this->getConsumicasatotali(),2);
    }

}
