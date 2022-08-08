<?php

namespace app\grid;

use yii\helpers\Html;

class IdColumn extends DataColumn
{
    public $attribute = 'id';
    public $label = '#';
    public $width = '100px';
    public $isLink = true;

    /**
     * @inheritDoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);

        return $this->isLink ?
            Html::a($value, ['edit', 'id' => $model->id]) :
            $value;
    }
}
