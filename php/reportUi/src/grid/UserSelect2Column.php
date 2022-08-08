<?php

namespace app\grid;


use app\models\User;

class UserSelect2Column extends Select2Column
{
    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filter = User::getList($this->isWithNull, $this->isWithNotNull, 'id', 'email', ['id' => SORT_DESC]);
        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' user-column';
    }

    /**
     * @inheritDoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $value = parent::renderDataCellContent($model, $key, $index);
        if (!$value) {
            return $this->isWriteNotSet ? '(not set)' : '';
        }

        return $value;
    }
}
