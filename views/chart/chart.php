<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

$this->title = 'Grafici';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonificigse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
      echo Highcharts::widget([
         'options' => [
            'title' => ['text' => 'Prelievi da enel'],
            'xAxis' => [
               'categories' => $data
            ],
            'yAxis' => [
               'title' => ['text' => 'Watt']
            ],
            'series' => $data1 ,
         ]
      ]);
      ?>
    </p>

    <p>
    <?php
      echo Highcharts::widget([
         'options' => [
            'title' => ['text' => 'Produzione impianto fotovoltaico'],
            'xAxis' => [
               'categories' => $data
            ],
            'yAxis' => [
               'title' => ['text' => 'Watt']
            ],
            'series' => $data2 ,
         ]
      ]);
      ?>
    </p>

    <p>
    <?php
      echo Highcharts::widget([
         'options' => [
            'title' => ['text' => 'Immissione su rete ENEL'],
            'xAxis' => [
               'categories' => $data
            ],
            'yAxis' => [
               'title' => ['text' => 'Watt']
            ],
            'series' => $data3 ,
         ]
      ]);
      ?>
    </p>
    
</div>
