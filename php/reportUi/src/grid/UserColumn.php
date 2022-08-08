<?php

namespace app\grid;

class UserColumn extends DataColumn
{
    /**
     * @inheritDoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if (!$model->user_id) {
            return $this->isWriteNotSet ? '(not set)' : '';
        }

        return $model->user->name;
    }
}
