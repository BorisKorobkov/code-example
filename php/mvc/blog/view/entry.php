<?php
/**
 * Detail page
 *
 * @var Controller $this
 * @var Entry $entry
 */

use blog\model\Entry;
use mvc\Controller;

$this->title = $entry->title;

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $entry->getFormattedDate() ?>:
            <?= $this->encode($entry->title) ?>
        </div>
        <div class="panel-body"><?= nl2br($this->encode($entry->text)) ?></div>
        <div class="panel-footer">
            Author: <?= $this->encode($entry->getUser()->name) ?>
        </div>
    </div>

<?php
$comments = $entry->getComments();
foreach ($comments as $comment) {
    echo $this->getView('comment', ['comment' => $comment]);
}

echo $this->getView('commentForm');

