<?php
use yii\helpers\Html;
use yii\helpers\Markdown;

/* @var $this yii\web\View */
$this->title = 'LettureEnel Applicazione web';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <?=Markdown::process(file_get_contents(\Yii::$app->basePath.'/README.md'),'gfm');?>
</div>
