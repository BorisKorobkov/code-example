<?php

namespace app\grid;

use app\traits\GetListTrait;
use kartik\grid\GridView;

class Select2Column extends DataColumn
{
    // Отображение в ячейке строкового значения из selectbox вместо ID
    use ListTrait;

    public $filterType = GridView::FILTER_SELECT2;
    public $filter = [];

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filter = GetListTrait::getEmptyList($this->isWithNull, $this->isWithNotNull) + $this->filter;
        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' dropdown-column';
    }
}
