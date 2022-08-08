<?php

namespace app\grid;

class GridView extends \kartik\grid\GridView
{
    /**
     * @inheritdoc
     * При наведении мышкой на строку выделять ее
     */
    public $hover = true;

    /**
     * @inheritdoc
     * голубой фон th
     */
    public $headerRowOptions = [
        'class' => \kartik\grid\GridView::TYPE_INFO,
    ];

    /**
     * @inheritdoc
     * Добавлен экспорт?
     */
    public $panel = [
        'type' => '',
    ];

    /**
     * @inheritdoc
     * Добавил экспорт
     */
    public $panelHeadingTemplate = <<< HTML
    <div class="pull-right">
        {export}
    </div>
    <div class="pull-left">
        {summary}
    </div>
    <div class="clearfix"></div>
HTML;

    /**
     * @inheritdoc
     * Убрал footer
     */
    public $panelTemplate = <<< HTML
{panelHeading}
{panelBefore}
{items}
{panelAfter}
HTML;

    /**
     * @inheritdoc
     * скрыть старый экспорт
     */
    public $toolbar = [];

    /**
     * @inheritdoc
     * экспорт
     */
    public $export = [
        'showConfirmAlert' => false, // boolean, whether to show a confirmation alert dialog before download. This confirmation dialog will notify user about the type of exported file for download and to disable popup blockers.
        'target' => GridView::TARGET_SELF, // no window is popped up in this case, but download is submitted on same page.
    ];

    /**
     * @inheritdoc
     */
    public function renderExport()
    {
        if (!$this->dataProvider->getTotalCount()) {
            // не показывать кнопку, если нет данных
            return '';
        }

        return parent::renderExport();
    }
}
