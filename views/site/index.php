<?php
use ozzyboshi\gridviewmultiheader\GridViewMultiheader as GridViewMultiheader;
$this->title = 'Letture ENEL';
?>
<style type="text/css">body div .container:nth-child(2) {width: auto;} </style>
<div class="site-index">

    <div class="jumbotron">
        <h1>Lista letture contatori ENEL</h1>
    </div>
    
    <div class="body-content">

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

        <div class="row">
          <div class="col-lg-12">
            <?php

             echo GridViewMultiheader::widget([
                    'tableOptions' => ['class' => 'table table-striped',],
                    'addingHeaders' => [ ['' => 1],['Prelievi da enel' => 3],['Delta Prelievi da enel' => 4],['Produzione impianto' => 3],['Delta produzione impianto' => 4],['Immissioni su rete ENEL' => 3],['Delta immissioni su rete ENEL' => 4],['Consumi casa' => 3]  ],
                    'dataProvider' => $dataProvider,
                    'showHeader' => true,
                    'id' => 'summarytable',
                    'columns' => [
                    'data',
                    ['header'=>'F1','attribute'=>'consumofascia1'],
                    ['header'=>'F2','attribute'=>'consumofascia2'],
                    ['header'=>'F3','attribute'=>'consumofascia3'],
                    'consumodelta1witheuro',
                    'consumodelta2witheuro',
                    'consumodelta3witheuro',
                    'consumodeltatotalewitheuro',
                    ['header'=>'F1','attribute'=>'produzionefascia1'],
                    ['header'=>'F2','attribute'=>'produzionefascia2'],
                    ['header'=>'F3','attribute'=>'produzionefascia3'],
                    'produzionedelta1witheuro',
                    'produzionedelta2witheuro',
                    'produzionedelta3witheuro',
                    'produzionedeltatotalewitheuro',
                    ['header'=>'F1','attribute'=>'immissionefascia1'],
                    ['header'=>'F2','attribute'=>'immissionefascia2'],
                    ['header'=>'F3','attribute'=>'immissionefascia3'],
                    'immissionedelta1witheuro',
                    'immissionedelta2witheuro',
                    'immissionedelta3witheuro',
                    'immissionedeltatotalewitheuro',
                    'consumicasafotovoltaico',
                    'consumicasatotali',
                    'consumicasapercentuale',
                    ],
                ]);
            ?>
          </div>
        </div>
    </div>
    
</div>
