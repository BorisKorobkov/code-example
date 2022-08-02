<?php
/**
 * Index page
 *
 * @var Controller $this
 * @var Entry[] $lastEntries
 */

use blog\model\Entry;
use mvc\Controller;

$this->title = "Boris Korobkov's Blog";

foreach ($lastEntries as $entry):
    $detailUrl = $entry->getDetailUrl();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $this->encode($entry->getFormattedDate()) ?>:
            <a href="<?= $detailUrl ?>"><?= $this->encode($entry->title) ?></a>
        </div>
        <div class="panel-body"><?= nl2br($this->encode($entry->getTextPreview())) ?></div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6">
                    Author: <?= $this->encode($entry->getUser()->name) ?>
                </div>
                <div class="col-sm-6">
                    <a href="<?= $detailUrl ?>">
                        Comments: <?= count($entry->getComments()) ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach;