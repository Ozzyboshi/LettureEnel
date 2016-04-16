<?php

namespace app\components;

use yii\grid\GridView;
use yii\helpers\Html;
 
class GridViewMultiheader extends GridView {
 
    public $addingHeaders = array();
 
    public function renderTableHeader() {
        $res="";
        if (!empty($this->addingHeaders))
            $res=$res.$this->multiRowHeader();
 
        $cells = [];
        foreach ($this->columns as $column) {
            /* @var $column Column */
            $cells[] = $column->renderHeaderCell();
        }
        $content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);
        if ($this->filterPosition == self::FILTER_POS_HEADER) {
            $content = $this->renderFilters() . $content;
        } elseif ($this->filterPosition == self::FILTER_POS_BODY) {
            $content .= $this->renderFilters();
        }

        return "<thead>\n" . $res.$content . "\n</thead>";
    }
 
    protected function multiRowHeader() {
        $res=CHtml::openTag('thead') . "\n";
        foreach ($this->addingHeaders as $row) {
            $res=$res.$this->addHeaderRow($row);
        }
        $res=$res.CHtml::closeTag('thead') . "\n";
        return $res;
    }
 
    protected function addHeaderRow($row) {
        // add a single header row
        $res=CHtml::openTag('tr') . "\n";
        // inherits header options from first column
        $options = $this->columns[0]->headerHtmlOptions;
        foreach ($row as $header => $width) {
            $options['colspan'] = $width;
            $res=$res.CHtml::openTag('th', $options);
            $res=$res.$header;
            $res=$res.CHtml::closeTag('th');
        }
        $res=$res.CHtml::closeTag('tr') . "\n";
        return $res;
    }
 
}
?>