<?php
/**
 * Detail page. Comment
 *
 * @var Controller $this
 * @var Comment $comment
 */

use blog\model\Comment;
use mvc\Controller;

?>
<p>
    <b>
        <?php if ($comment->url): ?>
            <a href="<?= $this->encode($comment->url) ?>" target="_blank"><?= $this->encode($comment->name) ?></a>
        <?php else : ?>
            <?= $this->encode($comment->name) ?>
        <?php endif ?>
    </b>
    said <?= $comment->getFormattedDateTime() ?>:<br/>
    <?= nl2br($this->encode($comment->remark)) ?>
</p>