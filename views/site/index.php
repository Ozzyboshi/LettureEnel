<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use \app\components\FotovoltaicoGrid;
$this->title = 'Letture ENEL';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Lista letture contatori ENEL</h1>
    </div>

    <div class="body-content">
        <div class="row">
          <div class="col-lg-12">
            <?= FotovoltaicoGrid::widget([
                'tableOptions' => ['class' => 'table table-striped',],
                'dataProvider' => $dataProvider,
                'showHeader' => true,
                'id' => 'maintable',
                'firstrow' => ['Data'=>1,'Delta prelievi da ENEL'=>4,'Delta produzione impianto'=>4,'Delta immissioni su rete ENEL'=>4,'Consumi casa'=>3],
                'secondrow' => ['','F1','F2','F3','TOT','F1','F2','F3','TOT','F1','F2','F3','TOT','Da fotovoltaico','Totali','%'],
                'columns' => [
                    'data',
                    'deltaconsumofascia1Desc',
                    'deltaconsumofascia2Desc',
                    'deltaconsumofascia3Desc',
                    'deltaconsumototaleDesc',
                    'deltaproduzionefascia1Desc',
                    'deltaproduzionefascia2Desc',
                    'deltaproduzionefascia3Desc',
                    'deltaproduzionetotaleDesc',
                    'deltaimmissionefascia1Desc',
                    'deltaimmissionefascia2Desc',
                    'deltaimmissionefascia3Desc',
                    'deltaimmissionetotaleDesc',
                    'consumicasafotovoltaico',
                    'consumicasatotali',
                    'consumicasapercDesc'
                ],
            ]); ?>
          </div>
        </div>
    </div>
    <div class=row>
      <div class="col-lg-12">
        <ul>
          <li>Fascia 1 : Ore di punta (F1): dalle 8:00 alle 19:00 nei giorni dal lunedi al venerdi (escluse le festività nazionali)</li>
          <li>Fascia 2 : dalle 19:00 alle 8:00 durante i giorni della settimana (escluse le festività nazionali)</li>
          <li>Fascia 3 : Sabato Domenica e festivi</li>
          <li>Tutti i valori espressi in kWh</li>
        </ul>
      </div>
    </div>
</div>
