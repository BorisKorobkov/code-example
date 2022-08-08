<?php

namespace app\grid;

class BooleanColumn extends \kartik\grid\BooleanColumn
{
    public $values;

    /**
     * @inheritDoc
     */
    public function getDataCellValue($model, $key, $index)
    {
        $value = parent::getDataCellValue($model, $key, $index);
        $value = ($value === $this->trueIcon) ? 1 : 0;

        return $this->values[$value] ?? ($key ? $model->$key : $key);
    }

}

