<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Data logger';
echo "<div class='datalogger'>";
echo "'<iframe style='position:fixed; top:50px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;' src='".getenv('DATALOGGER_URL')."'></iframe>";
echo "</div>";
?>
