<?php
use \app\components\GridViewMultiheader;
$this->title = 'Letture ENEL';
?>

<style>.container {width: auto;}</style>
<div class="site-index">

    <div class="jumbotron">
        <h1>Lista letture contatori ENEL</h1>
    </div>
    
    <div class="body-content">
        <div class="row">
          <div class="col-lg-12">
            <?php

             echo GridViewMultiheader::widget([
                'tableOptions' => ['class' => 'table table-striped',],
                'dataProvider' => $dataProvider,
                'showHeader' => true,
                'id' => 'maintable',
                'columns' => [
                'id',
            'data',
            'consumofascia1',
            'consumodelta1',
            'consumofascia2',
            'consumodelta2',
            'consumofascia3',
            'consumodelta3',
            'produzionefascia1',
            'produzionedelta1',
            'produzionefascia2',
            'produzionedelta2',
            'produzionefascia3',
            'produzionedelta3',
            'immissionefascia1',
            'immissionedelta1',
            'immissionefascia2',
            'immissionedelta2',
            'immissionefascia3',
            'immissionedelta3',
                ],
                ]);
            
            
            ?>
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
