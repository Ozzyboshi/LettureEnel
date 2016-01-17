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
            'consumofascia1' => 'Consumo F 1',
            'consumofascia2' => 'Consumo F 2',
            'consumofascia3' => 'Consumo F 3',
            'produzionefascia1' => 'Produzione F 1',
            'produzionefascia2' => 'Produzione F 2',
            'produzionefascia3' => 'Produzione F 3',
            'immissionefascia1' => 'Immissione F 1',
            'immissionefascia2' => 'Immissione F 2',
            'immissionefascia3' => 'Immissione F 3',
            'deltaconsumofascia1' => 'Delta Consumo F 1',
            'deltaconsumofascia2' => 'Delta Consumo F 2'
        ];
    }

    public function afterFind()  //this function will be called after your every find call
    {
        $this->prev=$this->find()->where(['<', 'data', $this->data])->orderBy('data desc')->one();
        $this->prezzo = Prezzi::find()->where(['<','datainiziovalidita',$this->data])->andWhere(['>','datafinevalidita',$this->data])->one();
    }

    public function getPrev()
    {
      return $this->find()->where(['<', 'id', $this->id])->orderBy('id desc')->one();
    }

    public function getPrevious()
    {
        return $this->hasOne(Letture::className(), ['id' => $this->getPreviousid()]);
    }

    public function getPreviousid()
    {
      if ($this->prev)
        return $this->prev->id;
      return "";
    }

    private function getEurofascia1($kwh)
    {
      return $this->prezzo->prezzofascia1*$kwh;
    }

    private function getEurofascia2($kwh)
    {
      return $this->prezzo->prezzofascia2*$kwh;
    }

    private function getEurofascia3($kwh)
    {
      return $this->prezzo->prezzofascia3*$kwh;
    }

    public function getDeltaconsumofascia1()
    {
      return $this->prev?$this->consumofascia1-$this->prev->consumofascia1:$this->consumofascia1;
    }

    public function getDeltaconsumofascia2()
    {
      return $this->prev?$this->consumofascia2-$this->prev->consumofascia2:$this->consumofascia2;
    }

    public function getDeltaconsumofascia3()
    {
      return $this->prev?$this->consumofascia3-$this->prev->consumofascia3:$this->consumofascia3;
    }

    public function getDeltaconsumofascia1Desc()
    {
      $kwh=$this->getDeltaconsumofascia1();
      return $kwh.' ('.round($this->getEurofascia1($kwh),2).'€)';
    }

    public function getDeltaconsumofascia2Desc()
    {
      $kwh=$this->getDeltaconsumofascia2();
      return $kwh.' ('.round($this->getEurofascia2($kwh),2).'€)';
    }

    public function getDeltaconsumofascia3Desc()
    {
      $kwh=$this->getDeltaconsumofascia3();
      return $kwh.' ('.round($this->getEurofascia3($kwh),2).'€)';
    }

    public function getDeltaconsumototale()
    {
      return $this->getDeltaconsumofascia1()+$this->getDeltaconsumofascia2()+$this->getDeltaconsumofascia3();
    }

    public function getDeltaconsumototaleDesc()
    {
      $kwh=$this->getDeltaconsumototale();
      $fascia1=$this->getEurofascia1($this->getDeltaconsumofascia1());
      $fascia2=$this->getEurofascia2($this->getDeltaconsumofascia2());
      $fascia3=$this->getEurofascia3($this->getDeltaconsumofascia3());
      return $kwh.' ('.round($fascia1+$fascia2+$fascia3,2).'€)';
    }

    public function getDeltaproduzionefascia1()
    {
      return $this->prev?$this->produzionefascia1-$this->prev->produzionefascia1:$this->produzionefascia1;
    }

    public function getDeltaproduzionefascia2()
    {
      return $this->prev?$this->produzionefascia2-$this->prev->produzionefascia2:$this->produzionefascia2;
    }

    public function getDeltaproduzionefascia3()
    {
      return $this->prev?$this->produzionefascia3-$this->prev->produzionefascia3:$this->produzionefascia3;
    }

    public function getDeltaproduzionefascia1Desc()
    {
      $kwh=$this->getDeltaproduzionefascia1();
      return $kwh.' ('.round($this->getEurofascia1($kwh),2).'€)';
    }

    public function getDeltaproduzionefascia2Desc()
    {
      $kwh=$this->getDeltaproduzionefascia2();
      return $kwh.' ('.round($this->getEurofascia2($kwh),2).'€)';
    }

    public function getDeltaproduzionefascia3Desc()
    {
      $kwh=$this->getDeltaproduzionefascia3();
      return $kwh.' ('.round($this->getEurofascia3($kwh),2).'€)';
    }
    
    public function getDeltaproduzionetotale()
    {
      return $this->getDeltaproduzionefascia1()+$this->getDeltaproduzionefascia2()+$this->getDeltaproduzionefascia3();
    }

    public function getDeltaproduzionetotaleDesc()
    {
      $kwh=$this->getDeltaproduzionetotale();
      $fascia1=$this->getEurofascia1($this->getDeltaproduzionefascia1());
      $fascia2=$this->getEurofascia2($this->getDeltaproduzionefascia2());
      $fascia3=$this->getEurofascia3($this->getDeltaproduzionefascia3());
      return $kwh.' ('.round($fascia1+$fascia2+$fascia3,2).'€)';
    }

    public function getDeltaimmissionefascia1()
    {
      return $this->prev?$this->immissionefascia1-$this->prev->immissionefascia1:$this->immissionefascia1;
    }

    public function getDeltaimmissionefascia2()
    {
      return $this->prev?$this->immissionefascia2-$this->prev->immissionefascia2:$this->immissionefascia2;
    }

    public function getDeltaimmissionefascia3()
    {
      return $this->prev?$this->immissionefascia3-$this->prev->immissionefascia3:$this->immissionefascia3;
    }

    public function getDeltaimmissionefascia1Desc()
    {
      $kwh=$this->getDeltaimmissionefascia1();
      return $kwh.' ('.round($this->getEurofascia1($kwh),2).'€)';
    }

    public function getDeltaimmissionefascia2Desc()
    {
      $kwh=$this->getDeltaimmissionefascia2();
      return $kwh.' ('.round($this->getEurofascia2($kwh),2).'€)';
    }

    public function getDeltaimmissionefascia3Desc()
    {
      $kwh=$this->getDeltaimmissionefascia3();
      return $kwh.' ('.round($this->getEurofascia3($kwh),2).'€)';
    }

    public function getDeltaimmissionetotale()
    {
      return $this->getDeltaimmissionefascia1()+$this->getDeltaimmissionefascia2()+$this->getDeltaimmissionefascia3();
    }

    public function getDeltaimmissionetotaleDesc()
    {
      $kwh=$this->getDeltaimmissionetotale();
      $fascia1=$this->getEurofascia1($this->getDeltaimmissionefascia1());
      $fascia2=$this->getEurofascia2($this->getDeltaimmissionefascia2());
      $fascia3=$this->getEurofascia3($this->getDeltaimmissionefascia3());
      return $kwh.' ('.round($fascia1+$fascia2+$fascia3,2).'€)';
    }

    public function getConsumicasafotovoltaico()
    {
      return $this->getDeltaproduzionetotale()-$this->getDeltaimmissionetotale();
    }

    public function getConsumicasatotali()
    {
      return $this->getConsumicasafotovoltaico()+$this->getDeltaconsumototale();
    }

    public function getConsumicasaperc()
    {
      return $this->getConsumicasafotovoltaico()*100/$this->getConsumicasatotali();
    }

    public function getConsumicasapercDesc()
    {
      return round($this->getConsumicasaperc(),2)."%";
    }
}
