<?php

namespace app\grid;

use app\traits\GetListTrait;
use kartik\date\DatePicker;
use kartik\select2\Select2;

class DateRangeColumn extends DataColumn
{
    public $filterType = '';
    public $filter = '';

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filterInputOptions['class'] .= ' input-date';
        $placeholder = $this->grid->filterModel->getAttributeLabel($this->attribute);

        $this->filterInputOptions['placeholder'] = '>= ' . $placeholder;
        $this->filter = DatePicker::widget(
            [
                'model' => $this->grid->filterModel,
                'attribute' => $this->attribute . '_from',
                'removeButton' => false,
                'type' => DatePicker::TYPE_INPUT,
                'options' => $this->filterInputOptions,
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]
        );

        $this->filterInputOptions['placeholder'] = '<= ' . $placeholder;
        $this->filter .= ' ' . DatePicker::widget(
                [
                    'model' => $this->grid->filterModel,
                    'attribute' => $this->attribute . '_to',
                    'removeButton' => false,
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => $this->filterInputOptions,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]
            );

        if ($this->isWithNotNull) {
            $this->filterInputOptions['placeholder'] = $placeholder;
            $this->filter .= ' ' . Select2::widget([
                    'model' => $this->grid->filterModel,
                    'attribute' => $this->attribute,
                    'data' => GetListTrait::getEmptyList($this->isWithNull, $this->isWithNotNull),
                    'options' => $this->filterInputOptions,
                ]);
        }

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' date-range-double-column';
    }
}
