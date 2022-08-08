<?php

namespace app\grid;

use yii\helpers\Html;

class IntegerRangeColumn extends DataColumn
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
        $placeholder = $this->grid->filterModel->getAttributeLabel($this->attribute);

        $this->filterInputOptions['placeholder'] = '>= ' . $placeholder;
        $this->filter = Html::activeInput(
            'number',
            $this->grid->filterModel,
            $this->attribute . '_from',
            $this->filterInputOptions
        );

        $this->filterInputOptions['placeholder'] = '<= ' . $placeholder;
        $this->filter .= ' ' . Html::activeInput(
                'number',
                $this->grid->filterModel,
                $this->attribute . '_to',
                $this->filterInputOptions
            );

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' integer-range-column';
    }
}
