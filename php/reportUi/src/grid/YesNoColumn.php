<?php

namespace app\grid;

use app\traits\GetListTrait;
use kartik\grid\GridView;

class YesNoColumn extends DataColumn
{
    // Отображение в ячейке строкового значения из selectbox вместо ID
    use ListTrait;

    public $filterType = GridView::FILTER_SELECT2;
    public $yesLabel;
    public $noLabel;

    /**
     * @inheritDoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->filter = self::getYesNoList(true);

        if (!is_null($this->noLabel)) {
            $this->filter[0] = $this->noLabel;
        }

        if (!is_null($this->yesLabel)) {
            $this->filter[1] = $this->yesLabel;
        }

        !isset($this->filterOptions['class']) && ($this->filterOptions['class'] = '');
        $this->filterOptions['class'] .= ' yes-no-column';
    }

    /**
     * Определяет getYesNoList (список для selectbox)
     * @param bool $isWithNull
     * @return array
     */
    public static function getYesNoList($isWithNull = false)
    {
        $list = [
            0 => 'No',
            1 => 'Yes',
        ];

        $list = GetListTrait::getEmptyList($isWithNull) + $list;

        return $list;
    }
}
