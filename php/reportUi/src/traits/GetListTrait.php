<?php

namespace app\traits;

use Yii;
use yii\db\ActiveQuery;

/**
 * @method static ActiveQuery find()
 */
trait GetListTrait
{
    public static $isNull = -1;
    public static $isNotNull = -2;

    /**
     * @param bool|string $isWithEmpty
     * @param bool $isWithNullAndNotNull
     * @param string $indexBy
     * @param string $select
     * @param array $orderBy
     * @param array $where
     * @return string[]
     */
    public static function getList(
        $isWithEmpty = false,
        $isWithNullAndNotNull = false,
        $indexBy = 'id',
        $select = 'name',
        $orderBy = ['name' => SORT_ASC],
        $where = []
    ) {
        $list = self::find()
            ->select([$select, $indexBy])
            ->where($where)
            ->orderBy($orderBy)
            ->indexBy($indexBy)
            ->column();

        return self::getEmptyList($isWithEmpty, $isWithNullAndNotNull) + $list;
    }

    /**
     * @param bool|string $isWithNull
     * @param bool $isWithNotNull
     * @return string[]
     */
    public static function getEmptyList($isWithNull = false, $isWithNotNull = false)
    {
        $list = [];

        if ($isWithNotNull) {
            $list = [
                    GetListTrait::$isNull => Yii::t('common', '(not set)'),
                    GetListTrait::$isNotNull => Yii::t('common', '(set)'),
                ] + $list;
        }

        if ($isWithNull) {
            $list = ['' => is_string($isWithNull) ? $isWithNull : ' '] + $list;
        }

        return $list;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
