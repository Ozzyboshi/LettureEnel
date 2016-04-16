<?php

namespace app\components;

use yii\grid\GridView;
use yii\helpers\Html;

class FotovoltaicoGrid extends GridView
{

  public $firstrow = [];
  public $secondrow = [];
  /**
   * Renders the table header.
   * @return string the rendering result.
   */
  public function renderTableHeader()
  {
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

      $firstrow= "<tr>";
      foreach ($this->firstrow as $key => $value) {
        $firstrow=$firstrow."<th colspan=".$value.">".$key."</th>";
      }
      $firstrow=$firstrow."</tr>";
      $secondrow= "<tr>";
      foreach ($this->secondrow as $key => $value) {
        $secondrow=$secondrow."<th>".$value."</th>";
      }
      $secondrow=$secondrow."</tr>";
      /*<th colspan=4 class=prelievienel>Delta Prelievi da ENEL</th>
      <th colspan=3 class="produzione">Produzione impianto</th>
      <th colspan=4 class="produzione">Delta produzione impianto</th>
      <th colspan=3 class="immissioni">Immissioni su rete ENEL</th>
      <th colspan=4 class="immissioni">Delta Immissioni su rete ENEL</th>
      <th colspan=3 class="consumi"  >Consumi casa</th>
    </tr>
    <tr>
      <th></th>
      <th class=prelievienel>F1</th>
      <th class=prelievienel>F2</th>
      <th class=prelievienel>F3</th>
      <th class=prelievienel>F1</th>
      <th class=prelievienel>F2</th>
      <th class=prelievienel>F3</th>
      <th class=prelievienel>TOT</th>

      <th class="produzione">F1</th>
      <th class="produzione">F2</th>
      <th class="produzione">F3</th>
      <th class="produzione">F1</th>
      <th class="produzione">F2</th>
      <th class="produzione">F3</th>
       <th class=produzione>TOT</th>

      <th class="immissioni">F1</th>
      <th class="immissioni">F2</th>
      <th class="immissioni">F3</th>
      <th class="immissioni">F1</th>
      <th class="immissioni">F2</th>
      <th class="immissioni">F3</th>
      <th class="immissioni">TOT</th>

      <th class="consumi">Da fotovoltaico</th>
      <th class="consumi">Totali</th>
      <th class="consumi">%</th>
    </tr>";*/
      return "<thead>\n" .$firstrow. $secondrow . "\n</thead>";
  }
}
