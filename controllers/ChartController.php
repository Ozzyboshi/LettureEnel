<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Letture;


class ChartController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionShow()
    {
    	list($siteController) = Yii::$app->createController('site/index');
    	$lettureActiverecord = new Letture();

        $data1=$lettureActiverecord::findBySql($siteController->createIndexQuery())->all();
        $consumoFascia1Array=$consumoFascia2Array=$consumoFascia3Array=$dataArray=array();
        $produzioneFascia1Array=$produzioneFascia2Array=$produzioneFascia3Array=array();
        $immissioneFascia1Array=$immissioneFascia2Array=$immissioneFascia3Array=array();

        foreach ($data1 as $key => $value) 
        {
                array_unshift($dataArray,$value['data']);
                array_unshift($consumoFascia1Array,intval($value['consumodelta1']));
                array_unshift($consumoFascia2Array,intval($value['consumodelta2']));
                array_unshift($consumoFascia3Array,intval($value['consumodelta3']));

                array_unshift($produzioneFascia1Array,intval($value['produzionedelta1']));
                array_unshift($produzioneFascia2Array,intval($value['produzionedelta2']));
                array_unshift($produzioneFascia3Array,intval($value['produzionedelta3']));

                array_unshift($immissioneFascia1Array,intval($value['immissionedelta1']));
                array_unshift($immissioneFascia2Array,intval($value['immissionedelta2']));
                array_unshift($immissioneFascia3Array,intval($value['immissionedelta3']));
        }

        array_shift($dataArray);
        array_shift($consumoFascia1Array);
        array_shift($consumoFascia2Array);
        array_shift($consumoFascia3Array);
        array_shift($produzioneFascia1Array);
        array_shift($produzioneFascia2Array);
        array_shift($produzioneFascia3Array);
        array_shift($immissioneFascia1Array);
        array_shift($immissioneFascia2Array);
        array_shift($immissioneFascia3Array);

        $graph1Array=[['name'=>'Consumo fascia 1','data'=> $consumoFascia1Array],['name'=>'Consumo fascia 2','data'=> $consumoFascia2Array],['name'=>'Consumo fascia 3','data'=> $consumoFascia3Array]];

        $graph2Array=[['name'=>'Produzione fascia 1','data'=> $produzioneFascia1Array],['name'=>'Produzione fascia 2','data'=> $produzioneFascia2Array],['name'=>'Produzione fascia 3','data'=> $produzioneFascia3Array]];

        $graph3Array=[['name'=>'Immissione fascia 1','data'=> $immissioneFascia1Array],['name'=>'Immissione fascia 2','data'=> $immissioneFascia2Array],['name'=>'Immissione fascia 3','data'=> $immissioneFascia3Array]];

    	return $this->render('chart',['data'=>$dataArray,'data1'=> $graph1Array,'data2' => $graph2Array,'data3'=> $graph3Array]);
    }
}
