<?php

namespace app\grid;

use kartik\grid\GridView;
use yii\helpers\Html;


class CheckboxColumn extends DataColumn
{
    public $filterType = GridView::FILTER_SELECT2;

    public $filter = '';
    public $label = '';

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filterInputOptions['label'] = $this->label;
        $this->filter = Html::activeCheckbox($this->grid->filterModel, $this->attribute, $this->filterInputOptions);
    }
}
