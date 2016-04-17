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
                'addingHeaders' => [ ['' => 2],['Prelievi da enel' => 3],['Delta Prelievi da enel' => 3],['Produzione impianto' => 3],['Delta produzione impianto' => 3],['Immissioni su rete ENEL' => 3],['Delta immissioni su rete ENEL' => 3]  ],
                'dataProvider' => $dataProvider,
                'showHeader' => true,
                'id' => 'maintable',
                'columns' => [
                'id',
            'data',
            'consumofascia1',
            'consumofascia2',
            'consumofascia3',
            'consumodelta1witheuro',
            'consumodelta2witheuro',
            'consumodelta3witheuro',
            'produzionefascia1',
            'produzionefascia2',
            'produzionefascia3',
            'produzionedelta1witheuro',
            'produzionedelta2witheuro',
            'produzionedelta3witheuro',
            'immissionefascia1',
            'immissionefascia2',
            'immissionedelta2',
            'immissionefascia3',
            'immissionedelta1witheuro',
            'produzionedelta2witheuro',
            'immissionedelta3witheuro',
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
