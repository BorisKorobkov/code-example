<?php

namespace app\grid;

use yii\helpers\Html;

class EmailColumn extends StringColumn
{
    public $filterType = '';
    public $filter = '';

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filter = Html::activeInput('email', $this->grid->filterModel, $this->attribute, $this->filterInputOptions);

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' email-column';
    }

    /**
     * @inheritDoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        return $value ? Html::mailto($value) : '';
    }
}
