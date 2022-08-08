<?php

namespace app\grid;

use app\traits\GetListTrait;
use yii\helpers\Html;

class StringColumn extends DataColumn
{
    public $filterType = '';
    public $filter = '';

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        if ($this->isWithNotNull) {
            $this->filterOptions['title'] = sprintf(
                'Enter %s for empty value, %s for not empty value',
                GetListTrait::$isNull,
                GetListTrait::$isNotNull
            );
        }

        $this->filter = Html::activeTextInput($this->grid->filterModel, $this->attribute, $this->filterInputOptions);

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' string-column';
    }
}
