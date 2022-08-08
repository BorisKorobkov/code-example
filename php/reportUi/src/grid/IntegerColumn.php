<?php

namespace app\grid;

use yii\helpers\Html;

class IntegerColumn extends DataColumn
{
    public $filterType = '';
    public $filter = '';
    public $step = 1;

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filterInputOptions['step'] = $this->step;
        $this->filter = Html::activeInput('number', $this->grid->filterModel, $this->attribute, $this->filterInputOptions);

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' integer-column';
    }
}
