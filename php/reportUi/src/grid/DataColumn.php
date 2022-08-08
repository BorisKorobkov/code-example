<?php

namespace app\grid;

class DataColumn extends \kartik\grid\DataColumn
{
    public $isWriteNotSet = false; // в случае null выводить "не задано" или пустую строку
    public $isWithNull = true; // пустое значение (не фильтровать)
    public $isWithNotNull = false; // "не задано" (IS NULL), "задано" (IS NOT NULL)

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filterInputOptions['class'] = 'form-control input-sm';
        $this->filterInputOptions['id'] = null;
        $this->filterInputOptions['placeholder'] = true;
    }
}
