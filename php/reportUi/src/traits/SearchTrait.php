<?php

namespace app\traits;

use yii\db\ActiveQuery;

trait SearchTrait
{
    /**
     * @param ActiveQuery $query
     * @param string $fieldName
     * @param string $function
     */
    public function searchIsNull(ActiveQuery $query, $fieldName, $function = '')
    {
        switch ($this->{$fieldName}) {
            case '':
                break;

            case GetListTrait::$isNull:
                $query->andWhere([$fieldName => null]);
                break;

            case GetListTrait::$isNotNull:
                $query->andWhere(['IS NOT', $fieldName, null]);
                break;

            default:
                $query->andWhere([
                    $fieldName => $function ?
                        $function($this->{$fieldName}) :
                        $this->{$fieldName},
                ]);
                break;
        }
    }

    /**
     * @param ActiveQuery $query
     * @param string $fieldName
     * @param string $function
     */
    public function searchFromTo(ActiveQuery $query, $fieldName, $function = '')
    {
        $this->searchIsNull($query, $fieldName, $function);

        // from
        $fieldNameFrom = $fieldName . '_from';
        $this->{$fieldNameFrom} !== '' && $query->andWhere([
            '>=',
            $fieldName,
            $function ?
                $function($this->{$fieldNameFrom}) :
                $this->{$fieldNameFrom},
        ]);

        // to
        $fieldNameTo = $fieldName . '_to';
        $this->{$fieldNameTo} !== '' && $query->andWhere([
            '<=',
            $fieldName,
            $function ?
                $function($this->{$fieldNameTo}) :
                $this->{$fieldNameTo},
        ]);
    }

}
