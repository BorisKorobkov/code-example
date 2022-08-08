<?php

namespace app\grid;

use kartik\datetime\DateTimePicker;

class DateTimeRangeColumn extends DataColumn
{
    public $filterType = '';
    public $filter = '';

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filterInputOptions['class'] .= ' input-datetime';
        $placeholder = $this->grid->filterModel->getAttributeLabel($this->attribute);

        $this->filterInputOptions['placeholder'] = '>= ' . $placeholder;
        $this->filter = DateTimePicker::widget(
            [
                'model' => $this->grid->filterModel,
                'attribute' => $this->attribute . '_from',
                'removeButton' => false,
                'type' => DateTimePicker::TYPE_INPUT,
                'options' => $this->filterInputOptions,
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd hh:ii:00',
                ],
            ]
        );

        $this->filterInputOptions['placeholder'] = '<= ' . $placeholder;
        $this->filter .= ' ' . DateTimePicker::widget(
                [
                    'model' => $this->grid->filterModel,
                    'attribute' => $this->attribute . '_to',
                    'removeButton' => false,
                    'type' => DateTimePicker::TYPE_INPUT,
                    'options' => $this->filterInputOptions,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd hh:ii:00',
                    ],
                ]
            );

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' datetime-range-double-column';
    }
}
